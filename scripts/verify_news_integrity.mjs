import http from 'http';
import https from 'https';

function get(url) {
  return new Promise((resolve) => {
    const client = url.startsWith('https') ? https : http;
    const req = client.get(url, {
      headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'
      }
    }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, headers: res.headers, body: d }));
    });
    req.on('error', (e) => resolve({ status: 0, error: e.message }));
  });
}

async function verifyAll() {
  console.log('======================================================');
  console.log('   STRICT VERIFIED NEWS PIPELINE INTEGRITY CHECK      ');
  console.log('======================================================\n');

  const ajax = await get('http://localhost:3000/ajax/live_tech_news.php?refresh=1');
  const feed = JSON.parse(ajax.body);

  console.log(`[1] Live Feed Mode: ${feed.mode} (Status: ${feed.status})`);
  console.log(`    Total Verified Brand Wires    : ${Object.keys(feed.brand_wires).length}`);
  console.log(`    Total Quarantined Regional    : ${Object.keys(feed.regional_wires).length} (Excluded)`);
  console.log(`    Total Verified Breaking News  : ${feed.breaking_news.length}\n`);

  console.log('[2] Testing Reachability of All Published Article Links...');
  let allLinksOk = true;
  for (const item of feed.breaking_news) {
    const linkRes = await get(item.link);
    const ok = (linkRes.status >= 200 && linkRes.status < 400);
    console.log(`    [HTTP ${linkRes.status}] ${item.title.substring(0, 50)}... -> ${item.link}`);
    if (!ok) allLinksOk = false;
  }

  console.log('\n[3] Testing Reachability of All Published Article Images...');
  let allImagesOk = true;
  for (const item of feed.breaking_news) {
    const imgRes = await get(item.img);
    const ok = (imgRes.status === 200);
    console.log(`    [HTTP ${imgRes.status}] ${item.img}`);
    if (!ok) allImagesOk = false;
  }

  console.log('\n[4] Inspecting Rendered Public Page Markup (/knowledge-center.php)...');
  const page = await get('http://localhost:3000/knowledge-center.php');
  
  // Check breaking news section
  const newsSection = page.body.substring(page.body.indexOf('LATEST IT & BUSINESS NEWS'), page.body.indexOf('MAIN EDITORIAL'));
  const hasUnsplashInNews = newsSection.includes('unsplash.com');
  console.log(`    Unsplash in Live News Section : ${hasUnsplashInNews ? 'YES ❌' : 'NO ✅'}`);

  const hasMockRegional = page.body.includes('PTA Mandates') || page.body.includes('Jazz Completes');
  console.log(`    Mock Regional in Public HTML : ${hasMockRegional ? 'YES ❌' : 'NO ✅'}`);

  const hasMockOpenAI = page.body.includes('Strawberry Chain-of-Thought');
  console.log(`    Mock OpenAI in Public HTML   : ${hasMockOpenAI ? 'YES ❌' : 'NO ✅'}`);

  console.log('\n======================================================');
  if (allLinksOk && allImagesOk && !hasUnsplashInNews && !hasMockRegional && !hasMockOpenAI) {
    console.log('FINAL STATUS: REAL PROVIDER NEWS VERIFIED ✅');
  } else {
    console.log('FINAL STATUS: STILL NOT VERIFIED ❌');
  }
  console.log('======================================================\n');
}

verifyAll();
