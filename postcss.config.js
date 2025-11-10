export default {
  plugins: {
    'postcss-import': {},
    '@tailwindcss/postcss': {
      optimize: process.env.NODE_ENV === 'production',
    },
    'postcss-nesting': {},
    'autoprefixer': {},
    ...(process.env.NODE_ENV === 'production' && {
      'cssnano': {
        preset: ['default', {
          discardComments: { removeAll: true },
        }]
      }
    })
  }
};
