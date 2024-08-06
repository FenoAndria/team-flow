import API from '../../Services/API'

const state = {
    adminDashboard: [],
    loadingAdminDashboard: false,
}

const getters = {
    adminDashboard: (state) => state.adminDashboard,
    loadingAdminDashboard: (state) => state.loadingAdminDashboard,
}

const mutations = {
    setAdminDashboard: (state, adminDashboard) => state.adminDashboard = adminDashboard,
    setLoadingAdminDashboard: (state, loadingAdminDashboard) => state.loadingAdminDashboard = loadingAdminDashboard,
}

const actions = {
    getAdminDashboard: async ({ commit }) => {
        return await API().get('admin-dashboard')
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}