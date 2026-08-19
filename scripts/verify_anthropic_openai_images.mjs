import https from 'https';
import fs from 'fs';
import path from 'path';
import crypto from 'crypto';

const uploadDir = 'public_html/uploads/live_news';

function downloadAndHash(url, filename) {
  return new Promise((resolve) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' } }, (res) => {
      if (res.statusCode !== 200) {
        return resolve({ success: false, status: res.statusCode });
      }
      const chunks = [];
      res.on('data', c => chunks.push(c));
      res.on('end', () => {
        const buffer = Buffer.concat(chunks);
        const hash = crypto.createHash('sha256').update(buffer).digest('hex');
        const hashFilename = filename.replace(/\.[^.]+$/, '') + '_' + hash.substring(0, 12) + path.extname(filename);
        const fullPath = path.join(uploadDir, hashFilename);
        fs.writeFileSync(fullPath, buffer);
        resolve({
          success: true,
          status: 200,
          mime: res.headers['content-type'],
          hash,
          size: buffer.length,
          savedFile: hashFilename,
          localPath: 'uploads/live_news/' + hashFilename
        });
      });
    }).on('error', e => resolve({ success: false, error: e.message }));
  });
}

async function verifyDownloads() {
  console.log('=== 1. ANTHROPIC IMAGE VERIFICATION ===');
  const antUrl = 'https://www.anthropic.com/api/opengraph-illustration?name=Hand%20Quill&backgroundColor=heather';
  const antRes = await downloadAndHash(antUrl, 'anthropic_watermark.png');
  console.log('Anthropic Result:', antRes);

  console.log('\n=== 2. OPENAI IMAGE VERIFICATION ===');
  const oaiUrl = 'https://images.ctfassets.net/kftzwdyauwt9/yYqBqvM2uvc7B9HulIW4O/a3fa616ce523411cc59534295c4e6ec9/the-defenders-window-seo.png?w=1600&h=900&fit=fill';
  const oaiRes = await downloadAndHash(oaiUrl, 'openai_the_defenders_window.png');
  console.log('OpenAI Result:', oaiRes);
}

verifyDownloads();
