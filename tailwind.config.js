module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
    './resources/sass/**/*.scss',
    './resources/js/**/*.vue',
  ],
  // important: true,
  theme: {
    extend: {
      colors: {
        'transparent':  'transparent',
        'grey-90':      'hsl(196, 31%, 14%)',
        'grey-80':      'hsl(198, 32%, 16%)',
        'grey-60':      'hsl(210, 15%, 70%)',
        // 'green':        '#479967',
        'green-light':  '#64BD63',
        // 'red':          'hsl(2, 76%, 60%)',
        'red-light':    'hsl(2, 76%, 70%)',
        'red-lighter':  'hsl(2, 76%, 95%)'
      },
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ]
}
