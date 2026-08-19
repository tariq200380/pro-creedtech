import https from 'https';

function fetchUrl(url, headers = {}) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', ...headers } }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, data: d, headers: res.headers }));
    }).on('error', e => resolve({ status: 0, error: e.message }));
  });
}

async function inspectDetail() {
  console.log('=== 1. INSPECTING OPENAI ARTICLE PAYLOAD ===');
  // Check OpenAI article HTML and JSON metadata
  const oaiHtml = await fetchUrl('https://openai.com/index/the-defenders-window/');
  console.log('OpenAI HTTP:', oaiHtml.status, 'Length:', oaiHtml.data.length);
  // Find all images on this exact OpenAI article
  const oaiImgs = oaiHtml.data.match(/https:\/\/(?:images\.ctfassets\.net|cdn\.openai\.com|openaicom-cdn\.azureedge\.net)[^\s"'<>)]+/g);
  console.log('OpenAI specific images found in article:', Array.from(new Set(oaiImgs || [])));

  console.log('\n=== 2. INSPECTING ANTHROPIC ARTICLE PAYLOAD ===');
  // Check Anthropic articles
  const antPages = [
    'https://www.anthropic.com/news',
    'https://www.anthropic.com/research',
    'https://www.anthropic.com/news/watermarking',
    'https://www.anthropic.com/research/watermarking'
  ];
  for (const u of antPages) {
    const res = await fetchUrl(u);
    console.log(`Anthropic ${u} -> Status ${res.status}`);
    if (res.status === 200) {
      const sanityImgs = res.data.match(/https:\/\/cdn\.sanity\.io\/images\/[^\s"'<>)]+/g);
      console.log('  Sanity images found:', Array.from(new Set(sanityImgs || [])).slice(0, 3));
    }
  }

  // Let's also check Anthropic releases atom or news feed
  const antAtom = await fetchUrl('https://raw.githubusercontent.com/anthropics/anthropic-sdk-python/main/README.md');
  console.log('Anthropic GitHub README status:', antAtom.status);
}

inspectDetail();
