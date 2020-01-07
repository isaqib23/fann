
export default class axiosRequest {

    static post (path, payload=null) {
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
                    details : err.response.data.errors
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
                    details : err.response.data.errors
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
                    details : err.response.data.errors
                };
            });
    }


};


