import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#2563EB', // Blue-600
                success: '#16A34A', // Green-600
                danger: '#DC2626', // Red-600
                accent: '#9333EA', // Purple-600
                secondary: '#374151', // Gray-700
            }
        },
    },

    plugins: [forms],
};
