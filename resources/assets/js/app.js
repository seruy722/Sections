
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

const Listposts = Vue.component('Listposts', require('./components/Listposts.vue'));
const Addpost = Vue.component('Addpost', require('./components/Addpost.vue'));
const Deletepost = Vue.component('Deletepost', require('./components/Deletepost.vue'));
const Editpost = Vue.component('Editpost', require('./components/Editpost.vue'));
const Viewpost = Vue.component('Viewpost', require('./components/Viewpost.vue'));
const Settings = Vue.component('Settings', require('./components/Settings.vue'));
const Users = Vue.component('Users', require('./components/Users.vue'));
const News = Vue.component('News', require('./components/News.vue'));

Vue.use(VueRouter, VueAxios, Axios,Vuetify,Vuelidate);

const routes = [
    {
        name: 'Listposts',
        path: '/home',
        component: Listposts
    },
    {
        name: 'Addpost',
        path: '/add-post',
        component: Addpost
    },
    {
        name: 'Deletepost',
        path: '/post-delete',
        component: Deletepost
    },
    {
        name: 'Editpost',
        path: '/edit',
        component: Editpost
    },
    {
        name: 'Viewpost',
        path: '/view/:id',
        component: Viewpost
    },
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
