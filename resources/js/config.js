const apiUrl = faan.apiUrl;

export const settings = {
    appName: faan.appName,
    appURL: faan.siteUrl
}

class URL {
    constructor(base) {
        this.base = base
    }

    path(path, args) {
        path = path.split('.')
        let obj = this,
            url = this.base

        for (let i = 0; i < path.length && obj; i++) {
            if (obj.url) {
                url += '/' + obj.url
            }

            obj = obj[path[i]]
        }
        if (obj) {
            url = url + '/' + (typeof obj === 'string' ? obj : obj.url)
        }

        if (args) {
            for (let key in args) {
                url = url.replace(':' + key, args[key])
            }
        }

        return url
    }
}

import campaign from '../js/apiRoutes/campaign';
import setting from '../js/apiRoutes/settings';
import shopify from '../js/apiRoutes/shopify';

export const api = Object.assign(new URL(apiUrl), {
    url: '',

    login: {
        url: 'login',
        refresh: 'refresh'
    },

    logout: 'logout',

    register: 'register',

    password: {
        url: 'password',
        forgot: 'email',
        reset: 'reset'
    },

    me: 'me',

    user: {
        url: 'user',

        activate          :  ':id/activate',
        single            :  ':id',
        restore           :  ':id/restore',
        searchInfluencers :  'searchInfluencers'
    },
    profile: {
        url: 'profile'
    },
    countryList: {
        'url': 'country/all'
    },
    stateList: {
        'url': 'country/states'
    },
    getNotifications:{
        'url' : 'getNotifications'
    },
    campaign: campaign,
    setting:  setting,
    shopify:  shopify,

})
