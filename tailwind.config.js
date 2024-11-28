/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        aliceblue: '#f0f8ff', // Màu aliceblue
        backgroundDiv: '#E8E8E8',
      },
    },
  },
  plugins: [],
}