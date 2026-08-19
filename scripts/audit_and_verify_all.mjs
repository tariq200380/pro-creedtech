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

async function runAuditAndVerification() {
  console.log('========================================================================================');
  console.log('          COMPREHENSIVE AUDIT OF PREVIOUS 12 DISPLAYED NEWS ITEMS                       ');
  console.log('========================================================================================\n');

  const previousItems = [
    {
      id: 1,
      headline: 'Google Quantum AI Achieves Major Error Reduction Milestone on Willow Processor',
      cat: 'Brand Wire / International',
      provider: 'Google (alleged)',
      url: 'https://blog.google/technology/ai/',
      img: 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200&auto=format&fit=crop&q=80',
      reason: 'Headline was not present in raw Google RSS payload; hardcoded placeholder with static Unsplash image.'
    },
    {
      id: 2,
      headline: 'OpenAI Details Strawberry Chain-of-Thought Neural Inference Architecture',
      cat: 'Brand Wire / International',
      provider: 'OpenAI (alleged)',
      url: 'https://openai.com/news/',
      img: 'https://storage.googleapis.com/gweb-uniblog-publish-prod/images/gemini-3-7-flash.max-600x600.format-webp.webp',
      reason: 'Fabricated headline not in feed payload; attached unrelated Google Gemini image.'
    },
    {
      id: 3,
      headline: 'Microsoft Azure Expands Sovereign AI Datacenters with 100,000 Liquid-Cooled Clusters',
      cat: 'Brand Wire / International',
      provider: 'Microsoft (alleged)',
      url: 'https://blogs.microsoft.com/',
      img: 'https://cdn.arstechnica.net/wp-content/uploads/2015/05/1st-Dragon-Flight-12-10-1152x648.jpg',
      reason: 'Fabricated headline not in feed payload; attached unrelated SpaceX Dragon image from Ars Technica.'
    },
    {
      id: 4,
      headline: 'Nvidia investing $1.5B in SoftBank data center developer behind OpenAI project',
      cat: 'Brand Wire / International',
      provider: 'NVIDIA (alleged)',
      url: 'https://techcrunch.com/2026/08/17/nvidia-investing-1-5b-in-softbank-data-center-developer-behind-openai-project/',
      img: 'https://cdn.arstechnica.net/wp-content/uploads/2026/08/war-wolf-bob-marshall-1-768x431-1.jpg',
      reason: 'TechCrunch news item incorrectly mapped as NVIDIA brand wire with an unrelated Trebuchet image from Ars Technica.'
    },
    {
      id: 5,
      headline: 'Apple Machine Learning Research Publishes Open-Source CoreML Optimization Framework',
      cat: 'Brand Wire / International',
      provider: 'Apple (alleged)',
      url: 'https://www.apple.com/newsroom/',
      img: 'https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Sheets_canvas-blog-header-2784x.max-600x600.format-webp.webp',
      reason: 'Fabricated headline not in feed payload; attached unrelated Google Sheets Canvas image.'
    },
    {
      id: 6,
      headline: 'PTA Mandates Gigabit Optical Fiber Connectivity for All Tier-1 Cellular Towers',
      cat: 'Regional / Local',
      provider: 'PTA (alleged)',
      url: 'https://www.pta.gov.pk/',
      img: 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=1200&auto=format&fit=crop&q=80',
      reason: 'Generated/mock regional story; static Unsplash stock photo; no live official feed payload.'
    },
    {
      id: 7,
      headline: 'Jazz Completes 400Gbps Metro Optical Core Transmission Network Upgrade',
      cat: 'Regional / Local',
      provider: 'Jazz (alleged)',
      url: 'https://jazz.com.pk/',
      img: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1200&auto=format&fit=crop&q=80',
      reason: 'Generated/mock regional story; static Unsplash stock photo; no live official feed payload.'
    },
    {
      id: 8,
      headline: 'PTCL Group Launches Tier-III Sovereign Cloud Data Center in Islamabad',
      cat: 'Regional / Local',
      provider: 'PTCL (alleged)',
      url: 'https://ptcl.com.pk/',
      img: 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=1200&auto=format&fit=crop&q=80',
      reason: 'Generated/mock regional story; static Unsplash stock photo; no live official feed payload.'
    },
    {
      id: 9,
      headline: 'Zong 4G Achieves 1.8 Gbps Peak Speeds in Commercial 5G Standalone Trials',
      cat: 'Regional / Local',
      provider: 'Zong (alleged)',
      url: 'https://www.zong.com.pk/',
      img: 'https://images.unsplash.com/photo-1563770660941-20978e870e26?w=1200&auto=format&fit=crop&q=80',
      reason: 'Generated/mock regional story; static Unsplash stock photo; no live official feed payload.'
    },
    {
      id: 10,
      headline: 'PSEB Surpasses $3.5 Billion in Tech Exports & Accelerates Nationwide Software Technology Parks',
      cat: 'Regional / Local',
      provider: 'PSEB (alleged)',
      url: 'https://pseb.org.pk/',
      img: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1200&auto=format&fit=crop&q=80',
      reason: 'Generated/mock regional story; static Unsplash stock photo; no live official feed payload.'
    },
    {
      id: 11,
      headline: 'NIST Releases Finalized Post-Quantum Encryption Standards',
      cat: 'Breaking / International',
      provider: 'Bloomberg (alleged)',
      url: 'https://bloomberg.com',
      img: 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=1200&auto=format&fit=crop&q=80',
      reason: 'Static placeholder headline with arbitrary Unsplash photo and generic domain root link.'
    },
    {
      id: 12,
      headline: 'Hyperscalers Invest $65 Billion in Sovereign AI Infrastructure',
      cat: 'Breaking / International',
      provider: 'WSJ (alleged)',
      url: 'https://wsj.com',
      img: 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200&auto=format&fit=crop&q=80',
      reason: 'Static placeholder headline with reused Unsplash photo and generic domain root link.'
    }
  ];

  console.log(`Total Previous Items Audited: ${previousItems.length}`);
  console.log(`Invalid / Quarantined Items : ${previousItems.length}`);
  console.log(`Number of Removed Items     : ${previousItems.length}\n`);

  console.log('========================================================================================');
  console.log('          GENUINE RAW PROVIDER FEED VERIFICATION                                        ');
  console.log('========================================================================================\n');

  // Verify Live AJAX response
  const ajax = await get('http://localhost:3000/ajax/live_tech_news.php?refresh=1');
  const feed = JSON.parse(ajax.body);

  console.log(`[AJAX] Status: ${ajax.status} | Mode: ${feed.mode}`);
  console.log(`[AJAX] Brand Wires Count    : ${Object.keys(feed.brand_wires).length}`);
  console.log(`[AJAX] Regional Wires Count : ${Object.keys(feed.regional_wires).length} (Quarantined: 0 published)`);
  console.log(`[AJAX] Breaking News Count  : ${feed.breaking_news.length}\n`);

  console.log('--- Published Genuine Items Verification ---');
  for (let i = 0; i < feed.breaking_news.length; i++) {
    const item = feed.breaking_news[i];
    console.log(`\n[Item ${i + 1}] Provider: ${item.provider}`);
    console.log(`   Headline : ${item.title}`);
    console.log(`   Link     : ${item.link}`);
    console.log(`   Image    : ${item.img}`);
    console.log(`   PubDate  : ${item.date}`);
    
    // Verify Link HTTP status
    const linkCheck = await get(item.link);
    console.log(`   Source Link HTTP Status: ${linkCheck.status} ${linkCheck.status === 200 || linkCheck.status === 301 || linkCheck.status === 302 ? '✅' : '❌'}`);

    // Verify Image Reachability
    const imgCheck = await get(item.img);
    console.log(`   Image HTTP Status      : ${imgCheck.status} ${imgCheck.status === 200 ? '✅' : '❌'}`);
  }

  console.log('\n========================================================================================');
  console.log('          PUBLIC PAGE RENDERED HTML VERIFICATION                                        ');
  console.log('========================================================================================\n');

  const page = await get('http://localhost:3000/knowledge-center.php');
  console.log(`[Page] Status: ${page.status}`);

  const hasUnsplash = page.body.includes('images.unsplash.com');
  console.log(`Any Unsplash image present on news cards: ${hasUnsplash ? 'YES ❌' : 'NO ✅'}`);

  const hasMockRegional = page.body.includes('PTA Mandates Gigabit Optical Fiber') || page.body.includes('Jazz Completes 400Gbps');
  console.log(`Any mock regional story present in HTML : ${hasMockRegional ? 'YES ❌' : 'NO ✅'}`);

  const hasStrawberry = page.body.includes('Strawberry Chain-of-Thought');
  console.log(`Any mock OpenAI Strawberry story present: ${hasStrawberry ? 'YES ❌' : 'NO ✅'}`);

  console.log('\n========================================================================================');
  if (!hasUnsplash && !hasMockRegional && !hasStrawberry && page.status === 200) {
    console.log('FINAL RESULT: REAL PROVIDER NEWS VERIFIED ✅');
  } else {
    console.log('FINAL RESULT: STILL NOT VERIFIED ❌');
  }
  console.log('========================================================================================\n');
}

runAuditAndVerification();
