import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            name: 'admin',
            buildDirectory: 'build/admin',
            input: [
                'resources/assets/admin/js/main.js',
                'resources/assets/admin/js/table.js',
                'resources/assets/admin/js/editor.js',
                'resources/assets/admin/scss/main.scss',
            ],
            refresh: process.env.NODE_ENV !== 'production',
        })
    ],
    resolve: {
        alias: {
            '~choices.js': path.resolve(__dirname, 'node_modules/choices.js'),
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
});
