import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
            ],
            refresh: true,
        }),
    ],
    cors: {
        origin: 'http://[::1]:5173/',
        credentials: true,
        methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH', 'HEAD', 'HEADER'],
    },
    hmr: {
        host: 'localhost',
        port: 5173,
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'node_modules/'),
        }
    },
});
