import API from '../services/API'

const state = {
    // userData: localStorage.getItem('vuex') ? JSON.parse(localStorage.getItem('vuex')).Auth.userData : ''
    username: '',
    userToken: '',
}
const getters = {
    USERNAME: (state) => state.username,
    USER_TOKEN: (state) => state.userToken,
}
const mutations = {
    SET_USERNAME: (state, username) => state.username = username,
    SET_USER_TOKEN: (state, userToken) => state.userToken = userToken,
}
const actions = {
    LOGIN: async ({ commit }, user) => {
        return await API().post('auth/login', user)
    },
    REGISTER: async ({ commit }, user) => {
        return await API().post('auth/register', user)
    },
}
export default {
    state,
    getters,
    mutations,
    actions,
}