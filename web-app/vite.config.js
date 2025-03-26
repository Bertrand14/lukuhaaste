import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    // setup the vite server - only used in dev ; ignored in production
    server: {
        proxy: {
            '/images': 'http://localhost:8000',  // Proxy image requests to the Laravel server
        },
    },
    base: '/', // Make sure Vite is using the root path for assets in development and production
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
