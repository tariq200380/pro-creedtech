import https from 'https';

function fetchFeed(url) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' } }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve(d));
    }).on('error', () => resolve(''));
  });
}

function checkImageReachability(url) {
  return new Promise((resolve) => {
    try {
      const u = new URL(url);
      https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0' }, timeout: 6000 }, (res) => {
        resolve({ status: res.statusCode, mime: res.headers['content-type'] });
      }).on('error', e => resolve({ status: 0, error: e.message }));
    } catch (e) {
      resolve({ status: 0, error: e.message });
    }
  });
}

async function inspectFeeds() {
  console.log('====================================================');
  console.log('1. INSPECTING APPLE NEWSROOM FEED ITEMS FOR IMAGES');
  console.log('====================================================');
  const appleXml = await fetchFeed('https://www.apple.com/newsroom/rss-feed.rss');
  const appleItems = appleXml.split(/<item[\s>]/i);
  console.log('Apple total items:', appleItems.length - 1);
  for (let i = 1; i < Math.min(appleItems.length, 10); i++) {
    const it = appleItems[i];
    const title = (it.match(/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is) || [])[1];
    const link = (it.match(/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is) || [])[1];
    const guid = (it.match(/<guid[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/guid>/is) || [])[1];
    const pubDate = (it.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is) || [])[1];
    const media = (it.match(/<media:content[^>]+url=["']([^"']+)["']/i) || [])[1];
    const enc = (it.match(/<enclosure[^>]+url=["']([^"']+)["']/i) || [])[1];
    const imgM = (it.match(/<img[^>]+src=["']([^"']+)["']/i) || it.match(/&lt;img[^>]+src=["']([^"']+)["']/i) || [])[1];

    console.log(`\n--- Apple Item ${i} ---`);
    console.log('Title:  ', title ? title.trim() : 'N/A');
    console.log('Link:   ', link ? link.trim() : 'N/A');
    console.log('PubDate:', pubDate ? pubDate.trim() : 'N/A');
    console.log('Images: ', { media, enc, imgM });
    if (it.includes('<description>')) {
      const desc = it.match(/<description>(.*?)<\/description>/is)[1];
      console.log('Desc preview:', desc.substring(0, 200));
    }
  }

  console.log('\n====================================================');
  console.log('2. INSPECTING OPENAI FEED ITEMS FOR IMAGES');
  console.log('====================================================');
  const openaiXml = await fetchFeed('https://openai.com/news/rss.xml');
  const openaiItems = openaiXml.split(/<item[\s>]/i);
  console.log('OpenAI total items:', openaiItems.length - 1);
  for (let i = 1; i < Math.min(openaiItems.length, 10); i++) {
    const it = openaiItems[i];
    const title = (it.match(/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is) || [])[1];
    const link = (it.match(/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is) || [])[1];
    const pubDate = (it.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is) || [])[1];
    const media = (it.match(/<media:content[^>]+url=["']([^"']+)["']/i) || [])[1];
    const enc = (it.match(/<enclosure[^>]+url=["']([^"']+)["']/i) || [])[1];
    const imgM = (it.match(/<img[^>]+src=["']([^"']+)["']/i) || it.match(/&lt;img[^>]+src=["']([^"']+)["']/i) || [])[1];

    console.log(`\n--- OpenAI Item ${i} ---`);
    console.log('Title:  ', title ? title.trim() : 'N/A');
    console.log('Link:   ', link ? link.trim() : 'N/A');
    console.log('PubDate:', pubDate ? pubDate.trim() : 'N/A');
    console.log('Images: ', { media, enc, imgM });
    if (it.includes('<description>')) {
      const desc = it.match(/<description>(.*?)<\/description>/is)[1];
      console.log('Desc preview:', desc.substring(0, 200));
    }
  }

  console.log('\n====================================================');
  console.log('3. INSPECTING ANTHROPIC FEED ITEMS FOR IMAGES');
  console.log('====================================================');
  const anthropicXml = await fetchFeed('https://news.google.com/rss/search?q=when:7d+site:anthropic.com+OR+Anthropic+Claude&hl=en-US&gl=US&ceid=US:en');
  const anthropicItems = anthropicXml.split(/<item[\s>]/i);
  console.log('Anthropic total items:', anthropicItems.length - 1);
  for (let i = 1; i < Math.min(anthropicItems.length, 10); i++) {
    const it = anthropicItems[i];
    const title = (it.match(/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is) || [])[1];
    const link = (it.match(/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is) || [])[1];
    const pubDate = (it.match(/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is) || [])[1];
    const media = (it.match(/<media:content[^>]+url=["']([^"']+)["']/i) || [])[1];
    const enc = (it.match(/<enclosure[^>]+url=["']([^"']+)["']/i) || [])[1];
    const imgM = (it.match(/<img[^>]+src=["']([^"']+)["']/i) || it.match(/&lt;img[^>]+src=["']([^"']+)["']/i) || [])[1];

    console.log(`\n--- Anthropic Item ${i} ---`);
    console.log('Title:  ', title ? title.trim() : 'N/A');
    console.log('Link:   ', link ? link.trim() : 'N/A');
    console.log('PubDate:', pubDate ? pubDate.trim() : 'N/A');
    console.log('Images: ', { media, enc, imgM });
  }
}

inspectFeeds();
