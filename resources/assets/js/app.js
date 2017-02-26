
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
import routes from './routes'
import Element from 'element-ui'
import 'element-ui/lib/theme-default/index.css';
import axios from 'axios'

Vue.use(VueRouter);
Vue.use(Element)
Vue.use(axios)

// 时间转换函数
Vue.filter('time', function (value) {
    return new Date(parseInt(value) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
})

const router = new VueRouter({
    routes // （缩写）相当于 routes: routes
})

const app = new Vue({
    router
}).$mount('#app')
