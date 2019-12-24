/**
 * Initial state
 */
export const state = {

    campaigns    : [],
    campaignChat : null

}

/**
 * Mutations
 */
export const mutations = {
    setCampaigns(state, objective) {
        state.campaigns = objective
    },
    setCampaignChat(state, payload) {
        state.campaignChat = payload
    }
}

/**
 * Actions
 */
export const actions = {
    async fetchCampaigns({commit}, payload) {
        let response =  await CampaignManageAxios.post('campaignManagement.getActiveCampaigns', payload);

        commit('setCampaigns', response.details);
        return response;
    },

    async initiateCampaignChat({commit}, payload) {
        let response =  await CampaignManageAxios.post('campaign.broadcastCampaignChat', payload);
        return response;
    }
}

/**
 * Getters
 */
export const getters = {
    campaigns       : state => state.campaigns
}

/**
 * Axios
 */
let CampaignManageAxios = class {

    static post (path, payload) {
        return axios.post(api.path(path), payload)
            .then(resp => {
                return {
                    status : 200,
                    details : resp.data.details
                };
            })
            .catch(err => {
                return {
                    status : err.response.status,
                    details : err.response.data.errors
                };
            });
    }

    static put (path, payload) {
        return axios.put(api.path(path), payload)
            .then(resp => {
                return {
                    status : 200,
                    details : resp.data.details
                };
            })
            .catch(err => {
                return {
                    status : err.response.status,
                    details : err.response.data.errors
                };
            });
    }

    static get (path, payload = null) {
        return axios.get(api.path(path) + payload)
            .then(resp => {
                return {
                    status : 200,
                    details : resp.data.details
                };
        })
        .catch(err => {
            return {
                status : err.response.status,
                details : err.response.data.errors
            };
        });
    }

};




