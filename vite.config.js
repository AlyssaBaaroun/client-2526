import {defineConfig} from "vite";
import {globSync} from "glob";
import fs from "fs";

export default defineConfig({
    base: '/wp-content/themes/client/public/',
    plugins: [
        {
            name: 'bundle-js',
        }
    ],


    build: {
        manifest: true,
        rollupOptions: {
            input: {
                js: './wp-content/themes/client/assets/js/main.js',
                scss: './wp-content/themes/client/assets/css/styles.scss',
            },
            output: {
                dir: './wp-content/themes/client/public'
            }
        },
        assetsInlineLimit: 0,
        target: ["es2015"]
    }
})