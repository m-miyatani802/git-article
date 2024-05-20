import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

// export default defineConfig({
//   plugins: [
//     vue(),
//     laravel({
//       input: ['resources/css/app.css', 'resources/js/app.js'],
//       refresh: true,
//     }),
//   ],
//   server: {
// 	  host:'xxx.xxx.xxx.xxx', // VMのIPを記載
// 	  port:5173
//   }
// });

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

