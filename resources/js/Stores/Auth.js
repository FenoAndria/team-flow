import API from '../services/API'

const state = {
    isAuthenticated: false,
    userData: '',
    loadingAuth: false
}
const getters = {
    USERDATA: (state) => state.userData,
    loadingAuth: (state) => state.loadingAuth,
}
const mutations = {
    SET_IS_AUTHENTICATED: (state, isAuthenticated) => state.isAuthenticated = isAuthenticated,
    SET_USERDATA: (state, userData) => state.userData = userData,
    setLoadingAuth: (state, loadingAuth) => state.loadingAuth = loadingAuth,
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