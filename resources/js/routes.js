import VueRouter from 'vue-router';

let routes = [
    {
        path: "/dashboard",
        component: require('./views/Dashboard.vue').default
    },
    {
        path: "/users",
        component: require('./views/Users.vue').default
    },
    {
        path: "/posts",
        component: require('./views/Posts.vue').default
    }
];

export default new VueRouter({
    routes
});