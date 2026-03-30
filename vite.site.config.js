import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true,
                silenceDeprecations: ['legacy-js-api', 'import', 'global-builtin', 'color-functions', 'mixed-decls'],
            },
        },
    },
    plugins: [
        laravel({
            name: 'site',
            buildDirectory: 'build/site',
            input: [
                'resources/assets/site/js/main.js',
                'resources/assets/site/scss/main.scss',
            ],
            refresh: process.env.NODE_ENV !== 'production',
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
});
