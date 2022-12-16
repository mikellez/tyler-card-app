import axios from 'axios';

const axiosClient = axios.create({
    baseURL: 'http://localhost:8080',
    responseType: 'json',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

export default {
    helpGet: url => axiosClient.get(url).then(res => res.data),
}