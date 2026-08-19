import http from 'http';
import { spawn } from 'child_process';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const publicDir = path.join(__dirname, 'public_html');

const PHP_EXE = 'C:\\php\\php.exe';
const PHP_PORT = 8088;
const PROXY_PORT = 3000;

let phpProcess = null;

function startPhpServer() {
  console.log(`[PHP RUNTIME] Spawning authoritative PHP server at 127.0.0.1:${PHP_PORT}...`);
  phpProcess = spawn(PHP_EXE, [
    '-S', `127.0.0.1:${PHP_PORT}`,
    'router.php'
  ], {
    cwd: publicDir,
    stdio: 'inherit'
  });

  phpProcess.on('exit', (code, signal) => {
    console.log(`[PHP RUNTIME] Process exited with code ${code}, signal ${signal}. Restarting...`);
    setTimeout(startPhpServer, 1000);
  });
}

startPhpServer();

// Clean up child process on exit
process.on('exit', () => {
  if (phpProcess) {
    try { phpProcess.kill(); } catch (e) {}
  }
});
process.on('SIGINT', () => process.exit(0));
process.on('SIGTERM', () => process.exit(0));

// Reverse proxy server listening on port 3000
const server = http.createServer((req, res) => {
  const reqHeaders = { ...req.headers };
  delete reqHeaders['host'];
  delete reqHeaders['connection'];

  const options = {
    hostname: '127.0.0.1',
    port: PHP_PORT,
    path: req.url,
    method: req.method,
    headers: {
      ...reqHeaders,
      'host': `127.0.0.1:${PHP_PORT}`,
      'connection': 'close',
      'x-forwarded-for': req.socket.remoteAddress,
      'x-forwarded-proto': 'http',
      'x-forwarded-port': PROXY_PORT
    }
  };

  const proxyReq = http.request(options, (proxyRes) => {
    const resHeaders = { ...proxyRes.headers };
    resHeaders['connection'] = 'close';
    res.writeHead(proxyRes.statusCode, resHeaders);
    proxyRes.pipe(res);
  });

  proxyReq.on('error', (err) => {
    console.error(`[PROXY ERROR] Failed to connect to PHP backend:`, err.message);
    if (!res.headersSent) {
      res.writeHead(502, { 'Content-Type': 'text/plain; charset=utf-8', 'connection': 'close' });
      res.end('502 Bad Gateway - PHP Runtime starting up, please refresh...');
    }
  });

  if (['POST', 'PUT', 'PATCH'].includes(req.method.toUpperCase())) {
    req.pipe(proxyReq);
  } else {
    proxyReq.end();
  }
});

server.listen(PROXY_PORT, '0.0.0.0', () => {
  console.log(`[CREED TECH PROXY] Authoritative PHP reverse proxy active at http://localhost:${PROXY_PORT}`);
});
