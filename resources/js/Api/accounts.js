import axios from 'axios';

export default {
    index(params) {
        return axios.get(route('api.accounts.index'), {
            params: params
        });
    },

    show(id) {
        return axios.get(route('api.accounts.show', id));
    },

    store(data) {
        return axios.post(route('api.accounts.store'), data);
    },

    update(id, data) {
        return axios.put(route('api.accounts.update', id), data);
    }
}
