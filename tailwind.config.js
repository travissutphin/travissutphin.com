/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./templates/**/*.php",
    "./public/**/*.html",
    "./public/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        'primary-green': '#2be256',
        'dark-green': '#005a00',
        'primary-blue': '#3d608f',
        'light-blue': '#8dace1',
        'dark': '#1a1a1a',
        'gray-dark': '#4a4a4a',
        'gray-light': '#f8f9fa'
      }
    }
  },
  plugins: []
}
