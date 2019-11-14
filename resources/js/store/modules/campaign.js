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
    async saveObjective({commit}, payload) {

        commit('setObjective', payload);
        return await CampaignAxios.saveCampaign(payload);
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
    campaignPlacement: state => state.campaignPlacement
}

/**
 * Axios
 */
let CampaignAxios = class {

    static saveCampaign (payload) {
     return axios.post(api.path('campaign.save'), payload)
            .then(resp => {
                return resp.data;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

};




