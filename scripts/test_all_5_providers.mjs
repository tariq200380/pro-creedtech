import https from 'https';

function fetchFeed(url) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' } }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, data: d }));
    }).on('error', e => resolve({ status: 0, error: e.message }));
  });
}

function parseItem(itemStr, prov) {
  const titleM = itemStr.match(/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is);
  const linkM = itemStr.match(/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is) || itemStr.match(/<link[^>]+href=["']([^"']+)["']/i);
  const pubDateM = itemStr.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is) || itemStr.match(/<updated>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/updated>/is);
  const mediaM = itemStr.match(/<media:content[^>]+url=["']([^"']+)["']/i) || itemStr.match(/<enclosure[^>]+url=["']([^"']+)["']/i);
  const imgM = itemStr.match(/<img[^>]+src=["']([^"']+)["']/i) || itemStr.match(/&lt;img[^>]+src=["']([^"']+)["']/i);

  return {
    provider: prov,
    title: titleM ? titleM[1].replace(/<[^>]+>/g, '').trim() : 'N/A',
    link: linkM ? (linkM[1] || linkM[0]).trim() : 'N/A',
    pubDate: pubDateM ? pubDateM[1].trim() : 'N/A',
    image: mediaM ? mediaM[1] : (imgM ? imgM[1] : null)
  };
}

async function testAll5() {
  const feeds = {
    google: 'https://blog.google/rss/',
    apple: 'https://www.apple.com/newsroom/rss-feed.rss',
    nvidia: 'https://blogs.nvidia.com/feed/',
    anthropic: 'https://news.google.com/rss/search?q=when:7d+site:anthropic.com+OR+Anthropic+Claude&hl=en-US&gl=US&ceid=US:en',
    openai: 'https://openai.com/news/rss.xml'
  };

  for (const [p, u] of Object.entries(feeds)) {
    const res = await fetchFeed(u);
    console.log(`[${p.toUpperCase()}] HTTP ${res.status}`);
    if (res.status === 200 && res.data) {
      const items = res.data.split(/<item[\s>]|<entry[\s>]/i);
      if (items.length > 1) {
        const item = parseItem(items[1], p);
        console.log('  Headline: ', item.title);
        console.log('  Link:     ', item.link);
        console.log('  PubDate:  ', item.pubDate);
        console.log('  Image:    ', item.image || '(Fallback)');
      }
    }
  }
}

testAll5();
