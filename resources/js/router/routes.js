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
            component : require('$comp/businessOwner/BusinessOwnerWrapper').default,
            children  : [
                {
                    path      : '',
                    name      : 'index',
                    redirect  : {name: 'settings-business-profile'}
                },
                {
                    path      : 'dashboard',
                    name      : 'dashboard',
                    component : require('$comp/businessOwner/views/dashboard').default
                },
                {
                    path      : 'shopify-app',
                    name      : 'shopify-app',
                    component : require('$comp/businessOwner/shopify/Shakehand').default
                },
            ]
        },
        {
            path      : '',
            component : require('$comp/general/FullContentWidthWrapper').default,
            children  : [
                {
                    path      : 'campaign/create',
                    component : require('$comp/businessOwner/campaign/CreateFullWidthContentWrapper').default,
                    children  : [
                        {
                            path      : 'requirements',
                            name      : 'create-campaign-requirements',
                            component : require('$comp/businessOwner/campaign/CreateCampaignRequirements').default
                        }
                    ]
                },
                {
                    path      : 'settings',
                    component : require('$comp/businessOwner/campaign/CreateFullWidthContentWrapper').default,
                    children  : [
                        {
                            path      : 'business-profile',
                            name      : 'settings-business-profile',
                            component : require('$comp/businessOwner/settings/Settings').default
                        }
                    ]

                },
                {
                    path      : 'manage',
                    component : require('$comp/businessOwner/campaign/CreateFullWidthContentWrapper').default,
                    children  : [
                        {
                            path      : 'campaign',
                            name      : 'manage-campaigns',
                            component : require('$comp/businessOwner/campaign/manage/index').default
                        }
                    ]
                },
            ]
        },
        {
            path      : '',
            component : require('$comp/general/FullContentWidthWrapper').default,
            children  : [
                {
                    path      : 'influencer',
                    component : require('$comp/businessOwner/campaign/CreateFullWidthContentWrapper').default,
                    children  : [
                        {
                            path      : 'profile',
                            name      : 'influencer-profile',
                            component : require('$comp/businessOwner/influencer/Profile').default
                        }
                    ]

                }

            ]
        },
        {
            path      : '',
            component : require('$comp/general/FullContentWidthWrapper').default,
            children  : [
                {
                    path      : '',
                    component : require('$comp/businessOwner/campaign/CreateFullWidthContentWrapper').default,
                    children  : [
                        {
                            path      : 'shipment',
                            name      : 'shipment',
                            component : require('$comp/businessOwner/shipment/Shipment').default
                        }
                    ]

                }

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
