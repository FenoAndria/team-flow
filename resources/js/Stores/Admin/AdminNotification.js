import API from '../../Services/API'

const state = {
    adminNotification: [],
    loadingAdminNotification: false,
}

const getters = {
    adminNotification: (state) => state.adminNotification,
    loadingAdminNotification: (state) => state.loadingAdminNotification,
}

const mutations = {
    setAdminNotification: (state, adminNotification) => state.adminNotification = adminNotification,
    setLoadingAdminNotification: (state, loadingAdminNotification) => state.loadingAdminNotification = loadingAdminNotification,
}

const actions = {
    getAdminNotification: async ({ commit }) => {
        return await API().get('admin-notification')
    },
    
}

export default {
    state,
    getters,
    mutations,
    actions
}