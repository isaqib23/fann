/**
 * Initial state
 */
export const state = {
  campaignObjective: null,
  campaignPlacement: null,
  campaignInformation: null,
  shopifyProduct: null,
  touchPoints        : [],
  touchPoint: {
      id                   : null,
      caption              : null,
      hashtags             : null,
      mentions             : null,
      guideLines           : [],
      dispatchProduct      : {},
      barterProduct        : {},
      amount               : 0,
      campaignDescription  : null,
      images               : [],
      instaPost            : null,
      instaBioLink         : null,
      instaStory           : null,
      instaStoryLink       : null,
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
        followers               : null,
        likes                   : null,
        eng_rate                : null,
        gender                  : null,
        age_range               : null,
        country                 : null,
        rating                  : null
  },
  listOfChatBox  : [],
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
    resetTouchPoint(state, touchPoint) {
        state.touchPoint = touchPoint;
    },
    saveTouchPoint(state, touchPoint) {
        state.touchPoints.push(touchPoint);
    },
    saveTouchPoints(state, touchPoint) {
        state.touchPoints = (touchPoint);
    },
    setShopifyProduct(state, shopifyProduct) {
        state.shopifyProduct = shopifyProduct;
    },
    updateCampaignInformation(state, [index, val]) {
        Vue.set(state.campaignInformation, index, val)
    },
    setChatBox(state, payload) {
        state.listOfChatBox.push(payload)
    },
    delChatBox(state, val) {
      state.listOfChatBox.splice(val,1);
    }

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
        let response = await CampaignAxios.savePlacementAndPaymentType(payload);
        commit('setPlacement',response);

    },
    async saveTouchPoint({commit, state}) {

         let payload  = {
             'campaignId'           : state.campaignInformation.id,
             'campaignInformation'  : state.campaignInformation,
             'payment'              : state.campaignPlacement,
             'platformId'           : state.campaignPlacement.platform,
             'touchPoint'           : state.touchPoint
         }

         commit('saveTouchPoint',state.touchPoint);
         let response = await CampaignAxios.saveTouchPoint(payload);

         return response;
    },
    async saveTouchPointField({ commit }, payload) {

        commit('setTouchPointField',payload);

    },
    async resetTouchPoint({ commit },payload) {
        commit('resetTouchPoint',payload);
    },
    async getCampaignTouchPoint({commit, state},payload) {

        let response = await CampaignAxios.getCampaignTouchPoint(payload);
        if(!_.isNil(response.details.touchPoints)) {
            commit('saveTouchPoints', response.details.touchPoints);
        }
        commit('setObjective', response.details.campaignObjective);
        commit('setPlacement',response.details.payment);
        commit('setCampaignInformation',response.details.campaignInformation);
        return response;
    },
    async getShopifyProduct({commit, state},payload) {

        let response = await CampaignAxios.getShopifyProduct(payload);

        commit('setShopifyProduct',response);
    },
    async getCampaignObjective({commit, state},payload) {

        let response = await CampaignAxios.getCampaignObjective(payload);
        return response.details;
    },
    async inviteSearch({commit, state}, payload) {
        _.forEach(payload, function (value, key) {
            commit('setInviteSearchParams', [key, value]);
        });

        let response = await CampaignAxios.getInfluencersToInvite(state.inviteSearchParams);
    },
    saveChatBox({commit}, payload) {
        commit('setChatBox', payload);
    },
    deleteChatBox({commit}, payload) {
        commit('delChatBox', payload);
    }
}

/**
 * Getters
 */
export const getters = {
    campaignObjective   : state => state.campaignObjective,
    campaignPlacement   : state => state.campaignPlacement,
    campaignInformation : state => state.campaignInformation,
    chatBox             : state => state.listOfChatBox,
    touchPoint          : state => state.touchPoint,
    inviteSearchParams  : state => state.inviteSearchParams,
    touchPoints         : state => state.touchPoints,
    shopifyProduct      : state => state.shopifyProduct
}

/**
 * Axios
 */
let CampaignAxios = class {

    static saveCampaign (payload) {
     return axios.post(api.path('campaign.save'), payload)
            .then(resp => {
                return resp.data.details;
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

    static getShopifyProduct (payload) {
        return axios.post(api.path('shopify.findProduct'), payload)
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

    static getCampaignObjective (payload) {
        return axios.post(api.path('campaign.getCampaignObjective'), payload)
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




