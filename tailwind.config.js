/** @type {import("tailwindcss").Config} */
const safelistClasses = require("./safelist_classes.json");

module.exports = {
  content: [
    "./public_html/**/*.php",
    "./public_html/**/*.html",
    "./public_html/**/*.js",
    "./public_html/data/*.json"
  ],
  safelist: safelistClasses,
  theme: {
    extend: {
      colors: {
        brandBlue: "#0052FF",
        brandBlueHover: "#0043D6",
        brandOrange: "#FF6B00",
        brandOrangeDark: "#EA580C",
        dark1: "#0F1420",
        dark2: "#0B1120",
        newsDark: "#070D1E",
      },
      fontFamily: {
        sans: ['"Segoe UI"', '"Segoe UI Variable"', 'Arial', 'sans-serif'],
      }
    }
  },
  plugins: [],
};
