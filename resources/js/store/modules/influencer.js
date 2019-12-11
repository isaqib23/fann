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
    setProfile(state, payload) {
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
        let response =  await influencerProfile.getProfile({"user_id" :payload});
        commit('setProfile',response);
        return response;
    },
     async getPost({commit}, payload) {
        let response = await influencerProfile.getPosts();
        commit('getPosts', response);
        return response;
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
