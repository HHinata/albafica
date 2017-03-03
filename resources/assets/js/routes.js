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
                path: 'problem/submit/:id',
                component: require('./pages/problem/submit.vue')
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
                path: 'rank',
                component: require('./pages/rank/index.vue')
            },
            {
                path: 'post/:id',
                component: require('./pages/post/index.vue')
            },
            {
                path: 'status/:id',
                component: require('./pages/status/content.vue')
            },
            {
                path: 'profile',
                component: require('./pages/profile/index.vue'),
                children:[
                    {
                        path: '',
                        component: require('./pages/profile/info.vue'),
                    },
                    {
                        path: 'index',
                        component: require('./pages/profile/info.vue'),
                    },
                    {
                        path: 'post',
                        component: require('./pages/profile/post.vue'),
                    },
                    {
                        path: 'new-post',
                        component: require('./pages/profile/new-post.vue'),
                    },
                    {
                        path: 'post/:id',
                        component: require('./pages/profile/detail-post.vue'),
                    },
                    {
                        path: 'contest',
                        component: require('./pages/profile/contest.vue'),
                    },
                    {
                        path: 'contest/:id',
                        component: require('./pages/profile/detail-contest.vue'),
                    },
                    {
                        path: 'problem/:id',
                        component: require('./pages/profile/detail-problem.vue'),
                    },
                    {
                        path: 'problem',
                        component: require('./pages/profile/problem.vue'),
                    },
                    {
                        path: 'new-problem',
                        component: require('./pages/profile/new-problem.vue'),
                    },
                    {
                        path: 'new-contest',
                        component: require('./pages/profile/new-contest.vue'),
                    },
                ]
            },
            {
                path: 'login',
                component: require('./pages/enter/login.vue')
            },
            {
                path: 'register',
                component: require('./pages/enter/register.vue')
            }
        ]
    }
]
