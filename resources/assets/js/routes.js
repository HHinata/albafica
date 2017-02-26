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
                path: 'contest',
                component: require('./pages/contest/index.vue')
            },
            {
                path: 'status',
                component: require('./pages/status/index.vue')
            }
        ]
    }
]
