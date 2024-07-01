/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        lime:{
          50: '#F5FCE9',
          100: '#EAF8CF',
          200: '#D5F1A5',
          300: '#ADE25D',
          400: '#9AD645',
          500: '#7CBC26',
          600: '#5F961A',
          700: '#497219',
          800: '#3C5B19',
          900: '#344D1A',
          950: '#192A09'
        },
        violet:{
          50: '#FDF5FE',
          100: '#FAE9FE',
          200: '#F5D3FB',
          300: '#EB98F5',
          400: '#E880F2',
          500: '#D850E5',
          600: '#BE30C9',
          700: '#A025A6',
          800: '#842088',
          900: '#6E1F70',
          950: '#49084A'
        },
        onyx:{
          50: '#F6F6F6',
          100: '#E7E7E7',
          200: '#D1D1D1',
          300: '#B0B0B0',
          400: '#888888',
          500: '#6D6D6D',
          600: '#5D5D5D',
          700: '#4F4F4F',
          800: '#454545',
          900: '#3D3D3D',
          950: '#262626'
        }
      },
    },
  },
  plugins: [],
}