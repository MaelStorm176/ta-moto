const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Liberation Mono', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'spin-slow': 'spin 3s linear infinite',
                'shine': 'shine 1s',
            },
            keyframes: {
                shine: {
                    "100%": { left: "125%" }
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('daisyui'), require('@tailwindcss/typography'), require('tailwind-scrollbar')],
};
