import https from 'https';
import http from 'http';

function fetchUrl(url) {
  return new Promise((resolve) => {
    try {
      const parsed = new URL(url);
      const client = parsed.protocol === 'https:' ? https : http;
      const req = client.get(url, {
        headers: {
          'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
          'Accept': 'application/rss+xml, application/xml, text/xml, application/atom+xml, */*'
        },
        timeout: 10000
      }, (res) => {
        if (res.statusCode >= 300 && res.statusCode < 400 && res.headers.location) {
          let nextUrl = res.headers.location;
          if (!nextUrl.startsWith('http')) {
            nextUrl = new URL(nextUrl, url).toString();
          }
          return fetchUrl(nextUrl).then(resolve);
        }
        let body = '';
        res.on('data', c => body += c);
        res.on('end', () => resolve({ status: res.statusCode, body }));
      });
      req.on('error', (e) => resolve({ status: 0, error: e.message }));
      req.on('timeout', () => { req.destroy(); resolve({ status: 408, error: 'timeout' }); });
    } catch (e) {
      resolve({ status: 0, error: e.message });
    }
  });
}

function parseFeedItems(xml, providerKey, providerName, brandBadge, defaultCat, isPakistani) {
  if (!xml || typeof xml !== 'string') return [];
  const items = xml.split(/<item[\s>]|<entry[\s>]/i);
  const results = [];

  for (let i = 1; i < items.length; i++) {
    const raw = items[i];
    const titleM = raw.match(/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is);
    const linkM = raw.match(/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is) || raw.match(/<link[^>]+href=["']([^"']+)["']/i);
    const guidM = raw.match(/<guid[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/guid>/is) || raw.match(/<id[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/id>/is);
    const pubDateM = raw.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is) || raw.match(/<updated>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/updated>/is) || raw.match(/<published>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/published>/is);
    const descM = raw.match(/<description>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/description>/is) || raw.match(/<content[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/content>/is) || raw.match(/<summary[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/summary>/is);
    const mediaM = raw.match(/<media:content[^>]+url=["']([^"']+)["']/i) || raw.match(/<enclosure[^>]+url=["']([^"']+)["']/i) || raw.match(/<media:thumbnail[^>]+url=["']([^"']+)["']/i);
    const imgInDesc = descM ? (descM[1].match(/<img[^>]+src=["']([^"']+)["']/i) || descM[1].match(/&lt;img[^>]+src=["']([^"']+)["']/i)) : null;

    const title = titleM ? titleM[1].replace(/<[^>]+>/g, '').trim() : '';
    let link = linkM ? (linkM[1] || linkM[0]).trim() : '';
    if (link.startsWith('http') === false && link.includes('http')) {
      link = link.substring(link.indexOf('http'));
    }
    const guid = guidM ? guidM[1].replace(/<[^>]+>/g, '').trim() : link;
    const pubDateRaw = pubDateM ? pubDateM[1].trim() : '';
    let summary = descM ? descM[1].replace(/<[^>]+>/g, '').replace(/&lt;[^&]+&gt;/g, '').trim() : '';
    summary = summary.replace(/\s+/g, ' ');
    if (summary.length > 250) summary = summary.substring(0, 247) + '...';
    const image = mediaM ? mediaM[1] : (imgInDesc ? imgInDesc[1] : null);

    if (title && link) {
      results.push({
        provider: providerKey,
        provider_name: providerName,
        is_pakistani: isPakistani,
        brand_badge: brandBadge,
        category: defaultCat,
        external_article_id: guid || `${providerKey}_${Math.random()}`,
        original_title: title,
        canonical_source_url: link,
        provider_published_at_raw: pubDateRaw,
        summary,
        source_image_url: image
      });
    }
  }
  return results;
}

async function testExtraction() {
  console.log('--- FETCHING & PARSING CANDIDATE FEEDS ---');

  const feeds = [
    { key: 'dawn_tech', name: 'Dawn Sci-Tech', badge: '🇵🇰 DAWN TECH', cat: 'PAKISTAN TECH & SCIENCE', pk: true, url: 'https://www.dawn.com/feeds/tech/' },
    { key: 'brecorder_tech', name: 'Business Recorder', badge: '🇵🇰 B-RECORDER', cat: 'PAKISTAN FINTECH & BUSINESS', pk: true, url: 'https://www.brecorder.com/feeds/technology/' },
    { key: 'propakistani', name: 'ProPakistani', badge: '🇵🇰 PROPAKISTANI', cat: 'PAKISTAN DIGITAL ECOSYSTEM', pk: true, url: 'https://propakistani.pk/feed/' },
    { key: 'tribune_tech', name: 'The Express Tribune', badge: '🇵🇰 TRIBUNE', cat: 'PAKISTAN TECH & AEROSPACE', pk: true, url: 'https://tribune.com.pk/feed/technology' },
    { key: 'google', name: 'Google The Keyword', badge: '🌐 GOOGLE', cat: 'GOOGLE AI & DEVICES', pk: false, url: 'https://blog.google/rss/' },
    { key: 'arstechnica', name: 'Ars Technica Pro', badge: '⚡ ARS TECHNICA', cat: 'GLOBAL TECH & RESEARCH', pk: false, url: 'https://feeds.arstechnica.com/arstechnica/index' },
    { key: 'theverge', name: 'The Verge', badge: '🔥 THE VERGE', cat: 'CONSUMER TECH & PLATFORMS', pk: false, url: 'https://www.theverge.com/rss/index.xml' }
  ];

  for (const f of feeds) {
    const res = await fetchUrl(f.url);
    const parsed = parseFeedItems(res.body, f.key, f.name, f.badge, f.cat, f.pk);
    console.log(`\n[${f.name}] Status: ${res.status} | Total Parsed: ${parsed.length}`);
    if (parsed.length > 0) {
      console.log(`   Sample 1 Headline: ${parsed[0].original_title}`);
      console.log(`   Sample 1 Link:     ${parsed[0].canonical_source_url}`);
      console.log(`   Sample 1 PubDate:  ${parsed[0].provider_published_at_raw}`);
      console.log(`   Sample 1 Image:    ${parsed[0].source_image_url || '(Fallback will be used)'}`);
    }
  }
}

testExtraction();
