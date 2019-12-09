/**
 * Initial state
 */
export const state = {
  campaignObjective: null,
  campaignPlacement: null,
  campaignInformation: null,
  touchPoints        : [],
  touchPoint: {
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
    resetTouchPoint(state, touchPoint) {
        state.touchPoint = touchPoint;
    },
    saveTouchPoint(state, touchPoint) {
        state.touchPoints.push(touchPoint);
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

        commit('setPlacement',payload);

    },
    async saveTouchPoint({commit, state}) {

         let payload  = {
             'campaignId'  : state.campaignInformation.details.id,
             'payment'     : state.campaignPlacement,
             'platformId'  : state.campaignPlacement.platform,
             'touchPoint'  : state.touchPoint
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
}

/**
 * Getters
 */
export const getters = {
    campaignObjective: state => state.campaignObjective,
    campaignPlacement: state => state.campaignPlacement,
    campaignInformation: state => state.campaignInformation,
    touchPoint: state => state.touchPoint,
    touchPoints: state => state.touchPoints

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

};




