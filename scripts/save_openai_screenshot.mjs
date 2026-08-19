import fs from 'fs';
import path from 'path';
import crypto from 'crypto';

const srcImg = 'C:\\Users\\m_tar\\.gemini\\antigravity\\brain\\01004802-8f37-42f9-9034-ed6c5f1e834b\\openai_header_screenshot_1786987304359.jpg';
const destDir = 'public_html/uploads/live_news';

const buffer = fs.readFileSync(srcImg);
const hash = crypto.createHash('sha256').update(buffer).digest('hex');
const filename = `openai_defenders_window_header_${hash.substring(0, 12)}.jpg`;
const destPath = path.join(destDir, filename);

fs.writeFileSync(destPath, buffer);

console.log('Saved Screenshot:', filename);
console.log('Local Path:', `uploads/live_news/${filename}`);
console.log('SHA-256 Hash:', hash);
console.log('Size:', buffer.length);
