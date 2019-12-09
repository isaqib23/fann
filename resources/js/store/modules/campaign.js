/**
 * Initial state
 */
export const state = {
  campaignObjective               : null,
  campaignPlacement               : null,
  campaignInformation             : null,
  influencerSearchResults         : null,
  touchPoint                    : {
      caption                     : null,
      hashtags                    : null,
      mentions                    : null,
      guideLines                  : null,
      dispatchProduct             : null,
      barterProduct               : null,
      amount                      : 0,
      campaignDescription         : null,
      instaPost                   : null,
      instaBioLink                : null,
      instaStory                  : null,
      instaStoryLink              : null,
      images                      : [],
      touchPointConditionalFields : {
          touchPointTitle          : false,
          touchPointInstagramFormat: false,
          touchPointPaymentFormat  : false,
          isPaid                   : false,
          isBarter                 : false,
          additionalPayAsBarter    : false,
          additionalPayAsAmount    : false,
          touchPointProduct        : false,
          touchPointBrand          : false
      }
  },
  inviteSearchParams        : {
        niche                   : 0,
        placement               : null,
        followers               : null,
        likes                   : null,
        eng_rate                : null,
        gender                  : null,
        age_range               : null,
        country                 : null,
        rating                  : null
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
    setCampaignInformation(state, info) {
        state.campaignInformation = info
    },
    setTouchPoint(state, [index, val]) {
        Vue.set(state.touchPoint, index, val)
    },
    setTouchPointField(state, touchPointFields) {
        state.touchPoint.touchPointConditionalFields = touchPointFields
    },
    setInviteSearchParams(state, [index, val]) {
        Vue.set(state.inviteSearchParams, index, val)
    },
    setInfluencerSearchResults(state, info) {
        state.influencerSearchResults = info
    },

}

/**
 * Actions
 */
export const actions = {
    async saveObjective({commit}, payload) {

        commit('setObjective', payload);
        let response =  await CampaignAxios.saveCampaign(payload);

        commit('setCampaignInformation', response);
        return response;
    },
    async fetchAllPlacements() {
        return await CampaignAxios.getAllPlacements();
    },
    async savePlacementAndPaymentType({ commit }, payload) {

    },
    async saveTouchPoint({commit, state}) {

         let payload  = {
             'campaignId'  : state.campaignInformation.details.id,
             'payment'     : state.campaignPlacement,
             'platformId'  : state.campaignPlacement.platform,
             'touchPoint'  : state.touchPoint
         }

         let response = await CampaignAxios.saveTouchPoint(payload);

         return response;
    },
    async saveTouchPointField({ commit }, payload) {
        commit('setTouchPointField',payload);
    },
    async inviteSearch({commit, state}, payload) {

        _.forEach(payload, function(value, key) {
            commit('setInviteSearchParams', [key, value]);
        });

        let response =  await CampaignAxios.getInfluencersToInvite( state.inviteSearchParams );

        if (response.status == 200) {
            commit('setInfluencerSearchResults', response.details);
        }
    }
}

/**
 * Getters
 */
export const getters = {
    campaignObjective: state => state.campaignObjective,
    campaignPlacement: state => state.campaignPlacement,
    campaignInformation: state => state.campaignInformation,
    touchPoint: state => state.touchPoint,
    inviteSearchParams: state => state.inviteSearchParams,
    influencerSearchResults: state => state.influencerSearchResults,
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

    static saveTouchPoint (payload) {
        return axios.post(api.path('campaign.saveTouchPoint'), payload)
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
    static getInfluencersToInvite (payload) {
        return axios.post(api.path('user.searchInfluencers'), payload)
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

};




