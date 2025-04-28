import defaultTheme from "tailwindcss/defaultTheme";
const colors = require("tailwindcss/colors");
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        './vendor/masmerise/livewire-toaster/resources/views/*.blade.php',
        "./storage/framework/views/*.php",
        "./node_modules/preline/dist/*.js",
        
    ],
    safelist: [
        {
            pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl|full)/,
            variants: ["sm", "md", "lg", "xl", "2xl", "3xl", "4xl", "5xl", "6xl", "7xl", "full"],
        },
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.purple,
                secondary: colors.slate,
                neutral: colors.gray,
                isDark: "#171E2F",
            },
        },
    },

    plugins: [forms, require("preline/plugin"), require('tailwind-scrollbar'), ],
};
