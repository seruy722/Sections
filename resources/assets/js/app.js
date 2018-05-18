window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
window.VueAxios = require('vue-axios').default;
window.Axios = require('axios').default;
window.Vuetify = require('vuetify').default;
import {store} from './store/store';
import 'vuetify/dist/vuetify.min.css';
import Vuelidate from 'vuelidate';

Vue.config.productionTip = false;

let AppLayout = require('./components/App.vue');

const Settings = Vue.component('Settings', require('./components/Settings.vue'));
const Users = Vue.component('Users', require('./components/Users.vue'));
const News = Vue.component('News', require('./components/News.vue'));
const Dashboard = Vue.component('Dashboard', require('./components/Dashboard.vue'));

Vue.use(VueRouter, VueAxios, Axios, Vuetify, Vuelidate);

const routes = [
    {
        name: 'Settings',
        path: 'settings',
        component: Settings
    },
    {
        name: 'Users',
        path: 'users',
        component: Users
    },
    {
        name: 'News',
        path: 'news',
        component: News
    },
    {
        name: 'Dashboard',
        path: 'dashboard',
        component: Dashboard
    },
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

new Vue(
    Vue.util.extend({
            router,
            store
        },
        AppLayout
    )
).$mount('#app');
