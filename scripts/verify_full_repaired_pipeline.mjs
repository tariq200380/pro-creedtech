import http from 'http';
import https from 'https';

function get(url) {
  return new Promise((resolve) => {
    try {
      const parsed = new URL(url);
      const client = parsed.protocol === 'https:' ? https : http;
      const req = client.get(url, {
        headers: {
          'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'
        },
        timeout: 10000
      }, (res) => {
        let body = '';
        res.on('data', c => body += c);
        res.on('end', () => resolve({ status: res.statusCode, headers: res.headers, body }));
      });
      req.on('error', (e) => resolve({ status: 0, error: e.message }));
      req.on('timeout', () => { req.destroy(); resolve({ status: 408, error: 'timeout' }); });
    } catch (e) {
      resolve({ status: 0, error: e.message });
    }
  });
}

async function verifyFullPipeline() {
  console.log('========================================================================================');
  console.log('       MULTI-PROVIDER VERIFIED LIVE NEWS & REGIONAL INTEGRATION VERIFICATION            ');
  console.log('========================================================================================\n');

  console.log('[1] Fetching live AJAX response from /ajax/live_tech_news.php?refresh=1...');
  const ajaxRes = await get('http://localhost:3000/ajax/live_tech_news.php?refresh=1');
  console.log(`HTTP Status: ${ajaxRes.status}`);
  const json = JSON.parse(ajaxRes.body);

  console.log(`\nFeed Mode                  : ${json.mode}`);
  console.log(`Pakistani Articles Imported : ${Object.keys(json.regional_wires).length}`);
  console.log(`International Articles      : ${json.breaking_news.length} (+ ${Object.keys(json.brand_wires).length} Google stories)`);

  console.log('\n[2] Auditing Published Pakistani News Items:');
  for (const [key, item] of Object.entries(json.regional_wires)) {
    console.log(`\n   [Provider: ${key.toUpperCase()}]`);
    console.log(`   Headline : ${item.title}`);
    console.log(`   Source   : ${item.sourceName}`);
    console.log(`   Link     : ${item.sourceUrl}`);
    console.log(`   PubDate  : ${item.date}`);
    console.log(`   Image    : ${item.image}`);

    const linkRes = await get(item.sourceUrl);
    console.log(`   Link Reachability  : HTTP ${linkRes.status} ${linkRes.status >= 200 && linkRes.status < 400 ? '✅' : '❌'}`);

    if (item.image && item.image.startsWith('http')) {
      const imgRes = await get(item.image);
      console.log(`   Image Reachability : HTTP ${imgRes.status} ${imgRes.status === 200 ? '✅' : '❌'}`);
    } else {
      console.log(`   Image Reachability : Local Branded Fallback (${item.image}) ✅`);
    }
  }

  console.log('\n[3] Auditing Published International News Items:');
  for (let i = 0; i < json.breaking_news.length; i++) {
    const item = json.breaking_news[i];
    console.log(`\n   [Story ${i + 1} - ${item.provider.toUpperCase()}]`);
    console.log(`   Headline : ${item.title}`);
    console.log(`   Source   : ${item.source}`);
    console.log(`   Link     : ${item.link}`);
    console.log(`   PubDate  : ${item.date}`);
    console.log(`   Image    : ${item.img}`);

    const linkRes = await get(item.link);
    console.log(`   Link Reachability  : HTTP ${linkRes.status} ${linkRes.status >= 200 && linkRes.status < 400 ? '✅' : '❌'}`);

    if (item.img && item.img.startsWith('http')) {
      const imgRes = await get(item.img);
      console.log(`   Image Reachability : HTTP ${imgRes.status} ${imgRes.status === 200 ? '✅' : '❌'}`);
    }
  }

  console.log('\n[4] Inspecting Public Page /knowledge-center.php Rendered HTML...');
  const pageRes = await get('http://localhost:3000/knowledge-center.php');
  console.log(`Page HTTP Status: ${pageRes.status}`);

  const hasWireImg = pageRes.body.includes('id="wireImg"');
  const hasRegImg = pageRes.body.includes('id="regImg"');
  const hasMainNewsImg = pageRes.body.includes('id="mainNewsImg"');

  console.log(`Rendered Wire Showcase Card      : ${hasWireImg ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Rendered Regional Wire Card      : ${hasRegImg ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Rendered Breaking News Card      : ${hasMainNewsImg ? 'YES ✅' : 'NO ❌'}`);

  const hasDawn = pageRes.body.includes('Japan mission aims for the moons of Mars');
  const hasBrecorder = pageRes.body.includes('Expansion beyond gold');
  const hasGoogle = pageRes.body.includes('Get closer to the game with Gemini and Pixel');
  const hasArs = pageRes.body.includes('gasolini-ar1') || pageRes.body.includes('trebuchet');

  console.log(`Genuine Dawn Article Rendered    : ${hasDawn ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Genuine B-Recorder Article       : ${hasBrecorder ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Genuine Google Article           : ${hasGoogle ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Genuine Ars Technica Article     : ${hasArs ? 'YES ✅' : 'NO ❌'}`);

  const hasMockUnsplash = pageRes.body.includes('photo-1518770660439-4636190af475');
  const hasMockOpenAI = pageRes.body.includes('Strawberry Chain-of-Thought');

  console.log(`Mock Unsplash Placeholder in Live: ${hasMockUnsplash ? 'YES ❌' : 'NO (Clean) ✅'}`);
  console.log(`Mock OpenAI Story in Live        : ${hasMockOpenAI ? 'YES ❌' : 'NO (Clean) ✅'}`);

  console.log('\n========================================================================================');
  if (hasDawn && hasGoogle && !hasMockUnsplash && !hasMockOpenAI && pageRes.status === 200) {
    console.log('FINAL STATUS: MULTI-PROVIDER REAL NEWS VERIFIED ✅');
  } else {
    console.log('FINAL STATUS: STILL NOT VERIFIED ❌');
  }
  console.log('========================================================================================\n');
}

verifyFullPipeline();
