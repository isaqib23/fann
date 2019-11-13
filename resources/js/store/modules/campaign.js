import axios from 'axios'
import { api } from '~/config'

/**
 * Initial state
 */
export const state = {
  campaignObjective: null,
  campaignPlacement: null
}

/**
 * Mutations
 */
export const mutations = {
    setObjective(state, objective) {
        state.campaignObjective = objective
    },

    setPlacement(state, objective) {
        state.campaignPlacement = objective
    }

}

/**
 * Actions
 */
export const actions = {
    async saveObjective({ commit }, payload) {
        await axios.post(api.path('campaign.save'), payload)
            .then((function (resp) {
                console.info('hello', resp);
            }))
            .catch(err => {
                console.info(err.response.data.errors);
            });
        commit('setObjective',payload);
    },

   savePlacement({ commit }, payload) {
        commit('setPlacement',payload);
    },

}

/**
 * Getters
 */
export const getters = {
    campaignObjective: state => state.campaignObjective,
    campaignPlacement: state => state.campaignPlacement,
}
