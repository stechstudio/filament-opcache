import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        rollupOptions: {
            input: 'resources/css/filament-opcache.css',
            output: {
                dir: 'dist',
                entryFileNames: '[name].js',
                assetFileNames: 'filament-opcache.css',
            },
        },
        emptyOutDir: false,
    },
});
