/**
 * Initial state
 */
export const state = {
  campaigns : []
}

/**
 * Mutations
 */
export const mutations = {
    setCampaigns(state, objective) {
        state.campaigns = objective
    },
    setActiveTab(state, objective) {
        state.activeTab = objective
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

    async getCampaignById({commit}, payload) {
        let response =  await CampaignManageAxios.post('campaignManagement.getCampaignById', payload);

        return response.details;
    },

    async getCampaignProposal({commit}, payload) {
        let response =  await CampaignManageAxios.post('campaignManagement.getCampaignProposal', payload);

        return response.details;
    },

    async getInfluencerAssignTouchPoint({commit}, payload) {
        let response =  await CampaignManageAxios.post('campaignManagement.getInfluencerAssignTouchPoint', payload);

        return response.details;
    }
}

/**
 * Getters
 */
export const getters = {
    campaigns       : state => state.campaigns,
    activeTab       : state => state.activeTab
}

/**
 * Axios
 */
let CampaignManageAxios = class {

    static post (path, payload=null) {
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
                    details : []
                };
            });
    }

    static put (path, payload=null) {
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
                    details : []
                };
            });
    }


    static get (path, payload=null) {
        return axios.get(api.path(path) + payload)
            .then(function(resp){
                return {
                    status : 200,
                    details : resp.data.details
                };
        })
        .catch(err => {
            return {
                status : err.response.status,
                details : []
            };
        });
    }


};




