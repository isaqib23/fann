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
        let response =  await axiosRequest.post('campaignManagement.getActiveCampaignsByCompany', payload);

        commit('setCampaigns', response.details);
        return response;
    },

    async getCampaignById({commit}, payload) {
        let response =  await axiosRequest.post('campaignManagement.getCampaignById', payload);

        return response.details;
    },

    async getCampaignProposal({commit}, payload) {
        let response =  await axiosRequest.post('campaignManagement.getCampaignProposal', payload);

        return response.details;
    },

    async getInfluencerAssignTouchPoint({commit}, payload) {
        let response =  await axiosRequest.post('campaignManagement.getInfluencerAssignTouchPoint', payload);

        return response.details;
    },

    async getInfluencerCampaign({commit}, payload) {
        let response =  await axiosRequest.post('campaignManagement.getInfluencerCampaign', payload);

        return response.details;
    },

    async getActiveCampaigns({commit}, payload) {
        let response =  await axiosRequest.post('campaignManagement.getActiveCampaigns', payload);

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





