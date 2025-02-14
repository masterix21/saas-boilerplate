import colors from 'tailwindcss/colors';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: ['selector', '[data-mode="dark"]'],

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/livewire/flux-pro/stubs/**/*.blade.php",
        "./vendor/livewire/flux/stubs/**/*.blade.php",
    ],
  theme: {
    extend: {
        colors: {
            primary: colors.blue,
            secondary: colors.zinc,
            info: colors.sky,
            success: colors.emerald,
            warning: colors.orange,
            danger: colors.red,
            custom: {
                50: 'rgba(var(--c-50), <alpha-value>)',
                100: 'rgba(var(--c-100), <alpha-value>)',
                200: 'rgba(var(--c-200), <alpha-value>)',
                300: 'rgba(var(--c-300), <alpha-value>)',
                400: 'rgba(var(--c-400), <alpha-value>)',
                500: 'rgba(var(--c-500), <alpha-value>)',
                600: 'rgba(var(--c-600), <alpha-value>)',
                700: 'rgba(var(--c-700), <alpha-value>)',
                800: 'rgba(var(--c-800), <alpha-value>)',
                900: 'rgba(var(--c-900), <alpha-value>)',
                950: 'rgba(var(--c-950), <alpha-value>)',
            },
        },
    },
  },
  plugins: [
      forms,
      typography,
  ],
}

