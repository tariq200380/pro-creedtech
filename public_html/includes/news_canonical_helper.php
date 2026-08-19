<?php
/**
 * Creed Tech - Canonical Live News Feed Loader & Normalizer
 * Provides shared canonical records extraction across public feeds, admin panels, and draft services.
 */

function get_all_canonical_news_records() {
    $liveNewsCacheFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'live_news_cache.json';
    if (!file_exists($liveNewsCacheFile)) return [];
    
    $raw = @json_decode(@file_get_contents($liveNewsCacheFile), true);
    if (!is_array($raw)) return [];

    $items = [];
    $seen = [];

    // 1. Check breaking_news array
    if (!empty($raw['breaking_news']) && is_array($raw['breaking_news'])) {
        foreach ($raw['breaking_news'] as $item) {
            $key = strtolower($item['provider'] ?? '') . '|' . ($item['external_id'] ?? $item['link'] ?? '');
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $items[] = [
                    'provider'              => $item['provider'] ?? 'wire',
                    'external_id'           => $item['external_id'] ?? $item['link'] ?? '',
                    'tag'                   => $item['tag'] ?? 'TECH WIRE',
                    'date'                  => $item['date'] ?? '',
                    'source'                => $item['source'] ?? $item['provider'] ?? 'Official Feed',
                    'title'                 => $item['title'] ?? '',
                    'desc'                  => $item['desc'] ?? $item['summary'] ?? '',
                    'link'                  => $item['link'] ?? '',
                    'img'                   => $item['img'] ?? $item['image'] ?? '',
                    'provider_published_at' => $item['provider_published_at'] ?? ''
                ];
            }
        }
    }

    // 2. Check brand_wires map (Google, Apple, Nvidia, Anthropic, OpenAI)
    if (!empty($raw['brand_wires']) && is_array($raw['brand_wires'])) {
        foreach ($raw['brand_wires'] as $provKey => $item) {
            $key = strtolower($provKey) . '|' . ($item['link'] ?? '');
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $items[] = [
                    'provider'              => $provKey,
                    'external_id'           => $item['link'] ?? '',
                    'tag'                   => $item['cat'] ?? $item['captionTag'] ?? 'BRAND WIRE',
                    'date'                  => $item['date'] ?? '',
                    'source'                => $item['source'] ?? $provKey,
                    'title'                 => $item['title'] ?? '',
                    'desc'                  => $item['summary'] ?? '',
                    'link'                  => $item['link'] ?? '',
                    'img'                   => $item['img'] ?? '',
                    'provider_published_at' => ''
                ];
            }
        }
    }

    // 3. Check regional_wires map (Dawn, B-Recorder, ProPakistani, Tribune)
    if (!empty($raw['regional_wires']) && is_array($raw['regional_wires'])) {
        foreach ($raw['regional_wires'] as $regKey => $item) {
            $key = strtolower($regKey) . '|' . ($item['sourceUrl'] ?? $item['link'] ?? '');
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $items[] = [
                    'provider'              => $regKey,
                    'external_id'           => $item['sourceUrl'] ?? $item['link'] ?? '',
                    'tag'                   => $item['category'] ?? $item['captionTag'] ?? 'REGIONAL WIRE',
                    'date'                  => $item['date'] ?? '',
                    'source'                => $item['sourceName'] ?? $item['source'] ?? $regKey,
                    'title'                 => $item['title'] ?? '',
                    'desc'                  => $item['summary'] ?? '',
                    'link'                  => $item['sourceUrl'] ?? $item['link'] ?? '',
                    'img'                   => $item['image'] ?? $item['img'] ?? '',
                    'provider_published_at' => ''
                ];
            }
        }
    }

    return $items;
}
