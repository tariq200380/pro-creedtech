import https from 'https';
import http from 'http';

function probeFeed(name, url) {
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
          return probeFeed(name + ' (redirect)', nextUrl).then(resolve);
        }

        let body = '';
        res.on('data', c => body += c);
        res.on('end', () => {
          const isXml = body.includes('<rss') || body.includes('<feed') || body.includes('<channel');
          const isJson = body.trim().startsWith('{') || body.trim().startsWith('[');
          const items = body.split(/<item[\s>]|<entry[\s>]/i);
          const itemCount = items.length - 1;

          let sample = null;
          if (itemCount > 0) {
            const item1 = items[1];
            const titleM = item1.match(/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is);
            const linkM = item1.match(/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is) || item1.match(/<link[^>]+href=["']([^"']+)["']/i);
            const pubDateM = item1.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is) || item1.match(/<updated>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/updated>/is) || item1.match(/<published>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/published>/is);
            const mediaM = item1.match(/<media:content[^>]+url=["']([^"']+)["']/i) || item1.match(/<enclosure[^>]+url=["']([^"']+)["']/i);
            const descM = item1.match(/<description>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/description>/is) || item1.match(/<content[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/content>/is);
            const imgInDesc = descM ? (descM[1].match(/<img[^>]+src=["']([^"']+)["']/i) || descM[1].match(/&lt;img[^>]+src=["']([^"']+)["']/i)) : null;

            sample = {
              title: titleM ? titleM[1].replace(/<[^>]+>/g, '').trim() : null,
              link: linkM ? (linkM[1] || linkM[0]).trim() : null,
              pubDate: pubDateM ? pubDateM[1].trim() : null,
              image: mediaM ? mediaM[1] : (imgInDesc ? imgInDesc[1] : null)
            };
          }

          resolve({
            name,
            url,
            status: res.statusCode,
            isXml,
            isJson,
            itemCount,
            sample,
            rawPreview: body.substring(0, 150)
          });
        });
      });

      req.on('error', (err) => {
        resolve({ name, url, status: 0, error: err.message, itemCount: 0 });
      });
      req.on('timeout', () => {
        req.destroy();
        resolve({ name, url, status: 408, error: 'timeout', itemCount: 0 });
      });
    } catch (e) {
      resolve({ name, url, status: 0, error: e.message, itemCount: 0 });
    }
  });
}

async function testAll() {
  console.log('--- TESTING PAKISTANI NEWS PROVIDERS ---');
  const pkFeeds = [
    { name: 'Dawn Technology RSS', url: 'https://www.dawn.com/feeds/tech/' },
    { name: 'Dawn Business RSS', url: 'https://www.dawn.com/feeds/business/' },
    { name: 'Dawn Pakistan RSS', url: 'https://www.dawn.com/feeds/pakistan/' },
    { name: 'Dawn Home RSS', url: 'https://www.dawn.com/feeds/home/' },
    { name: 'The Express Tribune Tech', url: 'https://tribune.com.pk/feed/technology' },
    { name: 'The Express Tribune Business', url: 'https://tribune.com.pk/feed/business' },
    { name: 'ProPakistani RSS', url: 'https://propakistani.pk/feed/' },
    { name: 'ProPakistani Telecom RSS', url: 'https://propakistani.pk/category/telecom/feed/' },
    { name: 'Geo News Tech RSS', url: 'https://www.geo.tv/rss/1/5' },
    { name: 'Geo News Pakistan RSS', url: 'https://www.geo.tv/rss/1/1' },
    { name: 'Business Recorder Latest', url: 'https://www.brecorder.com/feeds/latest-news/' },
    { name: 'Business Recorder Tech', url: 'https://www.brecorder.com/feeds/technology/' }
  ];

  for (const f of pkFeeds) {
    const res = await probeFeed(f.name, f.url);
    console.log(`[${res.name}] HTTP ${res.status} | Items: ${res.itemCount}`);
    if (res.sample) {
      console.log(`   Title:   ${res.sample.title}`);
      console.log(`   Link:    ${res.sample.link}`);
      console.log(`   PubDate: ${res.sample.pubDate}`);
      console.log(`   Image:   ${res.sample.image || 'NO IMAGE'}`);
    } else if (res.error) {
      console.log(`   Error:   ${res.error}`);
    }
  }

  console.log('\n--- TESTING INTERNATIONAL NEWS PROVIDERS ---');
  const intFeeds = [
    { name: 'Google Official Blog', url: 'https://blog.google/rss/' },
    { name: 'Ars Technica', url: 'https://feeds.arstechnica.com/arstechnica/index' },
    { name: 'TechCrunch', url: 'https://techcrunch.com/feed/' },
    { name: 'BBC News Technology', url: 'https://feeds.bbci.co.uk/news/technology/rss.xml' },
    { name: 'The Verge', url: 'https://www.theverge.com/rss/index.xml' },
    { name: 'Wired', url: 'https://www.wired.com/feed/rss' }
  ];

  for (const f of intFeeds) {
    const res = await probeFeed(f.name, f.url);
    console.log(`[${res.name}] HTTP ${res.status} | Items: ${res.itemCount}`);
    if (res.sample) {
      console.log(`   Title:   ${res.sample.title}`);
      console.log(`   Link:    ${res.sample.link}`);
      console.log(`   PubDate: ${res.sample.pubDate}`);
      console.log(`   Image:   ${res.sample.image || 'NO IMAGE'}`);
    } else if (res.error) {
      console.log(`   Error:   ${res.error}`);
    }
  }
}

testAll();
