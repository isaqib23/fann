import axios from 'axios'
import { api } from '~/config'

/**
 * Initial state
 */
export const state = {
    countries: [],
    niches: [],
    states: [],
    cards: [],
    userDetail: {
        bio         : null,
        picture     : null,
        website     : null,
        niche_id       : null,
        phone       : null,
        timezone    : null,
        address     : null,
        country_id  : null,
        state_id    : null
    },
    userCompany:{
        name        : null,
        logo        : null,
        website     : null,
        niche_id       : null,
        phone       : null,
        timezone    : null,
        address     : null,
        country_id  : null,
        state_id    : null
    }
}

/**
 * Mutations
 */
export const mutations = {
    getCountries(state, payload) {
        state.countries = payload
    },
    getStates(state, payload) {
        state.states = payload
    },
    getNiches(state, payload) {
        state.niches = payload
    },
    getCards(state, payload) {
        state.cards = payload
    },
    getUserDetail(state, payload) {
        if(payload !== null) {
            state.userDetail = payload
        }
    },
    getUserCompany(state, payload) {
        if(payload !== null) {
            state.userCompany = payload
        }
    },
}

/**
 * Actions
 */
export const actions = {
    async getCountries({commit}, payload) {

        commit('getCountries', await SettingAxios.getCountries());

    },
    async getStates({commit}, payload) {

        commit('getStates', await SettingAxios.getStates(payload));

    },
    async updateProfile({ commit }, payload) {

       return await SettingAxios.updateProfile(payload);
    },
    async getNiches({commit}, payload) {

        commit('getNiches', await SettingAxios.getNiches());

    },
    async addFunds({commit}, payload) {

        await SettingAxios.addFunds({"payment" : payload});

    },
    async getCards({commit}, payload) {

        commit('getCards', await SettingAxios.getCards());

    },
    async saveUserCard({commit}, payload) {

        await SettingAxios.saveUserCard(payload);

    },
    async getUserDetail({commit}, payload) {

        commit('getUserDetail', await SettingAxios.getUserDetail());

    },
    async saveUserDetail({ commit }, payload) {

        return await SettingAxios.saveUserDetail(payload);
    },
    async getUserCompany({ commit }, payload) {

        commit('getUserCompany', await SettingAxios.getUserCompany());
    },
    async saveUserCompany({ commit }, payload) {

        return await SettingAxios.saveUserCompany(payload);
    },
}

/**
 * Getters
 */
export const getters = {
    countries: state => state.countries,
    states: state => state.states,
    niches: state => state.niches,
    cards: state => state.cards,
    userDetail: state => state.userDetail,
    userCompany: state => state.userCompany
}

/**
 * Axios
 */
let SettingAxios = class {

    static getCountries () {
     return axios.get(api.path('countryList'))
            .then(resp => {
                return resp.data.countries;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static getStates (payload) {
        return axios.post(api.path('stateList'),payload)
            .then(resp => {
                return resp.data.states;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static updateProfile (payload) {
        return axios.post(api.path('profile'),payload)
            .then(resp => {
                return resp.data;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static getNiches () {
        return axios.get(api.path('setting.getNiches'))
            .then(resp => {
                return resp.data.details;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static addFunds (payload) {
        return axios.post(api.path('setting.addFunds'),payload)
            .then(resp => {
                return resp.data;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static getCards () {
        return axios.get(api.path('setting.getUserCard'))
            .then(resp => {
                return resp.data.cards;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static saveUserCard (payload) {
        return axios.post(api.path('setting.saveUserCard'),payload)
            .then(resp => {
                return resp.data;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static getUserDetail () {
        return axios.get(api.path('setting.getUserDetail'))
            .then(resp => {
                return resp.data.details;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static saveUserDetail (payload) {
        return axios.post(api.path('setting.saveUserDetail'),payload)
            .then(resp => {
                return resp.data;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static getUserCompany () {
        return axios.get(api.path('setting.getUserCompany'))
            .then(resp => {
                return resp.data.details;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static saveUserCompany (payload) {
        return axios.post(api.path('setting.saveUserCompany'),payload)
            .then(resp => {
                return resp.data;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

};




