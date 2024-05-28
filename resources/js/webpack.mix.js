const tailwindcss = require('tailwindcss')
const autoprefixer = require('autoprefixer')

module.exports = {
  mix: {
    js: 'resources/js/app.js', // Compile JavaScript
    css: [
      'resources/css/app.css', // Include your main CSS file
      '@tailwind base',        // Include Tailwind base styles
      '@tailwind components',  // Include Tailwind components
      '@tailwind utilities',  // Include Tailwind utilities
    ],
  },
  plugins: [
    tailwindcss(),  // Configure Tailwind CSS
    autoprefixer(), // Add vendor prefixes for broader compatibility
  ],
};
