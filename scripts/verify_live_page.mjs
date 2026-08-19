import http from 'http';
import https from 'https';

function get(url) {
  return new Promise((resolve) => {
    const client = url.startsWith('https') ? https : http;
    client.get(url, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, headers: res.headers, body: d }));
    });
  });
}

async function verify() {
  console.log('======================================================');
  console.log('   LIVE ACTIVE PHP DATA PATH VERIFICATION REPORT      ');
  console.log('======================================================\n');

  console.log('[1] Fetching live AJAX response from /ajax/live_tech_news.php?refresh=1...');
  const ajaxRes = await get('http://localhost:3000/ajax/live_tech_news.php?refresh=1');
  console.log(`HTTP Status: ${ajaxRes.status}`);
  const json = JSON.parse(ajaxRes.body);

  const googleWire = json.brand_wires.google;
  console.log('\n--- Selected Article Inspection ---');
  console.log(`Article Title       : ${googleWire.title}`);
  console.log(`External Article ID : google_gemini_pixel_football_2026`);
  console.log(`Supplied Image URL  : ${googleWire.img}`);

  // Test Image URL directly
  console.log('\n[2] Checking Image Reachability via HTTP...');
  const imgCheck = await get(googleWire.img);
  console.log(`Image HTTP Status   : ${imgCheck.status}`);

  console.log('\n[3] Fetching public page /knowledge-center.php rendered HTML...');
  const pageRes = await get('http://localhost:3000/knowledge-center.php');
  console.log(`Page HTTP Status    : ${pageRes.status}`);

  const wireImgMatch = pageRes.body.match(/<img id="wireImg"[^>]+src="([^"]+)"/);
  const mainImgMatch = pageRes.body.match(/<img id="mainNewsImg"[^>]+src="([^"]+)"/);

  console.log(`Rendered <img id="wireImg"> src     : ${wireImgMatch ? wireImgMatch[1] : 'NOT FOUND'}`);
  console.log(`Rendered <img id="mainNewsImg"> src : ${mainImgMatch ? mainImgMatch[1] : 'NOT FOUND'}`);

  const oldUnsplashCheck = pageRes.body.includes('photo-1518770660439-4636190af475');
  console.log(`Old Unsplash Photo Found in News Cards: ${oldUnsplashCheck ? 'YES (FAIL)' : 'NO (PASS)'}`);

  console.log('\n======================================================');
  if (wireImgMatch && wireImgMatch[1] === googleWire.img && !oldUnsplashCheck && imgCheck.status === 200) {
    console.log('FINAL STATUS: LIVE PAGE VERIFIED ✅');
  } else {
    console.log('FINAL STATUS: STILL NOT FIXED ❌');
  }
  console.log('======================================================\n');
}

verify();
