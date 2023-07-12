import { resolve, dirname } from 'path';
import { readFileSync, rmSync } from 'fs';

const basedir = dirname(new URL(import.meta.url).pathname);

const readManifest = (outDir) => {
  try {
    const path = resolve(outDir, 'manifest.json');
    return {
      path,
      manifest: JSON.parse(readFileSync(path, { encoding: 'utf8' })),
    };
  } catch {
    return {};
  }
};

const outDir = resolve(basedir, 'pub/assets');

const { path, manifest } = readManifest(outDir);

if (path) {
  for (const file of Object.values(manifest).map(ent => ent.file)) {
    rmSync(resolve(outDir, file));
  }
  rmSync(path);
}
