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
          resolve({ name, url, status: res.statusCode, length: body.length, body });
        });
      });
      req.on('error', (err) => resolve({ name, url, status: 0, error: err.message }));
      req.on('timeout', () => { req.destroy(); resolve({ name, url, status: 408, error: 'timeout' }); });
    } catch (e) {
      resolve({ name, url, status: 0, error: e.message });
    }
  });
}

async function testAll() {
  console.log('================================================================');
  console.log('       1. INSPECTING EXPRESS TRIBUNE SPACEX ARTICLE PAYLOAD     ');
  console.log('================================================================');
  const trib = await probeFeed('Express Tribune Tech', 'https://tribune.com.pk/feed/technology');
  console.log(`Tribune Status: ${trib.status} | Length: ${trib.length}`);
  if (trib.body) {
    const items = trib.body.split(/<item[\s>]/i);
    for (let i = 1; i < items.length; i++) {
      if (items[i].includes('SpaceX') || items[i].includes('Falcon 9')) {
        console.log(`\n--- FOUND SPACEX ITEM (Index ${i}) ---`);
        console.log(items[i]);
      }
    }
  }

  console.log('\n================================================================');
  console.log('       2. TESTING 5 INTERNATIONAL PROVIDERS                     ');
  console.log('================================================================');
  const candidates = [
    // 1. Google
    { provider: 'google', name: 'Google The Keyword', url: 'https://blog.google/rss/' },
    // 2. Apple
    { provider: 'apple', name: 'Apple Newsroom RSS', url: 'https://www.apple.com/newsroom/rss-feed.rss' },
    // 3. NVIDIA
    { provider: 'nvidia', name: 'NVIDIA Official Blog', url: 'https://blogs.nvidia.com/feed/' },
    { provider: 'nvidia', name: 'NVIDIA Newsroom', url: 'https://nvidianews.nvidia.com/rss.xml' },
    // 4. Anthropic
    { provider: 'anthropic', name: 'Anthropic Research Feed', url: 'https://www.anthropic.com/feed' },
    { provider: 'anthropic', name: 'Anthropic News Feed', url: 'https://www.anthropic.com/news/feed' },
    { provider: 'anthropic', name: 'Anthropic RSS XML', url: 'https://www.anthropic.com/rss.xml' },
    { provider: 'anthropic', name: 'Anthropic News XML', url: 'https://www.anthropic.com/news.xml' },
    // 5. OpenAI
    { provider: 'openai', name: 'OpenAI News RSS', url: 'https://openai.com/news/rss.xml' },
    { provider: 'openai', name: 'OpenAI Blog RSS', url: 'https://openai.com/blog/rss.xml' },
    { provider: 'openai', name: 'OpenAI Feed XML', url: 'https://openai.com/feed.xml' }
  ];

  for (const c of candidates) {
    const r = await probeFeed(c.name, c.url);
    console.log(`\n[${c.provider.toUpperCase()} : ${c.name}] HTTP ${r.status} | Length: ${r.length || 0} ${r.error ? '| Error: ' + r.error : ''}`);
    if (r.body && r.body.length > 0) {
      const items = r.body.split(/<item[\s>]|<entry[\s>]/i);
      console.log(`   Total items in feed: ${items.length - 1}`);
      if (items.length > 1) {
        const item1 = items[1];
        const titleM = item1.match(/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is);
        const linkM = item1.match(/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is) || item1.match(/<link[^>]+href=["']([^"']+)["']/i);
        const pubDateM = item1.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is) || item1.match(/<updated>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/updated>/is) || item1.match(/<published>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/published>/is);
        const mediaM = item1.match(/<media:content[^>]+url=["']([^"']+)["']/i) || item1.match(/<enclosure[^>]+url=["']([^"']+)["']/i) || item1.match(/<media:thumbnail[^>]+url=["']([^"']+)["']/i);
        const imgInDesc = item1.match(/<img[^>]+src=["']([^"']+)["']/i) || item1.match(/&lt;img[^>]+src=["']([^"']+)["']/i);

        console.log(`   Latest Title   : ${titleM ? titleM[1].replace(/<[^>]+>/g, '').trim() : 'N/A'}`);
        console.log(`   Latest Link    : ${linkM ? (linkM[1] || linkM[0]).trim() : 'N/A'}`);
        console.log(`   Latest PubDate : ${pubDateM ? pubDateM[1].trim() : 'N/A'}`);
        console.log(`   Latest Image   : ${mediaM ? mediaM[1] : (imgInDesc ? imgInDesc[1] : 'NONE IN PAYLOAD')}`);
      }
    }
  }
}

testAll();
