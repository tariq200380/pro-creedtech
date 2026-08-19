import https from 'https';

function get(url) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' } }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, data: d }));
    }).on('error', e => resolve({ status: 0, error: e.message }));
  });
}

async function testExtraction() {
  console.log('=== 1. APPLE NEWSROOM HERO IMAGE ===');
  const appleFeed = await get('https://www.apple.com/newsroom/rss-feed.rss');
  const appleM = appleFeed.data.match(/<link[^>]+href=["']([^"']+)["'][^>]+rel=["']enclosure["']/i);
  console.log('Apple enclosure image:', appleM ? appleM[1] : 'NONE');

  console.log('\n=== 2. OPENAI HERO IMAGE ===');
  const oaiPage = await get('https://openai.com/index/the-defenders-window/');
  let oaiImg = null;
  const oaiMetaM = oaiPage.data.match(/<meta[^>]+property=["']og:image["'][^>]+content=["']([^"']+)["']/i) || oaiPage.data.match(/<meta[^>]+content=["']([^"']+)["'][^>]+property=["']og:image["']/i);
  if (oaiMetaM) oaiImg = oaiMetaM[1];
  console.log('OpenAI og:image:', oaiImg);

  console.log('\n=== 3. ANTHROPIC HERO IMAGE ===');
  const antRes = await get('https://news.google.com/rss/search?q=when:7d+site:anthropic.com+OR+Anthropic+Claude&hl=en-US&gl=US&ceid=US:en');
  // Or check Anthropic research page / cdn
  const antPage = await get('https://www.anthropic.com/news');
  let antImg = null;
  const antMetaM = antPage.data.match(/<meta[^>]+property=["']og:image["'][^>]+content=["']([^"']+)["']/i) || antPage.data.match(/<meta[^>]+content=["']([^"']+)["'][^>]+property=["']og:image["']/i);
  if (antMetaM) antImg = antMetaM[1];
  console.log('Anthropic og:image from official site:', antImg);

  // Check HTTP reachability of all 3
  if (appleM) {
    const r = await get(appleM[1]);
    console.log(`Apple image reachability: HTTP ${r.status}`);
  }
  if (oaiImg) {
    const r = await get(oaiImg);
    console.log(`OpenAI image reachability: HTTP ${r.status}`);
  }
  if (antImg) {
    const r = await get(antImg);
    console.log(`Anthropic image reachability: HTTP ${r.status}`);
  }
}

testExtraction();
