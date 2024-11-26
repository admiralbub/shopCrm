import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '192.168.2.132',
        port:'8080',
        hot: true
    },
    css: {
        preprocessorOptions: {
          scss: {
            silenceDeprecations: ["legacy-js-api"],
          },
        },
      },
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/admin/app.scss', 
                'resources/js/admin/admin.js',
      
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],

    
});
