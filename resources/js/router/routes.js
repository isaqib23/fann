export default [
    {
        path      : '*',
        redirect  : {name: 'index'}
    },
    {
        path      : '/',
        name      : 'index',
        component : require('$comp/general/Index').default
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
                    name      : 'businessOwner-index',
                    redirect  : {name: 'businessOwner-dashboard'}
                },
                {
                    path      : 'dashboard',
                    name      : 'businessOwner-dashboard',
                    component : require('$comp/businessOwner/views/dashboard').default
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
                            path      : 'campaign-objective/:slug?',
                            name      : 'create-campaign-objective',
                            component : require('$comp/businessOwner/campaign/CampaignObjective').default
                        },
                        {
                            path      : 'placement/:slug',
                            name      : 'create-campaign-placement',
                            component : require('$comp/businessOwner/campaign/CampaignPlacement').default
                        },
                        {
                            path      : 'requirements/:slug?',
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
                            path      : 'campaigns',
                            component : require('$comp/businessOwner/campaign/manage/index').default,
                            children : [
                                {
                                    path      : 'all',
                                    name      : 'manage-campaigns-all',
                                    component : require('$comp/businessOwner/campaign/manage/Listing').default
                                },
                                {
                                    path      : 'placement/:slug',
                                    name      : 'manage-campaigns-placement',
                                    component : require('$comp/businessOwner/campaign/manage/Placement').default
                                },
                                {
                                    path      : 'influencer/:slug',
                                    name      : 'manage-campaigns-influencer',
                                    component : require('$comp/businessOwner/campaign/manage/Influencer').default
                                }
                            ]
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
        {
            path      : '',
            component : require('$comp/general/FullContentWidthWrapper').default,
            children  : [
                {
                    path      : '',
                    component : require('$comp/businessOwner/campaign/CreateFullWidthContentWrapper').default,
                    children  : [
                        {
                            path      : 'payments',
                            name      : 'payments',
                            component : require('$comp/businessOwner/payments/Payment').default
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
                            path      : 'messages',
                            name      : 'messages',
                            component : require('$comp/businessOwner/messages/index').default,
                            children  : [
                                {
                                    path      : 'inbox',
                                    name      : 'message-inbox',
                                    component : require('$comp/businessOwner/messages/inbox').default
                                },
                                {
                                    path      : 'compose',
                                    name      : 'message-compose',
                                    component : require('$comp/businessOwner/messages/compose').default
                                }
                            ]
                        }
                    ]

                }

            ]
        }
    ]),
    ...applyRules(['influencer'], [
        {
            path      : '',
            component : require('$comp/influencer/InfluencerWrapper').default,
            children  : [
                {
                    path      : '',
                    name      : 'influencer-index',
                    redirect  : {name: 'influencer-dashboard'}
                },
                {
                    path      : 'dashboard',
                    name      : 'influencer-dashboard',
                    component : require('$comp/influencer/views/dashboard').default
                },
            ]
        },
        {
            path      : '',
            component : require('$comp/influencer/InfluencerWrapper').default,
            children  : [
                {
                    path      : 'organise/campaigns',
                    name      : 'influencer-campaign',
                    component : require('$comp/influencer/campaign/campaign').default,
                },
                {
                    path      : 'organise/campaigns/detail',
                    name      : 'influencer-campaign-detail',
                    component : require('$comp/influencer/campaign/campaignDetail').default,
                },
                {
                    path      : 'organise/manage/campaign',
                    name      : 'influencer-manage-campaign',
                    component : require('$comp/influencer/campaign/manage/campaign').default,
                },
                {
                    path      : 'organise/manage/influencer',
                    name      : 'influencer-manage-influencers',
                    component : require('$comp/influencer/campaign/manage/influencer').default,
                },
                {
                    path      : 'influencer/earnings/pending',
                    name      : 'influencer-earnings-pending',
                    component : require('$comp/influencer/earnings/pendingClearance').default,
                },
                {
                    path      : 'influencer/earnings/approval',
                    name      : 'influencer-earnings-approval',
                    component : require('$comp/influencer/earnings/approvalClearance').default,
                },
                {
                    path      : 'settings/profile',
                    name      : 'settings-influencer-profile',
                    component : require('$comp/influencer/settings/Settings').default

                },
                {
                    path      : 'influencer/popups',
                    name      : 'influencer-popups',
                    component : require('$comp/influencer/popups/index').default

                },
                {
                    path      : 'influencer/messages',
                    name      : 'influencer-messages',
                    component : require('$comp/influencer/messages/index').default,
                    children  : [
                        {
                            path      : 'inbox',
                            name      : 'influencer-message-inbox',
                            component : require('$comp/influencer/messages/inbox').default
                        },
                        {
                            path      : 'compose',
                            name      : 'influencer-message-compose',
                            component : require('$comp/influencer/messages/compose').default
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
