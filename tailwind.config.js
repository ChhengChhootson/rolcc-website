import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import aspectRatio from '@tailwindcss/aspect-ratio';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                // Primary Brand Colors
                'church-blue': {
                    DEFAULT: '#145DA0',
                    50: '#EBF4FC',
                    100: '#C5DEF5',
                    200: '#9FC8EE',
                    300: '#79B2E7',
                    400: '#539CE0',
                    500: '#3C8DDB',
                    600: '#145DA0',
                    700: '#0B4F8C',
                    800: '#083870',
                    900: '#082032',
                },
                'royal-blue': '#0B4F8C',
                'sky-blue': '#3C8DDB',
                'soft-white': '#F8FAFC',
                'dark-navy': '#082032',
                'silver-gray': '#C7D2DA',
                'soft-beige': '#F7F4EF',
                // Accent
                'church-gold': '#D4A017',
                // Semantic
                'church-success': '#22C55E',
                'church-warning': '#F59E0B',
                'church-error': '#EF4444',
            },
            fontFamily: {
                sans: ['Inter', 'Nunito Sans', ...defaultTheme.fontFamily.sans],
                heading: ['Poppins', 'Inter', ...defaultTheme.fontFamily.sans],
                khmer: ['Noto Sans Khmer', 'sans-serif'],
            },
            backgroundImage: {
                'hero-gradient': 'linear-gradient(135deg, #082032 0%, #145DA0 50%, #3C8DDB 100%)',
                'card-gradient': 'linear-gradient(135deg, #0B4F8C 0%, #145DA0 100%)',
                'gold-gradient': 'linear-gradient(135deg, #D4A017 0%, #F59E0B 100%)',
                'dark-gradient': 'linear-gradient(180deg, #082032 0%, #0B4F8C 100%)',
            },
            boxShadow: {
                'church': '0 4px 24px rgba(8, 32, 50, 0.15)',
                'church-lg': '0 8px 40px rgba(8, 32, 50, 0.2)',
                'gold': '0 4px 24px rgba(212, 160, 23, 0.3)',
                'glow': '0 0 30px rgba(60, 141, 219, 0.4)',
                'glow-gold': '0 0 30px rgba(212, 160, 23, 0.4)',
            },
            animation: {
                'fade-in': 'fadeIn 0.6s ease-out',
                'fade-up': 'fadeUp 0.6s ease-out',
                'float': 'float 3s ease-in-out infinite',
                'pulse-soft': 'pulseSoft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'counter': 'counter 2s ease-out',
                'shimmer': 'shimmer 2s infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                pulseSoft: {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '.7' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
            screens: {
                'xs': '375px',
                '3xl': '1920px',
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
                '128': '32rem',
            },
            borderRadius: {
                '4xl': '2rem',
            },
            backdropBlur: {
                xs: '2px',
            },
            transitionDuration: {
                '400': '400ms',
            },
            zIndex: {
                '60': '60',
                '70': '70',
                '80': '80',
                '90': '90',
                '100': '100',
            },
        },
    },

    plugins: [forms, typography, aspectRatio],
};
