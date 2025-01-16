import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#3d5cb8",
                "primary-dark": "#334c99",
                "text-dark": "#0f172a",
                "text-light": "#64748b",
                "extra-light": "#f1f5f9",
                white: "#ffffff",
            },
            maxWidth: {
                "screen-lg": "1200px",
            },
        },
    },
    plugins: [],
};
