#!/usr/bin/env python3
import os
import sys
import json
import re
import datetime
from email.utils import parsedate_to_datetime
from urllib.parse import urlparse

PROJECT_ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
CACHE_PATH = os.path.join(PROJECT_ROOT, 'public_html', 'data', 'live_news_cache.json')
PUBLIC_HTML = os.path.join(PROJECT_ROOT, 'public_html')

def parse_date_str(date_str):
    if not date_str:
        return None
    date_str = str(date_str).strip()
    try:
        dt = parsedate_to_datetime(date_str)
        if dt.tzinfo is None:
            dt = dt.replace(tzinfo=datetime.timezone.utc)
        return dt
    except Exception:
        pass
    try:
        iso_str = date_str.replace('Z', '+00:00')
        dt = datetime.datetime.fromisoformat(iso_str)
        if dt.tzinfo is None:
            dt = dt.replace(tzinfo=datetime.timezone.utc)
        return dt
    except Exception:
        pass
    try:
        # Standard format like 2026-08-21 17:00:00
        dt = datetime.datetime.strptime(date_str[:19], '%Y-%m-%d %H:%M:%S')
        dt = dt.replace(tzinfo=datetime.timezone.utc)
        return dt
    except Exception:
        pass
    return None

def is_valid_url(url):
    if not url or not isinstance(url, str):
        return False
    try:
        p = urlparse(url)
        return p.scheme in ('http', 'https') and bool(p.netloc)
    except Exception:
        return False

def check_health():
    now_utc = datetime.datetime.now(datetime.timezone.utc)

    if not os.path.exists(CACHE_PATH):
        return None, f'Cache file not found at: {CACHE_PATH}'

    try:
        with open(CACHE_PATH, 'r', encoding='utf-8') as f:
            cache = json.load(f)
    except Exception as e:
        return None, f'Failed to parse cache JSON: {e}'

    # Build pubDate map from breaking_news and regional_items
    pub_date_map = {}
    for bn in cache.get('breaking_news', []):
        p = bn.get('provider')
        if p and bn.get('provider_published_at'):
            pub_date_map[p] = bn.get('provider_published_at')
    for ri in cache.get('regional_items', []):
        p = ri.get('provider') or ri.get('wire_key')
        if p and ri.get('provider_published_at'):
            pub_date_map[p] = ri.get('provider_published_at')

    # Collect all active provider items
    provider_items = {}
    for p, bw in cache.get('brand_wires', {}).items():
        item = dict(bw)
        item['wire_type'] = 'brand'
        item['provider_key'] = p
        provider_items[p] = item

    for p, rw in cache.get('regional_wires', {}).items():
        item = dict(rw)
        item['wire_type'] = 'regional'
        item['provider_key'] = p
        provider_items[p] = item

    if not provider_items:
        return None, 'No active providers found in cache'

    results = []
    summary = {
        'total_providers': len(provider_items),
        'healthy': 0,
        'warning': 0,
        'fail': 0,
        'freshness': {
            'fresh': 0,
            'recent': 0,
            'aging': 0,
            'stale': 0,
            'unknown': 0
        },
        'visuals': {
            'real_image': 0,
            'screenshot': 0,
            'missing': 0,
            'unknown': 0
        }
    }

    for pkey, item in provider_items.items():
        issues = []
        status = 'HEALTHY'

        # 1. Title
        title = (item.get('title') or '').strip()
        if not title:
            issues.append('Missing or empty article title')
            status = 'FAIL'

        # 2. Source URL
        source_url = (item.get('link') or item.get('sourceUrl') or '').strip()
        if not source_url:
            issues.append('Missing source URL')
            status = 'FAIL'
        elif not is_valid_url(source_url):
            issues.append(f'Invalid source URL scheme/format: {source_url}')
            status = 'FAIL'

        # 3. Publication Date & Freshness
        raw_pub = pub_date_map.get(pkey) or item.get('provider_published_at')
        dt = parse_date_str(raw_pub)

        age_hours = None
        age_human = 'unknown'
        freshness = 'UNKNOWN'

        if dt:
            diff = now_utc - dt
            age_hours = round(diff.total_seconds() / 3600.0, 1)
            if age_hours < 0:
                age_hours = 0.0

            if age_hours <= 24.0:
                freshness = 'FRESH'
                age_human = f'{age_hours:.1f} hours'
            elif age_hours <= 72.0:
                freshness = 'RECENT'
                age_human = f'{age_hours/24.0:.1f} days'
            elif age_hours <= 168.0:
                freshness = 'AGING'
                age_human = f'{age_hours/24.0:.1f} days'
            else:
                freshness = 'STALE'
                age_human = f'{age_hours/24.0:.1f} days'
                issues.append(f'Article is older than 7 days ({age_human})')
                if status != 'FAIL':
                    status = 'WARNING'
        else:
            freshness = 'UNKNOWN'
            issues.append('Publication timestamp missing or unparseable')
            if status != 'FAIL':
                status = 'WARNING'

        summary['freshness'][freshness.lower()] += 1

        # 4. Visual Asset Check
        rel_img = (item.get('img') or item.get('image') or '').strip()
        src_img = (item.get('source_image_url') or '').strip()

        visual_type = 'UNKNOWN'
        visual_exists = False
        visual_size = 0

        if not rel_img:
            visual_type = 'MISSING'
            issues.append('No local visual path defined')
            status = 'FAIL'
        else:
            full_img_path = os.path.join(PUBLIC_HTML, rel_img)
            if os.path.exists(full_img_path):
                visual_exists = True
                visual_size = os.path.getsize(full_img_path)
                if visual_size == 0:
                    issues.append(f'Local visual file is 0 bytes: {rel_img}')
                    status = 'FAIL'
                    visual_type = 'MISSING'
                else:
                    if '_headline_' in rel_img:
                        visual_type = 'SCREENSHOT'
                    elif src_img or rel_img.startswith('uploads/live_news/'):
                        visual_type = 'REAL_IMAGE'
                    else:
                        visual_type = 'UNKNOWN'
                        issues.append(f'Unrecognized visual path format: {rel_img}')
                        if status != 'FAIL':
                            status = 'WARNING'
            else:
                issues.append(f'Local visual file not found on disk: {rel_img}')
                status = 'FAIL'
                visual_type = 'MISSING'

        # 5. Check for suspicious placeholder / logo in non-screenshot files
        if visual_type == 'REAL_IMAGE' and rel_img:
            if re.search(r'(favicon|avatar|sprite|placeholder|1x1|logo)', rel_img, re.I):
                issues.append(f'Suspicious logo or placeholder asset detected: {rel_img}')
                if status != 'FAIL':
                    status = 'WARNING'

        summary['visuals'][visual_type.lower()] += 1
        summary[status.lower()] += 1

        display_name = item.get('source') or item.get('sourceName') or pkey.capitalize()

        results.append({
            'provider': pkey,
            'name': display_name,
            'status': status,
            'freshness': freshness,
            'age_hours': age_hours,
            'age_human': age_human,
            'title': title,
            'source_url': source_url,
            'published_at': raw_pub or 'NONE',
            'visual_type': visual_type,
            'visual_file': rel_img,
            'visual_exists': visual_exists,
            'visual_size': visual_size,
            'issues': issues
        })

    report = {
        'checked_at': now_utc.strftime('%Y-%m-%dT%H:%M:%SZ'),
        'summary': summary,
        'providers': results
    }
    return report, None

