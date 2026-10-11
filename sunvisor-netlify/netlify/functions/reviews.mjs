// Відгуки-скриншоти для сайту: зберігаються в Netlify Blobs.
//   GET    /api/reviews        — список скриншотів (для сайту і адмінки)
//   GET    /api/reviews/:id    — сама картинка
//   POST   /api/reviews        — додати (тільки з паролем адмінки)
//   DELETE /api/reviews/:id    — видалити (тільки з паролем адмінки)
//   GET    /api/reviews?check  — перевірка пароля при вході в адмінку
// Пароль задається у Netlify: Site configuration → Environment variables → ADMIN_PASSWORD.

import { getStore } from '@netlify/blobs';
import { timingSafeEqual, randomBytes } from 'node:crypto';

const MAX_BYTES = 5 * 1024 * 1024;
const ID_RE = /^\d{14}-[0-9a-f]{8}$/;

function detectType(bytes) {
  if (bytes[0] === 0xff && bytes[1] === 0xd8 && bytes[2] === 0xff) return 'image/jpeg';
  if (bytes[0] === 0x89 && bytes[1] === 0x50 && bytes[2] === 0x4e && bytes[3] === 0x47) return 'image/png';
  if (String.fromCharCode(...bytes.slice(0, 4)) === 'RIFF' && String.fromCharCode(...bytes.slice(8, 12)) === 'WEBP') return 'image/webp';
  return null;
}

async function isAdmin(req) {
  const expected = Netlify.env.get('ADMIN_PASSWORD') || '';
  const given = req.headers.get('x-admin-password') || '';
  if (expected.length < 8) return false;
  const a = Buffer.from(given);
  const b = Buffer.from(expected);
  const ok = a.length === b.length && timingSafeEqual(a, b);
  if (!ok) await new Promise(r => setTimeout(r, 1500)); // гальмуємо підбір пароля
  return ok;
}

const json = (data, status = 200) =>
  new Response(JSON.stringify(data), {
    status,
    headers: { 'content-type': 'application/json; charset=utf-8', 'cache-control': 'no-store' },
  });

export default async (req, context) => {
  const store = getStore('reviews');
  const id = context.params?.id;

  if (req.method === 'GET' && id) {
    if (!ID_RE.test(id)) return new Response('Not found', { status: 404 });
    const item = await store.getWithMetadata(id, { type: 'arrayBuffer' });
    if (!item) return new Response('Not found', { status: 404 });
    return new Response(item.data, {
      headers: {
        'content-type': item.metadata?.type || 'image/jpeg',
        'cache-control': 'public, max-age=31536000, immutable',
      },
    });
  }

  // Перевірка пароля при вході в адмінку
  if (req.method === 'GET' && new URL(req.url).searchParams.has('check')) {
    return (await isAdmin(req)) ? json({ ok: true }) : json({ error: 'Невірний пароль' }, 401);
  }

  if (req.method === 'GET') {
    const { blobs } = await store.list();
    const ids = blobs.map(b => b.key).filter(k => ID_RE.test(k)).sort().reverse(); // нові першими
    return json({ reviews: ids.map(k => ({ id: k, url: `/api/reviews/${k}` })) });
  }

  if (req.method === 'POST' && !id) {
    if (!(await isAdmin(req))) return json({ error: 'Невірний пароль' }, 401);
    const buf = new Uint8Array(await req.arrayBuffer());
    if (!buf.length) return json({ error: 'Порожній файл' }, 400);
    if (buf.length > MAX_BYTES) return json({ error: 'Файл більший за 5 МБ' }, 413);
    const type = detectType(buf);
    if (!type) return json({ error: 'Це не JPG, PNG чи WEBP' }, 415);
    const stamp = new Date().toISOString().replace(/\D/g, '').slice(0, 14);
    const key = `${stamp}-${randomBytes(4).toString('hex')}`;
    await store.set(key, buf, { metadata: { type } });
    return json({ id: key, url: `/api/reviews/${key}` }, 201);
  }

  if (req.method === 'DELETE' && id) {
    if (!(await isAdmin(req))) return json({ error: 'Невірний пароль' }, 401);
    if (!ID_RE.test(id)) return json({ error: 'Невідомий відгук' }, 404);
    await store.delete(id);
    return json({ ok: true });
  }

  return json({ error: 'Method not allowed' }, 405);
};

export const config = {
  path: ['/api/reviews', '/api/reviews/:id'],
};
