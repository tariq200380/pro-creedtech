import https from 'https';
import http from 'http';

function fetchRaw(url) {
  return new Promise((resolve) => {
    const client = url.startsWith('https') ? https : http;
    client.get(url, {
      headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
        'Accept': 'application/rss+xml, application/xml, text/xml, */*'
      }
    }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve(d));
    });
  });
}

function parseItems(xml, providerName, max = 5) {
  const items = xml.split(/<item[\s>]/i);
  const results = [];
  for (let i = 1; i < Math.min(items.length, max + 1); i++) {
    const raw = items[i];
    const titleMatch = raw.match(/<title>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is);
    const linkMatch = raw.match(/<link>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is);
    const guidMatch = raw.match(/<guid[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/guid>/is);
    const pubDateMatch = raw.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is);
    const descMatch = raw.match(/<description>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/description>/is);
    const mediaMatch = raw.match(/<media:content[^>]+url=["']([^"']+)["']/i);
    const descImgMatch = (descMatch ? descMatch[1] : '').match(/<img[^>]+src=["']([^"']+)["']/i) ||
                         (descMatch ? descMatch[1] : '').match(/&lt;img[^>]+src=["']([^"']+)["']/i);

    const title = titleMatch ? titleMatch[1].replace(/<[^>]+>/g, '').trim() : '';
    const link = linkMatch ? linkMatch[1].trim() : '';
    const guid = guidMatch ? guidMatch[1].trim() : link;
    const pubDate = pubDateMatch ? pubDateMatch[1].trim() : '';
    const desc = descMatch ? descMatch[1].replace(/<[^>]+>/g, '').replace(/&lt;[^&]+&gt;/g, '').trim() : '';
    const image = mediaMatch ? mediaMatch[1] : (descImgMatch ? descImgMatch[1] : null);

    results.push({
      provider: providerName,
      external_id: guid,
      title,
      link,
      pubDate,
      summary: desc.substring(0, 200),
      image
    });
  }
  return results;
}

async function run() {
  const googleXml = await fetchRaw('https://blog.google/rss/');
  const arsXml = await fetchRaw('https://feeds.arstechnica.com/arstechnica/index');

  const googleItems = parseItems(googleXml, 'google', 5);
  const arsItems = parseItems(arsXml, 'arstechnica', 5);

  console.log('=== GOOGLE LIVE FEED ITEMS ===');
  console.dir(googleItems, { depth: null });

  console.log('\n=== ARS TECHNICA LIVE FEED ITEMS ===');
  console.dir(arsItems, { depth: null });
}

run();
