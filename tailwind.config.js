/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontWeight: {
        'extralight': '200',
        'light': '300',
        'regular': '400',
        'medium': '500',
        'semibold': '600',
        'bold': '700',
        'extrabold': '800',
      },
      fontFamily: {
        'sans': ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui'],
      },
      colors: {
        'n100': '#FFFFFF',
        'n200': '#F6F6F6',
        'n300': '#EEEEEE',
        'n400': '#E3E3E3',
        'n500': '#C6C6C6',
        'n600': '#A5A5A5',
        'n700': '#7F7F7F',
        'n800': '#6C6C6C',
        'n900': '#4D4D4D',
        'n1000': '#1B1B1B',

        'b50': '#E5F2FF',
        'b100': '#CCE4FF',
        'b200': '#A8D1FF',
        'b300': '#56A6FF',
        'b400': '#2C90FF',
        'b500': '#027AFF',
        'b600': '#025CC0',
        'b700': '#01448E',
        'b800': '#013065',
        'b900': '#01244C',
        'b1000': '#001833',

        'r50': '#FBEAEA',
        'r100': '#F5CCCC',
        'r200': '#ECA1A1',
        'r300': '#E57B7B',
        'r400': '#D94040',
        'r500': '#CC0000',
        'r600': '#AA0000',
        'r700': '#880000',
        
        'g50': '#ECF9F2',
        'g100': '#CDEEDD',
        'g200': '#ABE3C6',
        'g300': '#66CC97',
        'g400': '#2BB76E',
        'g500': '#00A951',
        
        'y50': '#FFFBF0',
        'y100': '#FFF5D4',
        'y200': '#FFEEB7',
        'y300': '#FFE593',
        'y400': '#FFDC6F',
        'y500': '#FFCB27',
        
      }
    },
  },
  plugins: [],
}

