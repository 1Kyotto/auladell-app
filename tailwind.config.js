/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'cinzel': ['Cinzel'],
        'montserrat': ['Montserrat'],
      },
      colors: {
        primary: {
          100: "#ced3d2",
          200: "#9ea7a5",
          300: "#6d7a79",
          400: "#3d4e4c",
          500: "#0c221f",
          600: "#0a1b19",
          700: "#071413",
          800: "#050e0c",
          900: "#020706"
        },
        sec: {
          100: "#cce7e1",
          200: "#99cfc3",
          300: "#66b7a6",
          400: "#339f88",
          500: "#00876a",
          600: "#006c55",
          700: "#005140",
          800: "#00362a",
          900: "#001b15"
        },
        cwhite: {
          100: "#fdfdfd",
          200: "#fbfbfb",
          300: "#f9f9f9",
          400: "#f7f7f7",
          500: "#f5f5f5",
          600: "#c4c4c4",
          700: "#939393",
          800: "#626262",
          900: "#313131"
        },
        cblack: {
          100: "#cccfce",
          200: "#999f9d",
          300: "#676e6d",
          400: "#343e3c",
          500: "#010e0b",
          600: "#010b09",
          700: "#010807",
          800: "#000604",
          900: "#000302"
        },
      },
      textColor: {
        primary: '#010e0b',
        sec: '#f5f5f5',
        accents: {
          100: "#cce7e1",
          200: "#99cfc3",
          300: "#66b7a6",
          400: "#339f88",
          500: "#00876a",
          600: "#006c55",
          700: "#005140",
          800: "#00362a",
          900: "#001b15"
        },
      },
      backgroundImage: {
        'custom-background': "url('http://127.0.0.1:8000/images/background-image.jpg')", // Imagen de prueba
      }
    },
  },
  plugins: [],
}