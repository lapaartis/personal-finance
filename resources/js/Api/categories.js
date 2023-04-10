import axios from 'axios';

export default {
    index(params) {
        return axios.get(route('api.categories.index'), {
            params: params
        });
    },

    show(id) {
        return axios.get(route('api.categories.show', id));
    },

    store(data) {
        return axios.post(route('api.categories.store'), data);
    },

    update(id, data) {
        return axios.put(route('api.categories.update', id), data);
    }
}
