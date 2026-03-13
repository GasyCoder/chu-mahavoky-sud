import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    safelist: [
        // Dynamic colors in Admin (Settings tabs + Blog categories)
        ...['blue', 'cyan', 'indigo', 'emerald', 'pink', 'amber', 'purple', 'red', 'slate'].flatMap(c => [
            `bg-${c}-50`, `bg-${c}-100`, `bg-${c}-500`, `text-${c}-600`, `text-${c}-700`, `border-${c}-200`,
        ]),
    ],

    theme: {
        container: {
            center: true,
            padding: '2rem',
            screens: {
                '2xl': '1400px',
            },
        },
        extend: {
            colors: {
                border: 'hsl(var(--border))',
                input: 'hsl(var(--input))',
                ring: 'hsl(var(--ring))',
                background: 'hsl(var(--background))',
                foreground: 'hsl(var(--foreground))',
                primary: {
                    DEFAULT: '#0055A4',
                    foreground: '#FFFFFF',
                    50: '#E6F0F9',
                    100: '#CCE2F3',
                    200: '#99C4E7',
                    300: '#66A7DB',
                    400: '#3389CF',
                    500: '#0055A4',
                    600: '#004483',
                    700: '#003362',
                    800: '#002241',
                    900: '#001121',
                },
                secondary: {
                    DEFAULT: '#00A19D',
                    foreground: '#FFFFFF',
                    50: '#E6F7F7',
                    100: '#CCEFEF',
                    200: '#99DFDF',
                    300: '#66CFCF',
                    400: '#33BFBF',
                    500: '#00A19D',
                    600: '#00817E',
                    700: '#00615E',
                    800: '#00403F',
                    900: '#00201F',
                },
                destructive: {
                    DEFAULT: colors.red[600],
                    foreground: colors.slate[50],
                },
                success: {
                    DEFAULT: colors.emerald[600],
                    foreground: colors.slate[50],
                },
                warning: {
                    DEFAULT: colors.amber[500],
                    foreground: colors.slate[900],
                },
                muted: {
                    DEFAULT: 'hsl(var(--muted))',
                    foreground: 'hsl(var(--muted-foreground))',
                },
                accent: {
                    DEFAULT: 'hsl(var(--accent))',
                    foreground: 'hsl(var(--accent-foreground))',
                },
                popover: {
                    DEFAULT: 'hsl(var(--popover))',
                    foreground: 'hsl(var(--popover-foreground))',
                },
                card: {
                    DEFAULT: 'hsl(var(--card))',
                    foreground: 'hsl(var(--card-foreground))',
                },
                sidebar: {
                    DEFAULT: 'hsl(var(--sidebar))',
                    foreground: 'hsl(var(--sidebar-foreground))',
                },
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                lg: 'var(--radius)',
                md: 'calc(var(--radius) - 2px)',
                sm: 'calc(var(--radius) - 4px)',
            },
            boxShadow: {
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                'card': '0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px -1px rgba(0, 0, 0, 0.04)',
                'elevated': '0 10px 40px -10px rgba(0, 0, 0, 0.1)',
            },
        },
    },

    plugins: [forms],
};
