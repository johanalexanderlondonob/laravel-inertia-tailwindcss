import path from 'path';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            // There used to be a second entrypoint (resources/js/worksheet.js) with its
            // own Vue root and Blade view (worksheet.app), only to load Vuetify for the
            // Worksheet module. Both apps are now one Vue 3 tree sharing resources/js/app.js
            // and views/app.blade.php.
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
        extensions: ['.mjs', '.js', '.vue', '.json'],
    },
});
