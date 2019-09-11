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
    ...applyRules(['businessOwner'], [
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
                    path      : 'campaign/create',
                    component : require('$comp/admin/campaign/CreateWrapper').default,
                    children  : [
                        {
                            path      : 'name',
                            name      : 'create-step1',
                            component : require('$comp/admin/campaign/Step1').default
                        },
                        {
                            path      : 'payment-type',
                            name      : 'create-step2',
                            component : require('$comp/admin/campaign/Step2').default
                        },
                        {
                            path      : 'objective',
                            name      : 'create-step3',
                            component : require('$comp/admin/campaign/Step3').default
                        },
                        {
                            path      : 'platform',
                            name      : 'create-step4',
                            component : require('$comp/admin/campaign/Step4').default
                        },
                        {
                            path      : 'payment-nature',
                            name      : 'create-step5',
                            component : require('$comp/admin/campaign/Step5').default
                        },
                        {
                            path      : 'requirements',
                            name      : 'create-campaign-requirements',
                            component : require('$comp/admin/campaign/CreateCampaignRequirements').default
                        }
                    ]
                },
                {
                    path      : 'campaign/edit',
                    component : require('$comp/admin/campaign/CreateWrapper').default,
                    children  : [
                        {
                            path      : 'name',
                            name      : 'create-step1',
                            component : require('$comp/admin/campaign/Step1').default
                        },
                        {
                            path      : 'payment-type',
                            name      : 'create-step2',
                            component : require('$comp/admin/campaign/Step2').default
                        },
                        {
                            path      : 'objective',
                            name      : 'create-step3',
                            component : require('$comp/admin/campaign/Step3').default
                        },
                        {
                            path      : 'platform',
                            name      : 'create-step4',
                            component : require('$comp/admin/campaign/Step4').default
                        },
                        {
                            path      : 'payment-nature',
                            name      : 'create-step5',
                            component : require('$comp/admin/campaign/Step5').default
                        },
                        {
                            path      : 'requirements',
                            name      : 'create-campaign-requirements',
                            component : require('$comp/admin/campaign/CreateCampaignRequirements').default
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
