import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vuePlugin from "@vitejs/plugin-vue";
import i18n from "laravel-vue-i18n/vite";
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
        vuePlugin(),
        i18n()
    ],
    resolve: {
        alias: {
            vue: path.resolve(__dirname, 'node_modules/vue/dist/vue.esm-bundler.js'),
            '@': path.resolve(__dirname, 'resources/js'),
        }
    }
});

