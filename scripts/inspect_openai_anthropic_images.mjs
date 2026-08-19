import https from 'https';

function checkUrl(url) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' } }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, data: d, headers: res.headers }));
    }).on('error', e => resolve({ status: 0, error: e.message }));
  });
}

async function inspectOpenAIAndAnthropic() {
  console.log('--- Checking OpenAI article payload & images ---');
  // Let's check OpenAI newsroom payload or image URL pattern
  // OpenAI articles on openai.com/index/the-defenders-window have images on images.ctfassets.net or openai cdn
  const oai = await checkUrl('https://openai.com/index/the-defenders-window');
  console.log('OpenAI Article Page status:', oai.status, 'Length:', oai.data.length);
  if (oai.data) {
    const ogImg = oai.data.match(/<meta[^>]+property=["']og:image["'][^>]+content=["']([^"']+)["']/i) || oai.data.match(/<meta[^>]+content=["']([^"']+)["'][^>]+property=["']og:image["']/i);
    const twitterImg = oai.data.match(/<meta[^>]+name=["']twitter:image["'][^>]+content=["']([^"']+)["']/i);
    const ctfImages = oai.data.match(/https:\/\/(?:images\.ctfassets\.net|openaicom-cdn\.azureedge\.net|cdn\.openai\.com)[^\s"'>]+/g);
    console.log('OpenAI og:image:', ogImg ? ogImg[1] : 'none');
    console.log('OpenAI twitter:image:', twitterImg ? twitterImg[1] : 'none');
    console.log('OpenAI CDN images found:', ctfImages ? ctfImages.slice(0, 3) : 'none');
  }

  console.log('\n--- Checking Anthropic article payload & images ---');
  // For Anthropic watermarking article: https://www.anthropic.com/research/watermarking
  const ant = await checkUrl('https://www.anthropic.com/news/watermarking');
  const antRes = await checkUrl('https://www.anthropic.com/research/watermarking');
  console.log('Anthropic /news/watermarking status:', ant.status);
  console.log('Anthropic /research/watermarking status:', antRes.status);
  const antData = antRes.data || ant.data || '';
  if (antData) {
    const ogImg = antData.match(/<meta[^>]+property=["']og:image["'][^>]+content=["']([^"']+)["']/i) || antData.match(/<meta[^>]+content=["']([^"']+)["'][^>]+property=["']og:image["']/i);
    const cdnImages = antData.match(/https:\/\/(?:www-cdn\.anthropic\.com|cdn\.anthropic\.com)[^\s"'>]+/g);
    console.log('Anthropic og:image:', ogImg ? ogImg[1] : 'none');
    console.log('Anthropic CDN images found:', cdnImages ? cdnImages.slice(0, 3) : 'none');
  }
}

inspectOpenAIAndAnthropic();
