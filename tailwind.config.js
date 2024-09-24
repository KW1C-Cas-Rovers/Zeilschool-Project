import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        fontFamily: {
            sans: ["Helvetica Neue", "Helvetica", "sans-serif"],
        },
        extend: {
            colors: {
                primary: "#007bff",
                secondary: "#0056b3",
                light: "#f4f4f4",
                dark: "#1a1a1a",
                text: "#333333",
            },
            spacing: {
                "8xl": "96rem",
                "8xl": "128rem",
            },
            borderRadius: {
                "4xl": "2rem",
            },
        },
    },

    plugins: [forms],
};
