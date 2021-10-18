module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      colors: {
          'primary': '#004282',
          'secondary': '#282828',
          'secondary_dark': '#202020',
          'tertiary': '#E85151',
      }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
    require('@tailwindcss/aspect-ratio')
  ]
}
