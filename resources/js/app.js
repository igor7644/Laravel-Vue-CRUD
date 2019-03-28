import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import router from './routes';

import toolbar from './views/components/Toolbar.vue';
Vue.component('toolbar', require('./views/components/Toolbar.vue'));

window.Vue = require('vue');
window.Event = new Vue();

Vue.use(VueRouter);
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    router,
    components: {
        toolbar
    }
});
