require("./bootstrap");

import App from "./components/App";
import router from "./router";
import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);

window.router = router;

const app = new Vue({
    el: "#app",

    created() {
        this.$store.dispatch("loadImages");
    },

    store,

    router,

    render: h => h(App)
});
