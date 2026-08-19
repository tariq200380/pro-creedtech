import https from 'https';

https.get('https://www.apple.com/newsroom/rss-feed.rss', { headers: { 'User-Agent': 'Mozilla/5.0' } }, (res) => {
  let d = '';
  res.on('data', c => d += c);
  res.on('end', () => {
    console.log('Apple total length:', d.length);
    console.log('Apple snippet:', d.substring(0, 1500));
  });
});
