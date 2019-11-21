import axios from 'axios'
import { api } from '~/config'

/**
 * Initial state
 */
export const state = {
  campaignObjective: null,
  campaignPlacement: null,
  touchPoint: {
      caption: null,
      hashtags: null,
      mentions: null,
      guideLines: {},
  }
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
    },

    setTouchPoint(state, [index, val]) {
        Vue.set(state.touchPoint, index, val)
        //Vue.set(state.touchPoint.guideLines, index, val)
        //console.info(state.touchPoint, "dashy");
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
    async fetchAllPlacements() {
        return await CampaignAxios.getAllPlacements();
    },
    async savePlacementAndPaymentType({ commit }, payload) {
        commit('setPlacement',payload);
       // return await CampaignAxios.savePlacementAndPaymentType(payload);
    }
}

/**
 * Getters
 */
export const getters = {
    campaignObjective: state => state.campaignObjective,
    campaignPlacement: state => state.campaignPlacement,
    touchPoint: state => state.touchPoint
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

    static savePlacementAndPaymentType (payload) {
        return axios.put(api.path('campaign.savePlacementAndPaymentType'), payload)
            .then(resp => {
                return resp.data;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

    static getAllPlacements () {
        return axios.get(api.path('campaign.allPlacements'))
            .then(resp => {
                console.info('resp', resp);
                return resp.data;
            })
            .catch(err => {
                console.info(err.response.data.errors);
            });
    }

};




