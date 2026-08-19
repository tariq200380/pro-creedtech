import http from 'http';

function get(url) {
  return new Promise((resolve) => {
    http.get(url, { headers: { 'User-Agent': 'Mozilla/5.0' } }, (res) => {
      let b = '';
      res.on('data', c => b += c);
      res.on('end', () => resolve({ status: res.statusCode, body: b }));
    }).on('error', e => resolve({ status: 0, error: e.message }));
  });
}

async function verify() {
  console.log('========================================================================');
  console.log('            5-PROVIDER DIVERSE VERIFICATION & PUBLIC PAGE AUDIT         ');
  console.log('========================================================================\n');

  console.log('[1] Fetching live AJAX response from /ajax/live_tech_news.php?refresh=1...');
  const ajax = await get('http://localhost:3000/ajax/live_tech_news.php?refresh=1');
  console.log(`HTTP Status: ${ajax.status}`);
  const json = JSON.parse(ajax.body);

  console.log('\n--- LIVE AJAX JSON COUNTS ---');
  console.log(JSON.stringify(json.counts, null, 2));

  console.log('\n--- PROVIDER BREAKDOWN IN BREAKING NEWS ---');
  const counts = { google: 0, apple: 0, nvidia: 0, anthropic: 0, openai: 0 };
  json.breaking_news.forEach((it, idx) => {
    counts[it.provider] = (counts[it.provider] || 0) + 1;
    console.log(`Item ${idx + 1} | Provider: ${it.provider.toUpperCase().padEnd(10)} | Headline: ${it.title}`);
  });

  console.log('\n--- BRAND WIRES TABS (5 PROVIDERS) ---');
  for (const [k, v] of Object.entries(json.brand_wires)) {
    console.log(`Tab: ${k.toUpperCase().padEnd(10)} | Badge: ${v.brandBadge} | Title: ${v.title}`);
  }

  console.log('\n--- PAKISTANI REGIONAL WIRES (4 PROVIDERS) ---');
  for (const [k, v] of Object.entries(json.regional_wires)) {
    console.log(`Tab: ${k.toUpperCase().padEnd(12)} | Image: ${v.image} | Title: ${v.title}`);
  }

  console.log('\n[2] Fetching rendered HTML from /knowledge-center.php...');
  const page = await get('http://localhost:3000/knowledge-center.php');
  console.log(`Page Status: ${page.status}`);

  const checks = {
    'Google Card Rendered': page.body.includes('Get closer to the game with Gemini and Pixel'),
    'NVIDIA Card Rendered': page.body.includes('Securing the Infrastructure of Intelligence'),
    'OpenAI Card Rendered': page.body.includes('The Defender’s Window'),
    'Anthropic Card Rendered': page.body.includes("How Claude's text watermarking works"),
    'Apple Card Rendered': page.body.includes('Apple opens Advanced Manufacturing Center') || page.body.includes('Apple opens Manufacturing Center'),
    'Express Tribune SpaceX Image Correct': page.body.includes('spacex1786870960-0.jpg'),
    'Dawn Story Preserved': page.body.includes('Japan mission aims for the moons of Mars'),
    'B-Recorder Story Preserved': page.body.includes('Expansion beyond gold'),
    'ProPakistani Story Preserved': page.body.includes('Islamabad Technology Park')
  };

  console.log('\n--- HTML RENDER VERIFICATION CHECKS ---');
  for (const [name, pass] of Object.entries(checks)) {
    console.log(`  ${name.padEnd(45)}: ${pass ? 'PASS ✅' : 'FAIL ❌'}`);
  }

  console.log('\n========================================================================');
  console.log(`Final Provider Tallies:`);
  console.log(`  Google    : ${counts.google}`);
  console.log(`  Apple     : ${counts.apple}`);
  console.log(`  NVIDIA    : ${counts.nvidia}`);
  console.log(`  Anthropic : ${counts.anthropic}`);
  console.log(`  OpenAI    : ${counts.openai}`);
  console.log('========================================================================\n');
}

verify();
