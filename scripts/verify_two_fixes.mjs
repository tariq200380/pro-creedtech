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

async function verifyAll() {
  console.log('========================================================================');
  console.log('       FINAL VERIFICATION: PROBLEM 1 (TRIBUNE) & PROBLEM 2 (DIVERSE INTL) ');
  console.log('========================================================================\n');

  console.log('[1] Fetching live AJAX response from /ajax/live_tech_news.php?refresh=1...');
  const ajaxRes = await get('http://localhost:3000/ajax/live_tech_news.php?refresh=1');
  console.log(`HTTP Status: ${ajaxRes.status}`);
  const json = JSON.parse(ajaxRes.body);

  console.log('\n--- 1. VERIFYING PAKISTANI REGIONAL ARTICLES ---');
  for (const [key, item] of Object.entries(json.regional_wires)) {
    console.log(`[${key.toUpperCase()}]`);
    console.log(`  Headline : ${item.title}`);
    console.log(`  Link     : ${item.sourceUrl}`);
    console.log(`  Image    : ${item.image}`);
    
    if (key === 'tribune') {
      const hasRealImg = item.image.includes('spacex1786870960-0.jpg');
      console.log(`  Problem 1 Tribune Image Fix: ${hasRealImg ? 'CORRECT SOURCE IMAGE ✅' : 'FAILED ❌'}`);
    }
  }

  console.log('\n--- 2. VERIFYING DIVERSE INTERNATIONAL PROVIDERS ---');
  console.log('Provider Statuses Reported:');
  for (const [p, s] of Object.entries(json.provider_statuses || {})) {
    console.log(`  - ${p.padEnd(10)}: ${s}`);
  }

  console.log('\nBreaking News Items Count (Max 1 per provider):', json.breaking_news.length);
  const providersSeen = new Set();
  let duplicateFound = false;

  for (let i = 0; i < json.breaking_news.length; i++) {
    const it = json.breaking_news[i];
    console.log(`\nPosition ${i + 1} | Provider: ${it.provider.toUpperCase()}`);
    console.log(`  Headline : ${it.title}`);
    console.log(`  URL      : ${it.link}`);
    console.log(`  Time     : ${it.date}`);
    console.log(`  Image    : ${it.img}`);

    if (providersSeen.has(it.provider)) {
      duplicateFound = true;
      console.log(`  ⚠️ DUPLICATE PROVIDER DETECTED: ${it.provider}`);
    }
    providersSeen.add(it.provider);
  }

  console.log(`\nProvider Diversity Check: ${!duplicateFound ? 'PASSED (Strictly 1 per provider) ✅' : 'FAILED ❌'}`);

  console.log('\n--- 3. VERIFYING PUBLIC PHP PAGE /knowledge-center.php ---');
  const pageRes = await get('http://localhost:3000/knowledge-center.php');
  console.log(`HTML Response Status: ${pageRes.status}`);

  const hasTribuneSpacexImg = pageRes.body.includes('spacex1786870960-0.jpg');
  const hasNvidiaStory = pageRes.body.includes('Securing the Infrastructure of Intelligence');
  const hasOpenAIStory = pageRes.body.includes('The Defender’s Window');
  const hasAppleStory = pageRes.body.includes('Apple opens Advanced Manufacturing Center in Houston');
  const hasGoogleStory = pageRes.body.includes('Get closer to the game with Gemini and Pixel');
  const hasDawnStory = pageRes.body.includes('Japan mission aims for the moons of Mars');
  const hasBrecorderStory = pageRes.body.includes('Expansion beyond gold');
  const hasProPakistaniStory = pageRes.body.includes('Islamabad Technology Park');

  console.log(`Rendered Tribune SpaceX Source Image: ${hasTribuneSpacexImg ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Rendered Google Story               : ${hasGoogleStory ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Rendered NVIDIA Story               : ${hasNvidiaStory ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Rendered OpenAI Story               : ${hasOpenAIStory ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Rendered Apple Story                : ${hasAppleStory ? 'YES ✅' : 'NO ❌'}`);
  console.log(`Preserved Dawn Story                : ${hasDawnStory ? 'YES (Untouched) ✅' : 'NO ❌'}`);
  console.log(`Preserved B-Recorder Story          : ${hasBrecorderStory ? 'YES (Untouched) ✅' : 'NO ❌'}`);
  console.log(`Preserved ProPakistani Story        : ${hasProPakistaniStory ? 'YES (Untouched) ✅' : 'NO ❌'}`);

  console.log('\n========================================================================');
  if (hasTribuneSpacexImg && hasGoogleStory && hasNvidiaStory && hasOpenAIStory && hasAppleStory && !duplicateFound) {
    console.log('FINAL STATUS: BOTH REMAINING PROBLEMS FULLY RESOLVED & VERIFIED ✅');
  } else {
    console.log('FINAL STATUS: VERIFICATION FAILED ❌');
  }
  console.log('========================================================================\n');
}

verifyAll();
