import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        origin: process.env.APP_URL,
        hmr: {
            host: process.env.APP_URL ? new URL(process.env.APP_URL).hostname : 'localhost',
            protocol: 'wss',
            clientPort: 443,
        },
    },
});