def print_human_report(report):
    print('=' * 60)
    print('LIVE NEWS HEALTH CHECK')
    print('=' * 60)
    print(f'Timestamp: {report["checked_at"]}')
    print('-' * 60)

    for p in report['providers']:
        print(f'Provider:     {p["name"]} ({p["provider"]})')
        print(f'Status:       {p["status"]}')
        print(f'Freshness:    {p["freshness"]} ({p["age_human"]})')
        print(f'Title:        {p["title"]}')
        print(f'Source URL:   {p["source_url"]}')
        print(f'Visual:       {p["visual_type"]}')
        print(f'Visual File:  {"EXISTS" if p["visual_exists"] else "MISSING"} ({p["visual_file"]})')
        if p['visual_exists']:
            print(f'Visual Size:  {p["visual_size"]} bytes')
        if p['issues']:
            print(f'Notes/Issues: {"; ".join(p["issues"])}')
        print('-' * 60)

    s = report['summary']
    print('SUMMARY:')
    print(f'  TOTAL PROVIDERS:   {s["total_providers"]}')
    print(f'  HEALTHY:           {s["healthy"]}')
    print(f'  WARNING:           {s["warning"]}')
    print(f'  FAIL:              {s["fail"]}')
    print()
    print('FRESHNESS BREAKDOWN:')
    print(f'  FRESH   (0-24h):   {s["freshness"]["fresh"]}')
    print(f'  RECENT  (1-3d):    {s["freshness"]["recent"]}')
    print(f'  AGING   (3-7d):    {s["freshness"]["aging"]}')
    print(f'  STALE   (>7d):     {s["freshness"]["stale"]}')
    print(f'  UNKNOWN:           {s["freshness"]["unknown"]}')
    print()
    print('VISUAL ASSETS:')
    print(f'  REAL ARTICLE IMAGE: {s["visuals"]["real_image"]}')
    print(f'  SCREENSHOT:         {s["visuals"]["screenshot"]}')
    print(f'  MISSING:            {s["visuals"]["missing"]}')
    print(f'  UNKNOWN VISUAL:     {s["visuals"]["unknown"]}')
    print('=' * 60)

def main():
    json_mode = '--json' in sys.argv
    report, error = check_health()

    if error:
        if json_mode:
            print(json.dumps({'error': error, 'checked_at': datetime.datetime.now(datetime.timezone.utc).isoformat()}, indent=2))
        else:
            print(f'ERROR: {error}', file=sys.stderr)
        sys.exit(2)

    if json_mode:
        print(json.dumps(report, indent=2))
    else:
        print_human_report(report)

    if report['summary']['fail'] > 0:
        sys.exit(1)
    sys.exit(0)

if __name__ == '__main__':
    main()
