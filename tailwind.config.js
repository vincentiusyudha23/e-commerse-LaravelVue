import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                menu: {
                    '0%': { transform: 'translateY(-100%)', opacity:'0%' },
                    '50%': { transform: 'translateY(20%)', opacity: '50%' },
                    '100%': { transform: 'translateY(0)', opacity: '100%' }
                }
            },
            animation: {
                'openMenu': 'menu 0.5s ease-in-out'
            }
        },
    },

    plugins: [forms],
};
