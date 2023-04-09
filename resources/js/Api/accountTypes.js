import axios from 'axios';

export default {
    index(params) {
        return axios.get(route('api.account-types.index'), {
            params: params
        });
    },
}
