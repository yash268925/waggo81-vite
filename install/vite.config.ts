import { resolve, dirname } from 'path';
import { defineConfig } from 'vite';

const basedir = dirname(new URL(import.meta.url).pathname);

export default defineConfig({
  root: 'assets',
  base: '/assets',
  appType: 'custom',
  server: {
    host: true,
  },
  build: {
    manifest: true,
    outDir: '../pub/assets',
    assetsDir: '.',
    emptyOutDir: false,
    rollupOptions: {
      input: [
        // Ex: resolve(basedir, 'assets/main.js'),
      ],
    }
  },
});
