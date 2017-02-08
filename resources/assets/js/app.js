
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

const routes = [
    { path: '/account', component: require('./components/user/Account.vue') },
    { path: '/account-list', component: require('./components/user/AccountList.vue') },
    { path: '/grab', component: require('./components/platform/Grab.vue') },
    { path: '/submit', component: require('./components/platform/Submit.vue') },
    { path: '/problem-list', component: require('./components/problem/ProblemList.vue') },
    { path: '/problem-detail', component: require('./components/problem/ProblemDetail.vue') },
]

const router = new VueRouter({
    routes // （缩写）相当于 routes: routes
})

const app = new Vue({
    router
}).$mount('#app')
