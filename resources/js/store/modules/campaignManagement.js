/**
 * Initial state
 */
export const state = {
    campaigns    : [],
    campaignChat : null,
    chatMessage  : null
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
    },
    setChatMessage(state, payload) {
        state.chatMessage = payload
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

    async initiateCampaignChat({commit}, payload) {
        let response =  await axiosRequest.post('campaign.broadcastCampaignChat', payload);
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

    sendChatMessage({commit}, payload) {
        console.info(payload, "messsage");
        commit('setChatMessage', payload);
        let response =  axiosRequest.post('campaign.broadcastCampaignMessage', payload);
        return response;
    }
}

/**
 * Getters
 */
export const getters = {
    campaigns       : state => state.campaigns,
    chatMessage     : state => state.chatMessage,
    activeTab       : state => state.activeTab
}
