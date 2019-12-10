import axios from 'axios'
import { api } from '~/config'

/**
 * intial state
 */
export const state = {
        profile: {},
        posts : {}
}

/**
 * mutations
 */
export const mutations = {
    getProfile(state, payload) {
        state.profile = payload
    },
    getPosts(state, payload) {
      state.posts = payload
    },
}

/**
 *
 *actions
 */
export const actions = {
     async getProfile({commit}, payload) {
        commit('getProfile',await influencerProfile.getProfile({"profile_id" :payload}));

    },
     async getPost({commit}, payload) {

        commit('getPosts', await influencerProfile.getPosts());

    }
}

/**
 *
 *getters
 */
export const getters = {
    profile:state => state.profile,
    posts:state => state.posts
}

/**
 *
 * axios
 */
let influencerProfile = class {
    static getProfile (payload) {
        return axios.put(api.path('influencer.getProfile'),payload)
            .then(resp => {
                console.log(resp.data,"dta");
                return resp.data;
             })
            .catch(err =>{
                return err.response.data.errors;
            });
    }

    static getPosts() {
        return axios.get(api.path('influencer.posts'),payload)
            .then(resp => {
                    return resp.data;
                })
            .catch(err => {
                return err.response.data.errors;
            });
    }
}
