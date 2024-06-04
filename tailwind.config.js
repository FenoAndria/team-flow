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
                primary: '#3F51B5',
                secondary: '#FFC107',
                success: '#4CAF50',
                warning: '#FFEB3B',
                danger: '#F44336',
                info: '#2196F3',
                neutral: '#9E9E9E',
                background: '#FFFFFF',
                text: '#212121',
            },
        },
    },
    plugins: [
        // require('@tailwindcss/forms'),
        // require('@tailwindcss/typography'),
        require('daisyui')
    ],
}
