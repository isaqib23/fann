export default [
    {
        path      : '*',
        redirect  : {name: 'index'}
    },
    ...applyRules(['guest'], [
        {
            path: '', component: require('$comp/auth/AuthWrapper').default, redirect: {name: 'login'}, children:
                [
                    {
                        path      : '/login',
                        name      : 'login',
                        component : require('$comp/auth/login/Login').default
                    },
                    {
                        path      : '/register',
                        name      : 'register',
                        component : require('$comp/auth/register/Register').default
                    },
                    {
                        path: '/password',
                        component: require('$comp/auth/password/PasswordWrapper').default,
                        children: [
                            {
                                path: '',
                                name: 'forgot',
                                component: require('$comp/auth/password/password-forgot/PasswordForgot').default
                            },
                            {
                                path: 'reset/:token',
                                name: 'reset',
                                component: require('$comp/auth/password/password-reset/PasswordReset').default
                            }
                        ]
                    }
                ]
        },
    ]),
    ...applyRules(['auth'], [
        {
            path      : '',
            component : require('$comp/admin/AdminWrapper').default,
            children  : [
                {
                    path      : '',
                    name      : 'index',
                    redirect  : {name: 'profile'}
                },
                {
                    path      : 'profile',
                    component : require('$comp/admin/profile/ProfileWrapper').default,
                    children  : [
                        {
                            path      : '',
                            name      : 'profile',
                            component : require('$comp/admin/profile/Profile').default
                        },
                        {
                            path      : 'edit',
                            name      : 'profile-edit',
                            component : require('$comp/admin/profile/edit/ProfileEdit').default
                        }
                    ]
                },
                {
                    path      : 'dashboard',
                    name      : 'dashboard',
                    component : require('$comp/admin/views/dashboard').default
                },
                {
                    path      : 'campaign',
                    component : require('$comp/admin/campaign/CreateWrapper').default,
                    children  : [
                        {
                            path      : 'create/step1',
                            name      : 'create-step1',
                            component : require('$comp/admin/campaign/Step1').default
                        },
                        {
                            path      : 'create/step2',
                            name      : 'create-step2',
                            component : require('$comp/admin/campaign/Step2').default
                        },
                        {
                            path      : 'create/step3',
                            name      : 'create-step3',
                            component : require('$comp/admin/campaign/Step3').default
                        },
                        {
                            path      : 'create/step4',
                            name      : 'create-step4',
                            component : require('$comp/admin/campaign/Step4').default
                        },
                        {
                            path      : 'create/step5',
                            name      : 'create-step5',
                            component : require('$comp/admin/campaign/Step5').default
                        }
                    ]
                },
            ]
        },
    ])
]

function applyRules(rules, routes) {
    for (let i in routes) {
        routes[i].meta = routes[i].meta || {}

        if (!routes[i].meta.rules) {
            routes[i].meta.rules = []
        }
        routes[i].meta.rules.unshift(...rules)

        if (routes[i].children) {
            routes[i].children = applyRules(rules, routes[i].children)
        }
    }

    return routes
}
