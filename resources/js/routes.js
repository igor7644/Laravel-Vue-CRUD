import VueRouter from 'vue-router';

let routes = [
    {
        path: "/home",
        component: require('./views/Home.vue').default
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