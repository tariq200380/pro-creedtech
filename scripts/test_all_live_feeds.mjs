import https from 'https';
import http from 'http';

function testFeed(name, url) {
  return new Promise((resolve) => {
    const client = url.startsWith('https') ? https : http;
    const req = client.get(url, {
      headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
        'Accept': 'application/rss+xml, application/xml, text/xml, application/atom+xml, */*'
      }
    }, (res) => {
      if (res.statusCode >= 300 && res.statusCode < 400 && res.headers.location) {
        return testFeed(name, res.headers.location).then(resolve);
      }
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => {
        const items = d.split(/<item[\s>]/i);
        console.log(`[${name}] Status: ${res.statusCode} | Length: ${d.length} | Items: ${items.length - 1}`);
        if (items.length > 1) {
          const item1 = items[1];
          const titleMatch = item1.match(/<title>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is);
          const pubDateMatch = item1.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is);
          const linkMatch = item1.match(/<link>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is);
          const mediaMatch = item1.match(/<media:content[^>]+url=["']([^"']+)["']/i);
          const descMatch = item1.match(/&lt;img[^>]+src=["']([^"']+)["']/i) || item1.match(/<img[^>]+src=["']([^"']+)["']/i);

          const title = titleMatch ? titleMatch[1].replace(/<[^>]+>/g, '').trim() : 'N/A';
          const pubDate = pubDateMatch ? pubDateMatch[1].trim() : 'N/A';
          const link = linkMatch ? linkMatch[1].trim() : 'N/A';
          const img = mediaMatch ? mediaMatch[1] : (descMatch ? descMatch[1] : null);

          console.log(`   Title   : ${title.substring(0, 80)}`);
          console.log(`   PubDate : ${pubDate}`);
          console.log(`   Link    : ${link}`);
          console.log(`   Image   : ${img || 'NO IMAGE IN PAYLOAD'}\n`);
          resolve({ name, status: res.statusCode, title, pubDate, link, img, rawItem: item1 });
        } else {
          resolve({ name, status: res.statusCode, count: 0 });
        }
      });
    });
    req.on('error', (e) => {
      console.log(`[${name}] Error: ${e.message}`);
      resolve({ name, status: 0, error: e.message });
    });
  });
}

async function run() {
  console.log('--- Testing Live RSS Feeds ---');
  await testFeed('Google Official Blog', 'https://blog.google/rss/');
  await testFeed('Ars Technica', 'https://feeds.arstechnica.com/arstechnica/index');
  await testFeed('TechCrunch', 'https://techcrunch.com/feed/');
  await testFeed('The Verge', 'https://www.theverge.com/rss/index.xml');
  await testFeed('Wired', 'https://www.wired.com/feed/rss');
}

run();
