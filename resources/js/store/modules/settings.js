import axios from 'axios'
import { api } from '~/config'

/**
 * Initial state
 */
export const state = {
    countries: [],
    niches: [],
    states: []
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
}

/**
 * Getters
 */
export const getters = {
    countries: state => state.countries,
    states: state => state.states,
    niches: state => state.niches
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

};




