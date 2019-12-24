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
    }
}

/**
 * Actions
 */
export const actions = {
    async fetchCampaigns({commit}, payload) {
        let response =  await CampaignManageAxios.post('campaign_manage.getActiveCampaigns', payload);

        commit('setCampaigns', response.details);
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

    static post (path, payload=null) {
        console.log(path,payload);
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




