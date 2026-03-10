module.exports = {
  darkMode: 'false',
  content: [
    "./*.php",
    "./templates/**/*.php",
    "./template-parts/**/*.php",
    "./assets/js/**/*.js",
    "./includes/popups/**/*.php",
    "./includes/acf-fields/**/*.php",
    "./resources/blocks/*.php",
    "./resources/blocks/**/*.php",
    "./node_modules/flowbite/**/*.js",
    "../../plugins/**/*.php"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter','Segoe UI','sans-serif !important']
      },
      colors: {
        primary: {"50":"#FDF8E9","100":"#FCF3D7","200":"#F8E7B0","300":"#F5DB89","400":"#F1CF62","500":"#E7BE46","600":"#DDB03A","700":"#C49B2A","800":"#A37E1E","900":"#7F5F19","950":"#5C4210"}
      }
    },

  },
  plugins: [
    require('flowbite/plugin')
  ],
};