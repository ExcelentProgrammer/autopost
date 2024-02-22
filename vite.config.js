// Import the 'defineConfig' function from the 'vite' package
import { defineConfig } from 'vite';

// Import the 'laravel' function from the 'laravel-vite-plugin' package
import laravel from 'laravel-vite-plugin';

// Define the configuration object for Vite
export default defineConfig({
    // Specify an array of plugins to be used by Vite
    plugins: [
        // The 'laravel' plugin is used to integrate Laravel with Vite
        laravel({
            // Specify the entry points for the application's CSS and JavaScript files
            input: ['resources/css/app.css', 'resources/js/app.js'],

            // Enable automatic refreshing of the browser when changes are detected
            refresh: true,
        }),
    ],
});

