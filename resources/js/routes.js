import VueRouter from 'vue-router';

let routes = [
    {
        path: "/",
        component: require('./components/ExampleComponent.vue').default
    }
];

export default new VueRouter({
    routes
});