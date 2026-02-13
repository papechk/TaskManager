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
                // TailAdmin Blue primary palette
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3C50E0',
                    600: '#3b82f6',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
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
                // Dark mode backgrounds (TailAdmin style)
                boxdark: '#1c2434',
                'boxdark-2': '#10141e',
                strokedark: '#2e3a47',
                // Light mode backgrounds
                stroke: '#e2e8f0',
                graydark: '#333a48',
                'body-color': '#64748b',
                // Sidebar colors
                'sidebar-bg': '#1c2434',
                'sidebar-menu': '#8a99af',
            },
            boxShadow: {
                'card': '0px 1px 3px rgba(0, 0, 0, 0.08)',
                'card-2': '0px 4px 6px -1px rgba(0, 0, 0, 0.08), 0px 2px 4px -1px rgba(0, 0, 0, 0.04)',
            },
        },
    },

    plugins: [forms],
};
