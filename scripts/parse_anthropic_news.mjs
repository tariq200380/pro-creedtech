import https from 'https';

function fetchUrl(url) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' } }, (res) => {
      let d = '';
      res.on('data', c => d += c);
      res.on('end', () => resolve(d));
    }).on('error', () => resolve(''));
  });
}

async function parseAnthropicNews() {
  const html = await fetchUrl('https://www.anthropic.com/news');
  console.log('Anthropic News HTML Length:', html.length);
  // Match links to /news/...
  const newsLinks = html.match(/\/news\/[a-zA-Z0-9-]+/g) || [];
  const uniqueLinks = Array.from(new Set(newsLinks));
  console.log('Anthropic article slugs:', uniqueLinks);

  for (const slug of uniqueLinks.slice(0, 5)) {
    const artUrl = 'https://www.anthropic.com' + slug;
    const artHtml = await fetchUrl(artUrl);
    const titleM = artHtml.match(/<h1[^>]*>(.*?)<\/h1>/is) || artHtml.match(/<title[^>]*>(.*?)<\/title>/is);
    const ogImgM = artHtml.match(/<meta[^>]+property=["']og:image["'][^>]+content=["']([^"']+)["']/i) || artHtml.match(/<meta[^>]+content=["']([^"']+)["'][^>]+property=["']og:image["']/i);
    const pubDateM = artHtml.match(/"datePublished":"([^"]+)"/i) || artHtml.match(/<time[^>]*>(.*?)<\/time>/i);
    console.log(`\nSlug: ${slug}`);
    console.log('  Title:   ', titleM ? titleM[1].replace(/<[^>]+>/g, '').trim() : 'N/A');
    console.log('  Date:    ', pubDateM ? pubDateM[1] : 'N/A');
    console.log('  OG Image:', ogImgM ? ogImgM[1] : 'N/A');
  }
}

parseAnthropicNews();
