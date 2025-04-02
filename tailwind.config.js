import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        container: {
            center: true,
            padding: "1rem",
            screens: {
                sm: "100%",
                md: "768px",
                lg: "992px",
                xl: "1140px",
            },
        },
        colors: {
            primary: "#0067FF",
            button: "#00A3FF",
            black: "#000000",
            white: "#FFFFFF",
            dark: "#333333",
            violet: {
                DEFAULT: "#8B5CF6",
                light: "#A78BFA",
                dark: "#7C3AED"
            },
            pink: {
                DEFAULT: "#EC4899",
                light: "#F472B6",
                dark: "#DB2777"
            },
            // Nouvelles couleurs basées sur l'image
            purple: {
                DEFAULT: "#8E2E9B", // Couleur pourpre/violet des bandeaux
                light: "#A94DB7",
                dark: "#721D7C"
            },
            turquoise: {
                DEFAULT: "#5ECCC1", // Couleur turquoise du fond
                light: "#8FE0D8",
                dark: "#3BAFA4"
            },
            gray: {
                DEFAULT: "#D9D9D9",
                dark: "#797979",
                light: "#F4F4F4",
            },
            transparent: "#00000000",
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ["Poppins", "sans-serif"],
                rubik: ["Rubik", "sans-serif"],
            },
            fontSize: {
                "4xl": "60px", // heading 1
                "3xl": "40px", // heading 2
                "2xl": "36px", // heading 3
                xl: "28px", // heading 4
                lg: "20px",
                md: "18px",
                base: "16px",
                sm: "14px",
            },
        },
    },

    plugins: [forms],
};
