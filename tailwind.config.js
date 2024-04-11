const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        './src/**/*.{html,js}',
        './resources/**/*.blade.php',
        './resources/**/*.vue',
        "./index.html",
    ],
    theme: {
        extend: {
            colors: {
                dark: '#262626',
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },
    plugins: [
        // require('@tailwindcss/forms'),
        // require('@tailwindcss/typography'),
        // require('daisyui')
    ],
}
