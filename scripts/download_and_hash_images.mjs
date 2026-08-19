import https from 'https';
import fs from 'fs';
import path from 'path';
import crypto from 'crypto';

const uploadDir = 'public_html/uploads/live_news';
if (!fs.existsSync(uploadDir)) {
  fs.mkdirSync(uploadDir, { recursive: true });
}

function downloadImage(url, filename) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0' } }, (res) => {
      if (res.statusCode !== 200) {
        return resolve({ success: false, status: res.statusCode });
      }
      const chunks = [];
      res.on('data', c => chunks.push(c));
      res.on('end', () => {
        const buffer = Buffer.concat(chunks);
        const hash = crypto.createHash('sha256').update(buffer).digest('hex');
        const filePath = path.join(uploadDir, filename);
        fs.writeFileSync(filePath, buffer);
        resolve({
          success: true,
          status: 200,
          mime: res.headers['content-type'],
          hash,
          size: buffer.length,
          localPath: 'uploads/live_news/' + filename
        });
      });
    }).on('error', e => resolve({ success: false, error: e.message }));
  });
}

async function run() {
  console.log('--- Downloading and Hashing 3 Images ---');

  const appleRes = await downloadImage(
    'https://www.apple.com/newsroom/images/2026/08/apple-opens-advanced-manufacturing-center-in-houston/tile/Apple-Advanced-Manufacturing-Center-Houston-hero-lp.jpg.og.jpg',
    'apple_manufacturing_houston.jpg'
  );
  console.log('Apple Download Result:', appleRes);

  const oaiRes = await downloadImage(
    'https://images.ctfassets.net/kftzwdyauwt9/yYqBqvM2uvc7B9HulIW4O/a3fa616ce523411cc59534295c4e6ec9/the-defenders-window-seo.png?w=1600&h=900&fit=fill',
    'openai_the_defenders_window.png'
  );
  console.log('OpenAI Download Result:', oaiRes);

  const antRes = await downloadImage(
    'https://cdn.sanity.io/images/4zrzovbb/website/6d4a0d28992ade92d6fa63646fd9c9d318245c6c-2400x1260.jpg',
    'anthropic_claude_watermarking.jpg'
  );
  console.log('Anthropic Download Result:', antRes);
}

run();
