import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import es from 'vuetify/es5/locale/es'

Vue.use(Vuetify)

const opts = {
    theme: {
        dark: false,
        themes: {
            light: {
                primary: '#E3A822',
                secondary: '#1D1D1B'
            },
            dark: {
                primary: '#E3A822',
                secondary: '#1D1D1B'
            }
        },
    },
    lang: {
        locales: {es},
        current: 'es'
    }
}

export default new Vuetify(opts)
