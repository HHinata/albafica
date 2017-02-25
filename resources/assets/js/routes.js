export default [
    {   path: '',
        component: require('./App.vue'),
        children: [
            {   path: '',
                component: require('./pages/example.vue')
            }
        ]
    }
]
