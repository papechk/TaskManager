import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Satoshi', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Palette beige/sand TailAdmin style
                primary: {
                    50: '#faf8f5',
                    100: '#f5f0e8',
                    200: '#ebe0d0',
                    300: '#dcc9af',
                    400: '#c9a97e',
                    500: '#b8905a',
                    600: '#a67c4e',
                    700: '#8a6542',
                    800: '#71533a',
                    900: '#5d4532',
                    950: '#322418',
                },
                // Couleurs sémantiques
                success: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    500: '#22c55e',
                    600: '#16a34a',
                },
                danger: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    500: '#ef4444',
                    600: '#dc2626',
                },
                warning: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    500: '#f59e0b',
                    600: '#d97706',
                },
                // Dark mode backgrounds
                boxdark: '#24303f',
                'boxdark-2': '#1a222c',
                strokedark: '#2e3a47',
                // Light mode backgrounds
                stroke: '#e2e8f0',
                graydark: '#333a48',
                'body-color': '#64748b',
            },
            boxShadow: {
                'card': '0px 1px 3px rgba(0, 0, 0, 0.08)',
                'card-2': '0px 4px 6px -1px rgba(0, 0, 0, 0.08), 0px 2px 4px -1px rgba(0, 0, 0, 0.04)',
            },
        },
    },

    plugins: [forms],
};
