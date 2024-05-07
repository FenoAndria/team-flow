import API from '../services/API'

const state = {
    // userData: localStorage.getItem('vuex') ? JSON.parse(localStorage.getItem('vuex')).Auth.userData : ''
    isAuthenticated: false,
    userData: '',
}
const getters = {
    USERDATA: (state) => state.userData
}
const mutations = {
    SET_IS_AUTHENTICATED: (state, isAuthenticated) => state.isAuthenticated = isAuthenticated,
    SET_USERDATA: (state, userData) => state.userData = userData,
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