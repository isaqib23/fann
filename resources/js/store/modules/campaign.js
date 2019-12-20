/**
 * Initial state
 */
export const state = {
  campaignObjective               : {},
  campaignPlacement               : null,
  campaignInformation             : null,
  influencerSearchResults         : null,
  savedDispatchProduct            : null,
  savedBarterProduct              : null,
  savedTouchPoints                : [],
  touchPoint                    : {
      id                          : null,
      caption                     : null,
      hashtags                    : null,
      mentions                    : null,
      guideLines                  : [],
      dispatchProduct             : null,
      barterProduct               : null,
      productBrand                : null,
      amount                      : 0,
      campaignDescription         : null,
      instaFormatFields           : {
          instaPost               : null,
          instaBioLink            : null,
          instaStory              : null,
          instaStoryLink          : null,
      },
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
  inviteSearchParams          : {
        niche                   : 0,
        placement               : null,
        followers               : [0, 0],
        likes                   : [0, 0],
        eng_rate                : null,
        gender                  : null,
        age_range               : null,
        country                 : null,
        rating                  : null,
        page                    : 1,
  },
  listOfChatBox  : []
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
    setChatBox(state, payload) {
        state.listOfChatBox.push(payload)
    },
    delChatBox(state, val) {
      state.listOfChatBox.splice(val,1);
    },
    resetTouchPoint(state, touchPoint) {
        state.touchPoint = touchPoint;
    },
    setSavedTouchPoints(state, touchPoint) {
        state.savedTouchPoints = (touchPoint);
    },
    setSavedDispatchProduct(state, shopifyProduct) {
        state.savedDispatchProduct = shopifyProduct;
    },
    setSavedBarterProduct(state, shopifyProduct) {
        state.savedBarterProduct = shopifyProduct;
    },
    updateCampaignInformation(state, [index, val]) {
        Vue.set(state.campaignInformation, index, val)
    }

}

/**
 * Actions
 */
export const actions = {
    async saveObjective({commit}, payload) {

        commit('setObjective', payload);
        let response =  await CampaignAxios.saveCampaign(payload);

        commit('setCampaignInformation', response.details);
        return response;
    },
    async fetchAllPlacements() {
        return await CampaignAxios.getAllPlacements();
    },
    async savePlacementAndPaymentType({ commit }, payload) {
        let response = await CampaignAxios.savePlacementAndPaymentType(payload);

        commit('setPlacement',payload);
        commit('setSavedTouchPoints', []);
    },
    async saveTouchPoint({commit, state}) {

        let payload = {
            'campaignId': state.campaignInformation.id,
            'payment': state.campaignPlacement,
            'platformId': state.campaignPlacement.platform,
            'touchPoint': state.touchPoint,
            'campaignInformation': state.campaignInformation,
        }

        let response = await CampaignAxios.saveTouchPoint(payload);
        if (response.status === 200) {
            await CampaignAxios.setCampaignTouchPointData({commit, state}, response);
        }
        return response;
    },
    async saveTouchPointField({ commit }, payload) {
        commit('setTouchPointField',payload);
    },
    async inviteSearch({commit, state}, payload) {
        _.forEach(payload, function (value, key) {
            commit('setInviteSearchParams', [key, value]);
        });

        let response =  await CampaignAxios.getInfluencersToInvite( state.inviteSearchParams );

        if (response.status == 200) {
            commit('setInfluencerSearchResults', response.details);
        }
    },
    async collectInvitation({commit, state}, payload) {
        let response =  await CampaignAxios.saveInvitation( payload );
    },
    saveChatBox({commit}, payload) {
        commit('setChatBox', payload);
    },
    deleteChatBox({commit}, payload) {
        commit('delChatBox', payload);
    },
    async resetTouchPoint({ commit },payload) {
        commit('resetTouchPoint',payload);
    },
    async getCampaignTouchPoint({commit, state},payload) {

        let response = await CampaignAxios.getCampaignTouchPoint(payload);

        if (response.status == 200) {
            await CampaignAxios.setCampaignTouchPointData({commit, state}, response);
        }
        return response;
    },
    async getSavedDispatchProduct({commit, state},payload) {

        let response = await CampaignAxios.getSavedDispatchProduct(payload);

        commit('setSavedDispatchProduct',response);
    },
    async getSavedBarterProduct({commit, state},payload) {

        let response = await CampaignAxios.getSavedBarterProduct(payload);

        commit('setSavedBarterProduct',response);
    },
    async getCampaignSavedObjective({commit, state},payload) {

        let response = await CampaignAxios.getCampaignSavedObjective(payload);
        return response.details;
    },
    async updateCampaign({commit, state},payload) {

        let response = await CampaignAxios.updateCampaign(payload);
        return response;
    }

}

/**
 * Getters
 */
export const getters = {
    campaignObjective       : state => state.campaignObjective,
    campaignPlacement       : state => state.campaignPlacement,
    campaignInformation     : state => state.campaignInformation,
    chatBox                 : state => state.listOfChatBox,
    touchPoint              : state => state.touchPoint,
    inviteSearchParams      : state => state.inviteSearchParams,
    influencerSearchResults : state => state.influencerSearchResults,
    savedTouchPoints        : state => state.savedTouchPoints,
    savedDispatchProduct    : state => state.savedDispatchProduct,
    savedBarterProduct      : state => state.savedBarterProduct


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

    static saveInvitation (payload) {
        return axios.post(api.path('campaign.saveInvitation'), payload)
            .then(resp => {
                return {
                    status: 200,
                    details: resp.data.details
                };
            })
            .catch(err => {
                return {
                    status: err.response.status,
                    details: []
                };
            });
    }

    static getCampaignTouchPoint (payload) {
        return axios.post(api.path('campaign.getCampaignTouchPoint'), payload)
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

    static getSavedDispatchProduct (payload) {
        return axios.post(api.path('shopify.findSingleProduct'), payload)
            .then(resp => {
                return {
                    status : 200,
                    details : resp.data
                };
            })
            .catch(err => {
                return {
                    status : err.response.status,
                    details : []
                };
            });
    }

    static getSavedBarterProduct (payload) {
        return axios.post(api.path('shopify.findSingleProduct'), payload)
            .then(resp => {
                return {
                    status : 200,
                    details : resp.data
                };
            })
            .catch(err => {
                return {
                    status : err.response.status,
                    details : []
                };
            });
    }

    static getCampaignSavedObjective (payload) {
        return axios.post(api.path('campaign.getCampaignSavedObjective'), payload)
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

    static updateCampaign (payload) {
        return axios.post(api.path('campaign.updateCampaignStatus'), payload)
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

    static setCampaignTouchPointData({commit, state},response) {
        if(!_.isNil(response.details.touchPoints)) {
            commit('setSavedTouchPoints', response.details.touchPoints);
        }
        commit('setObjective', response.details.campaignObjective);
        commit('setPlacement',response.details.payment);
        commit('setCampaignInformation',response.details.campaignInformation);
    }

};




