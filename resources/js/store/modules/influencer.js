import axios from 'axios'
import { api } from '~/config'

/**
 * intial state
 */
export const state = {
        profile: null,
        posts : null,
}

/**
 * mutations
 */
export const mutations = {
    setProfile(state, payload) {
        state.profile = payload
    },
    setPosts(state, payload) {
      state.posts = payload
    },
}

/**
 *
 *actions
 */
export const actions = {
     async getProfile({commit}, payload) {
        let response =  await influencer.getProfile({"user_id" :payload});
        commit('setProfile',response);
        return response;
    },
     async getPost({commit}, payload) {
        let response = await influencer.getPosts({"id":payload});
        commit('setPosts', response);
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
let influencer = class {
    static getProfile (payload) {
        return axios.put(api.path('influencer.getProfile'),payload)
            .then(resp => {
                return resp.data.details;
             })
            .catch(err =>{
                return err.response.data.errors;
            });
    }

    static getPosts(payload) {
        return axios.put(api.path('influencer.getPosts'),payload)
            .then(resp => {
                    return resp.data.posts;
                })
            .catch(err => {
                return err.response.data.errors;
            });
    }
}
