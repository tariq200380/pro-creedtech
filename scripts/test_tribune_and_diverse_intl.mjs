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
          if (!nextUrl.startsWith('http')) nextUrl = new URL(nextUrl, url).toString();
          return fetchUrl(nextUrl).then(resolve);
        }
        let body = '';
        res.on('data', c => body += c);
        res.on('end', () => resolve({ status: res.statusCode, body }));
      });
      req.on('error', e => resolve({ status: 0, error: e.message }));
      req.on('timeout', () => { req.destroy(); resolve({ status: 408, error: 'timeout' }); });
    } catch (e) {
      resolve({ status: 0, error: e.message });
    }
  });
}

function parseFeedItem(rawXml, providerKey) {
  const titleM = rawXml.match(/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is);
  const linkM = rawXml.match(/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is) || rawXml.match(/<link[^>]+href=["']([^"']+)["']/i);
  const guidM = rawXml.match(/<guid[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/guid>/is) || rawXml.match(/<id[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/id>/is);
  const pubDateM = rawXml.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is) || rawXml.match(/<updated>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/updated>/is) || rawXml.match(/<published>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/published>/is);
  
  let imageUrl = null;

  // 1. media:content
  const mediaContentM = rawXml.match(/<media:content[^>]+url=["']([^"']+)["']/i);
  if (mediaContentM) imageUrl = mediaContentM[1];

  // 2. media:thumbnail
  if (!imageUrl) {
    const mediaThumbM = rawXml.match(/<media:thumbnail[^>]+url=["']([^"']+)["']/i);
    if (mediaThumbM) imageUrl = mediaThumbM[1];
  }

  // 3. enclosure
  if (!imageUrl) {
    const encM = rawXml.match(/<enclosure[^>]+url=["']([^"']+)["']/i);
    if (encM) imageUrl = encM[1];
  }

  // 4. Tribune specific: <image><img src="..."/></image> or <image><url>...</url></image>
  if (!imageUrl) {
    const imageTagM = rawXml.match(/<image[^>]*>(.*?)<\/image>/is);
    if (imageTagM) {
      const srcM = imageTagM[1].match(/src=["']([^"']+)["']/i) || imageTagM[1].match(/<url>(.*?)<\/url>/i) || imageTagM[1].match(/https?:\/\/[^\s<"']+/i);
      if (srcM) imageUrl = srcM[1] || srcM[0];
    }
  }

  // 5. content:encoded or description img
  if (!imageUrl) {
    const contentM = rawXml.match(/<content:encoded[^>]*>(.*?)<\/content:encoded>/is) || rawXml.match(/<description[^>]*>(.*?)<\/description>/is);
    if (contentM) {
      const imgM = contentM[1].match(/<img[^>]+src=["']([^"']+)["']/i) || contentM[1].match(/&lt;img[^>]+src=["']([^"']+)["']/i);
      if (imgM) imageUrl = imgM[1];
    }
  }

  const title = titleM ? titleM[1].replace(/<[^>]+>/g, '').trim() : '';
  const link = linkM ? (linkM[1] || linkM[0]).trim() : '';
  const guid = guidM ? (guidM[1] || guidM[0]).trim() : link;
  const pubDate = pubDateM ? pubDateM[1].trim() : '';

  return { title, link, guid, pubDate, imageUrl };
}

async function run() {
  console.log('--- TESTING TRIBUNE SPACEX PARSING ---');
  const trib = await fetchUrl('https://tribune.com.pk/feed/technology');
  if (trib.body) {
    const items = trib.body.split(/<item[\s>]/i);
    for (let i = 1; i < items.length; i++) {
      if (items[i].includes('2624193') || items[i].includes('Falcon 9 missions')) {
        const parsed = parseFeedItem(items[i], 'tribune');
        console.log('Parsed SpaceX Article:');
        console.log('Title:   ', parsed.title);
        console.log('Link:    ', parsed.link);
        console.log('PubDate: ', parsed.pubDate);
        console.log('Image:   ', parsed.imageUrl);
      }
    }
  }

  console.log('\n--- TESTING 5 DIVERSE INTERNATIONAL PROVIDERS ---');
  const intlProviders = [
    { key: 'google', name: 'Google The Keyword', url: 'https://blog.google/rss/' },
    { key: 'apple', name: 'Apple Newsroom', url: 'https://www.apple.com/newsroom/rss-feed.rss' },
    { key: 'nvidia', name: 'NVIDIA Official Blog', url: 'https://blogs.nvidia.com/feed/' },
    { key: 'anthropic', name: 'Anthropic Official', url: 'https://www.anthropic.com/feed' },
    { key: 'openai', name: 'OpenAI Newsroom', url: 'https://openai.com/news/rss.xml' }
  ];

  for (const prov of intlProviders) {
    console.log(`\nFetching ${prov.key.toUpperCase()} (${prov.url})...`);
    const res = await fetchUrl(prov.url);
    console.log(`Status: ${res.status}`);
    if (res.status === 200 && res.body) {
      const items = res.body.split(/<item[\s>]|<entry[\s>]/i);
      if (items.length > 1) {
        const parsed = parseFeedItem(items[1], prov.key);
        console.log(`✓ Latest ${prov.key} Headline :`, parsed.title);
        console.log(`  Link                      :`, parsed.link);
        console.log(`  PubDate                   :`, parsed.pubDate);
        console.log(`  Image                     :`, parsed.imageUrl || '(Branded Fallback)');
      }
    } else {
      console.log(`✗ Failed to fetch ${prov.key}: HTTP ${res.status} ${res.error || ''}`);
    }
  }
}

run();
