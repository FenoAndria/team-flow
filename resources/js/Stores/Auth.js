import API from '../services/API'

const state = {
    // userData: localStorage.getItem('vuex') ? JSON.parse(localStorage.getItem('vuex')).Auth.userData : ''
    userData: ''
}
const getters = {
    USER_DATA: (state) => state.userData
}
const mutations = {
    SET_USER_DATA: (state, userData) => state.userData = userData,
}
const actions = {
    LOGIN: async ({ commit }, user) => {
        return await API().post('auth/login', user)
    },
}
export default {
    state,
    getters,
    mutations,
    actions,
}