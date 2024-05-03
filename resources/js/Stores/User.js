import API from '../Services/API'

const state = {
    user: [],
    loadingUser: false
}

const getters = {
    user: (state) => state.user,
    loadingUser: (state) => state.loadingUser,
}

const mutations = {
    setUser: (state, user) => state.user = user,
    setLoadingUser: (state, loadingUser) => state.loadingUser = loadingUser,
}

const actions = {
    getUser: async ({ commit }) => await API().get('/user'),
    updateUser: async ({ commit }, userProfil) => await API().put('/profil', userProfil),
}

export default {
    state,
    getters,
    mutations,
    actions
}