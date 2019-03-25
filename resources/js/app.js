require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import router from './routes';

window.Vue = require('vue');
window.Event = new Vue();

Vue.use(VueRouter);
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    router
});
