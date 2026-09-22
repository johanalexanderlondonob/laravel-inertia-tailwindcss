const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
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

    // Tailwind 3 generates every state variant (active:, checked:, etc.) for every
    // utility by default, so the old `variants.extend` allowlist from Tailwind 2 (which
    // only enabled `active:opacity-*` and `checked:bg-*`/`checked:border-*`) is no longer
    // needed — those variants, and any other state, are already available.

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
