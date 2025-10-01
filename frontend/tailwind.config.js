// /** @type {import('tailwindcss').Config} */
// export default {
//   content: ['./index.html', './src/**/*.{js,jsx,ts,tsx}'],
//   theme: { extend: {} },
//   plugins: [],
// };
/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,jsx,ts,tsx}'],
  theme: {
    extend: {
      fontFamily: {
        raleway: ['Raleway', 'sans-serif'],
      },
      boxShadow: {
        product: '0 4px 35px rgba(168, 172, 176, 0.19)',
      },
      colors: {
        brand: '#5ECE7B', // ✅ Figma’s green
      },
    },
  },
  plugins: [],
};
