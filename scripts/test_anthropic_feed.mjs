import https from 'https';

function getFeed(url) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' } }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve(d));
    }).on('error', () => resolve(''));
  });
}

async function run() {
  console.log('--- OPTION A: Google News RSS for Anthropic ---');
  const gn = await getFeed('https://news.google.com/rss/search?q=Anthropic+Claude&hl=en-US&gl=US&ceid=US:en');
  const items = gn.split(/<item[\s>]/i);
  if (items.length > 1) {
    const title = items[1].match(/<title[^>]*>(.*?)<\/title>/is);
    const link = items[1].match(/<link[^>]*>(.*?)<\/link>/is);
    const pubDate = items[1].match(/<pubDate>(.*?)<\/pubDate>/is);
    console.log('Title:', title ? title[1] : '');
    console.log('Link:', link ? link[1] : '');
    console.log('PubDate:', pubDate ? pubDate[1] : '');
  }

  console.log('\n--- OPTION B: Anthropic GitHub Official Atom ---');
  const gh = await getFeed('https://github.com/anthropics/anthropic-sdk-python/releases.atom');
  const entries = gh.split(/<entry[\s>]/i);
  if (entries.length > 1) {
    const title = entries[1].match(/<title[^>]*>(.*?)<\/title>/is);
    const link = entries[1].match(/<link[^>]+href=["']([^"']+)["']/i);
    const updated = entries[1].match(/<updated>(.*?)<\/updated>/is);
    console.log('Title:', title ? title[1] : '');
    console.log('Link:', link ? link[1] : '');
    console.log('PubDate:', updated ? updated[1] : '');
  }
}

run();
