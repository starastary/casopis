const colors = require('tailwindcss/colors')
module.exports = {
    purge: {
        enabled: false,
        content: ['./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',],
    },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            primary: {
                50: '#E3F2FF',
                100: '#AAD7FE',
                200: '#72BCFD',
                300: '#55AFFC',
                400: '#39A1FC',
                500: '#1E96FC',
                600: '#0483F2',
                700: '#035DAD',
                800: '#023868',
                900: '#011323',
            },
            secondary: {
                50: '#F1FAEC',
                100: '#E3F5D9',
                200: '#C7ECB4',
                300: '#AAE28E',
                400: '#9CDD7C',
                500: '#8CD867',
                600: '#76D049',
                700: '#51A029',
                800: '#306019',
                900: '#102008',
            },
            'primary-dark': {
                50: '#E0DDEC',
                100: '#C1BCD8',
                200: '#8279B2',
                300: '#4F467A',
                400: '#393359',
                500: '#242038',
                600: '#1F1C30',
                700: '#161422',
                800: '#12101C',
                900: '#09080E',
            },
            'secondary-dark': {
                50: '#F5C3C3',
                100: '#EB8686',
                200: '#E24A4A',
                300: '#DD2C2C',
                400: '#C42021',
                500: '#AD1C1C',
                600: '#7B1414',
                700: '#631010',
                800: '#4A0C0C',
                900: '#310808',
            },
            background: {
                light: '#FBFBFF',
                dark: '#121212',
            },
            text: {
                light: '#e5e4e4',
                gray: '#6b6e6d',
                dark: '#040407'
            },
        },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
