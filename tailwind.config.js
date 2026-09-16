const defaultTheme = require('tailwindcss/defaultTheme');
const colorsTailwind = require('tailwindcss/colors')
// const { default: colors } = require('vuetify/lib/util/colors');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                body: ['Roboto', ...defaultTheme.fontFamily.sans],
                mono: ['"Fira Code"', 'ui-monospace']
            },
            colors: {
                primary: "#e3a822",
                secondary: "#1D1D1B",
            },
        },
    },

    variants: {
        extend: {
            opacity: ['active'],
            backgroundColor: ['checked'],
            borderColor: ['checked']
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
