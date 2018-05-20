

window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
window.VueAxios = require('vue-axios').default;
window.Axios = require('axios').default;
window.Vuetify = require('vuetify').default;
import {store} from './store/store';
import 'vuetify/dist/vuetify.min.css';
import Vuelidate from 'vuelidate';

Vue.config.productionTip = false;

let AppLayout = require('./components/admin/Admin.vue');

const Settings = Vue.component('Settings', require('./components/admin/Settings.vue'));
const Users = Vue.component('Users', require('./components/admin/Users.vue'));
const News = Vue.component('News', require('./components/admin/News.vue'));
const Dashboard = Vue.component('Dashboard', require('./components/admin/Dashboard.vue'));


const Login = Vue.component('Login', require('./components/Login.vue'));
const Register = Vue.component('Register', require('./components/Register.vue'));

Vue.use(VueRouter, VueAxios, Axios, Vuetify, Vuelidate);

const routes = [
    {
        name: 'Settings',
        path: 'settings',
        component: Settings,
        meta:{
            adminAuth:true,moderAuth:false
        }
    },
    {
        name: 'Users',
        path: 'users',
        component: Users,
        meta:{
            adminAuth:true,moderAuth:false
        }
    },
    {
        name: 'News',
        path: 'news',
        component: News,
        meta:{
            adminAuth:true,moderAuth:false
        }
    },
    {
        name: 'Dashboard',
        path: '/adm',
        component: Dashboard,
        meta:{
            adminAuth:true,moderAuth:false
        }
    },
    {
        name: 'Login',
        path: '/login',
        component: Login,
        meta:{
            adminAuth:true,moderAuth:false
        }
    },
    {
        name: 'Register',
        path: '/register',
        component: Register,
        meta:{
            adminAuth:true,moderAuth:false
        }
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

    )
).$mount('#app');
