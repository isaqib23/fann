import Vue from 'vue'
import Vuetify, { VSnackbar, VBtn, VIcon, VForm } from 'vuetify/lib'
import VuetifyToast from 'vuetify-toast-snackbar'

let colors = {
    "primary"       : "#EE6F6F",
    "secondary"     : "#302E5C",
    "accent"        : "#403C79",
    "error"         : "#FF5252",
    "info"          : "#2196F3",
    "success"       : "#4CAF50",
    "warning"       : "#FFC107",
    "primaryActive" : "#547ED6",
    "integrityColor": "#afbbc1",
    "darkSecondary" : "#2f2f2f",
    "darkTextColor" : "#dcdcdc",
    "attention"     : "#de5b7b",
    "grayLight"     : "#BAC3C9",
    "grayLighten"   : "#EDEDED",
    "gutter"        : "#F7F7FF",
    "gutterDark"    : "#F4F7FD",
    "decent"        : "#53508C",
    "white"        : "#FFFFFF",
};

Vue.use(Vuetify, {
    components: {
        VSnackbar,
        VBtn,
        VIcon,
        VForm
    }
})
Vue.use(VuetifyToast)

export default new Vuetify({
    theme   : {
        dark    : false,
        themes  : {
            light   : colors
        }
    },
    icons   : {
        iconfont    : 'mdi',
    },
    options: {
        customProperties: true
    }
})
