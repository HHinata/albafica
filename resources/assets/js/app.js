
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('navbar', require('./components/navbar.vue'));
Vue.component('sidebar', require('./components/sidebar.vue'));
Vue.component('loader', require('./components/loader.vue'));
Vue.component('searchbar', require('./components/searchbar.vue'));

Vue.use(VueRouter);

Vue.filter('time', function (value) {
    return new Date(parseInt(value) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
})

const routes = [
    { path: '/contest/list', component: require('./components/contest/list.vue') },
    { path: '/contest/detail', component: require('./components/contest/detail.vue') },
    { path: '/contest/rank', component: require('./components/contest/rank.vue') },

    { path: '/contest/admin/list', component: require('./components/contest/admin/list.vue') },
    { path: '/contest/admin/detail', component: require('./components/contest/admin/detail.vue') },

    { path: '/contest/problem/detail', component: require('./components/contest/problem/detail.vue') },
    { path: '/contest/problem/submit', component: require('./components/contest/problem/submit.vue') },

    { path: '/contest/status/list', component: require('./components/contest/status/list.vue') },
    { path: '/contest/status/detail', component: require('./components/contest/status/detail.vue') },

    { path: '/status/list', component: require('./components/status/list.vue') },
    { path: '/status/detail', component: require('./components/status/detail.vue') },

    { path: '/problem/list', component: require('./components/problem/list.vue') },
    { path: '/problem/detail', component: require('./components/problem/detail.vue') },
    { path: '/problem/submit', component: require('./components/problem/submit.vue') },

    { path: '/problem/admin/grab', component: require('./components/problem/admin/grab.vue') },
    { path: '/problem/admin/detail', component: require('./components/problem/admin/detail.vue') },
    { path: '/problem/admin/list', component: require('./components/problem/admin/list.vue') },
]

const router = new VueRouter({
    routes // （缩写）相当于 routes: routes
})

const app = new Vue({
    router
}).$mount('#app')
