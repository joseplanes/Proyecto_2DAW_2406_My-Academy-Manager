/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,ts}",
  ],
  theme: {
    extend: {colors: {
      'custom-gray': '#F1EFE7',
      'custom-green': '#A6BDA9',
      'custom-darkgreen': '#4d6e51',
    },},
  },
  plugins: [],
}

