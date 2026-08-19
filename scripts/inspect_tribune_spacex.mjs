import https from 'https';

https.get('https://tribune.com.pk/feed/technology', {
  headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' }
}, (res) => {
  let d = '';
  res.on('data', c => d += c);
  res.on('end', () => {
    const items = d.split(/<item[\s>]/i);
    for (let i = 1; i < items.length; i++) {
      if (items[i].includes('2624193') || items[i].includes('Falcon 9 missions')) {
        console.log('=== EXACT ARTICLE RAW ITEM ===');
        console.log(items[i]);
      }
    }
  });
});
