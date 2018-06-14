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
    store,
    router,
    render: h => h(App)
});

// If user want to reload page with vue component (in controls panel) - it was redirected on start page
let isAsked = false;

window.onbeforeunload =
    function (event) {
        let e = event || window.event;
        window.focus();
        if (!isAsked) {
            isAsked = true;
            let showstr = "CUSTOM_MESSAGE";
            if (e) {
                e.returnValue = showstr;
            }
            return showstr;
        }
    };

window.onfocus =
    function () {
        if (isAsked) {
            window.location.href = `${window.location.origin}/controls`;
        }
    };
