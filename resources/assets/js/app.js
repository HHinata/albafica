
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

Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('sidebar', require('./components/Sidebar.vue'));
Vue.component('loader', require('./components/Loader.vue'));
Vue.component('searchbar', require('./components/Searchbar.vue'));

Vue.use(VueRouter);

Vue.filter('time', function (value) {
    return new Date(parseInt(value) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
})

const routes = [
    { path: '/contest/list', component: require('./components/contest/List.vue') },
    { path: '/contest/detail', component: require('./components/contest/Detail.vue') },
    { path: '/contest/rank', component: require('./components/contest/Rank.vue') },

    { path: '/contest/admin/list', component: require('./components/contest/admin/List.vue') },
    { path: '/contest/admin/detail', component: require('./components/contest/admin/Detail.vue') },

    { path: '/contest/problem/detail', component: require('./components/contest/problem/Detail.vue') },
    { path: '/contest/problem/submit', component: require('./components/contest/problem/Submit.vue') },

    { path: '/contest/status/list', component: require('./components/contest/status/List.vue') },
    { path: '/contest/status/detail', component: require('./components/contest/status/Detail.vue') },

    { path: '/status/list', component: require('./components/status/List.vue') },
    { path: '/status/detail', component: require('./components/status/Detail.vue') },

    { path: '/problem/list', component: require('./components/problem/List.vue') },
    { path: '/problem/detail', component: require('./components/problem/Detail.vue') },
    { path: '/problem/submit', component: require('./components/problem/Submit.vue') },

    { path: '/problem/admin/grab', component: require('./components/problem/admin/Grab.vue') },
    { path: '/problem/admin/detail', component: require('./components/problem/admin/Detail.vue') },
    { path: '/problem/admin/list', component: require('./components/problem/admin/List.vue') },
]

const router = new VueRouter({
    routes // （缩写）相当于 routes: routes
})

const app = new Vue({
    router
}).$mount('#app')
