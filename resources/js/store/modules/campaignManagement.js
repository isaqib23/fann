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
        let response =  await axiosRequest.post('campaign.getActiveCampaignsByCompany', payload);

        commit('setCampaigns', response.details);
        return response;
    },

    async getCampaignById({commit}, payload) {
        let response =  await axiosRequest.post('campaign.getCampaignById', payload);

        return response.details;
    },

    async getCampaignProposal({commit}, payload) {
        let response =  await axiosRequest.post('campaign.getCampaignProposals', payload);

        return response.details;
    },

    async getInfluencerAssignTouchPoint({commit}, payload) {
        let response =  await axiosRequest.post('campaign.getInfluencerAssignTouchPoint', payload);

        return response.details;
    },

    async getInfluencerCampaign({commit}, payload) {
        let response =  await axiosRequest.post('campaign.getInfluencerCampaign', payload);

        return response.details;
    },

    async getActiveCampaigns({commit}, payload) {
        let response =  await axiosRequest.post('campaign.getActiveCampaigns', payload);

        return response.details;
    },

    async cloneTouchPoint({commit}, payload) {
        let response =  await axiosRequest.post('campaign.cloneTouchPoint', payload);

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





