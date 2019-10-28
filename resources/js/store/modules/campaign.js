import axios from 'axios'
import { api } from '~/config'

/**
 * Initial state
 */
export const state = {
  campaignObjective: null,
  token: window.localStorage.getItem('token'),
  type: null
}

/**
 * Mutations
 */
export const mutations = {

    setObjective(state, objective) {
        state.campaignObjective = objective
    }

}

/**
 * Actions
 */
export const actions = {

    saveObjective({ commit }, payload) {
        commit('setObjective',payload);
    },

}

/**
 * Getters
 */
export const getters = {
    campaignObjective: state => state.campaignObjective,

}
