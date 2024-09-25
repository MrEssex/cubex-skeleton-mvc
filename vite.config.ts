import { defineConfig } from 'vite';
import path from 'node:path';

export default defineConfig({
  base: path.resolve(__dirname, 'assets'),
  publicDir: false,
  css: {
    devSourcemap: true
  },
  build: {
    outDir: path.resolve(__dirname, 'resources'),
    emptyOutDir: true,
    sourcemap: true,
    terserOptions: {
      format: {
        comments: false
      }
    },
    rollupOptions: {
      input: [
        'assets/ts/index.ts',
        'assets/ts/analytics.ts',
        'assets/scss/index.scss'
      ],
      output: {
        inlineDynamicImports: false,
        assetFileNames: '[name].min[extname]',
        entryFileNames: '[name].min.js'
      }
    },
    assetsInlineLimit: 0
  },
  resolve: {
    alias: [
      { find: '@', replacement: path.resolve(__dirname, 'assets', 'ts') }
    ]
  }
});
