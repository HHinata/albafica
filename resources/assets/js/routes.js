export default [
    {   path: '',
        component: require('./App.vue'),
        children: [
            {   path: '',
                component: require('./pages/index.vue')
            },
            {
                path: 'problem',
                component: require('./pages/problem/index.vue'),
            },
            {
                path: 'problem/:id',
                component: require('./pages/problem/content.vue')
            },
            {
                path: 'contest',
                component: require('./pages/contest/index.vue')
            },
            {
                path: 'contest/:id',
                component: require('./pages/contest/content.vue')
            },
            {
                path: 'status',
                component: require('./pages/status/index.vue')
            },
            {
                path: 'status/:id',
                component: require('./pages/status/content.vue')
            }
        ]
    }
]
