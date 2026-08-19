import https from 'https';
import http from 'http';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

function getUrl(url) {
  return new Promise((resolve, reject) => {
    const client = url.startsWith('https') ? https : http;
    const req = client.get(url, {
      headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'
      }
    }, (res) => {
      if (res.statusCode >= 300 && res.statusCode < 400 && res.headers.location) {
        return getUrl(res.headers.location).then(resolve).catch(reject);
      }
      let body = '';
      res.on('data', chunk => body += chunk);
      res.on('end', () => resolve({ status: res.statusCode, body }));
    });
    req.on('error', reject);
  });
}

async function run() {
  console.log('--- Fetching live Google RSS feed ---');
  const resGoogle = await getUrl('https://blog.google/rss/');
  if (resGoogle.status === 200) {
    const items = resGoogle.body.split('<item>');
    for (let i = 1; i < Math.min(items.length, 3); i++) {
      const itemXml = items[i];
      const titleMatch = itemXml.match(/<title>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/);
      const linkMatch = itemXml.match(/<link>(.*?)<\/link>/);
      const guidMatch = itemXml.match(/<guid[^>]*>(.*?)<\/guid>/);
      const mediaMatch = itemXml.match(/<media:content[^>]+url=["']([^"']+)["']/);
      const descMatch = itemXml.match(/&lt;img[^>]+src=["']([^"']+)["']/) || itemXml.match(/<img[^>]+src=["']([^"']+)["']/);
      console.log(`[Google ${i}] Title: ${titleMatch ? titleMatch[1] : 'N/A'}`);
      console.log(`  Image: ${mediaMatch ? mediaMatch[1] : (descMatch ? descMatch[1] : 'N/A')}`);
    }
  }

  console.log('\n--- Fetching live Ars Technica RSS feed ---');
  const resArs = await getUrl('https://feeds.arstechnica.com/arstechnica/index');
  if (resArs.status === 200) {
    const items = resArs.body.split('<item>');
    for (let i = 1; i < Math.min(items.length, 3); i++) {
      const itemXml = items[i];
      const titleMatch = itemXml.match(/<title>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/);
      const mediaMatch = itemXml.match(/<media:content[^>]+url=["']([^"']+)["']/);
      const descMatch = itemXml.match(/<img[^>]+src=["']([^"']+)["']/);
      console.log(`[ArsTechnica ${i}] Title: ${titleMatch ? titleMatch[1] : 'N/A'}`);
      console.log(`  Image: ${mediaMatch ? mediaMatch[1] : (descMatch ? descMatch[1] : 'N/A')}`);
    }
  }
}

run();
