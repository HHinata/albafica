export default [
    {   path: '/contest/list',
        component: require('./components/contest/list.vue')
    },
    {   path: '/contest/detail/:id',
        component: require('./components/contest/detail.vue'),
        children: [
            {
                path: '',
                component: require('./components/contest/problem/list.vue')
            },
            {
                path: 'rank',
                component: require('./components/contest/rank.vue')
            },
            {
                path: 'problem/detail',
                component: require('./components/contest/problem/detail.vue')
            },
            {
                path: 'problem/submit',
                component: require('./components/contest/problem/submit.vue')
            },
            {
                path: 'status/list',
                component: require('./components/contest/status/list.vue')
            },
            {
                path: 'status/detail',
                component: require('./components/contest/status/detail.vue')
            },
            {
                path: '/contest/status/detail',
                component: require('./components/contest/status/detail.vue')
            }
        ]
    },

    {   path: '/contest/admin/list',
        component: require('./components/contest/admin/list.vue')
    },
    {
        path: '/contest/admin/detail',
        component: require('./components/contest/admin/detail.vue')
    },
    {
        path: '/contest/problem/detail',
        component: require('./components/contest/problem/detail.vue')
    },
    {   path: '/contest/problem/submit',
        component: require('./components/contest/problem/submit.vue')
    },
    {
        path: '/status/list',
        component: require('./components/status/list.vue') },
    {
        path: '/status/detail',
        component: require('./components/status/detail.vue')
    },
    {
        path: '/problem/list',
        component: require('./components/problem/list.vue')
    },
    {
        path: '/problem/detail',
        component: require('./components/problem/detail.vue')
    },
    {
        path: '/problem/submit',
        component: require('./components/problem/submit.vue')
    },
    {
        path: '/problem/admin/grab',
        component: require('./components/problem/admin/grab.vue')
    },
    {
        path: '/problem/admin/detail',
        component: require('./components/problem/admin/detail.vue')
    },
    {
        path: '/problem/admin/list',
        component: require('./components/problem/admin/list.vue')
    },
]
