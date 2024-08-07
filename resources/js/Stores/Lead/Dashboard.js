import API from '../../Services/API'

const state = {
    leadDashboard: [],
    loadingLeadDashboard: false,
}

const getters = {
    leadDashboard: (state) => state.leadDashboard,
    loadingLeadDashboard: (state) => state.loadingLeadDashboard,
}

const mutations = {
    setLeadDashboard: (state, leadDashboard) => state.leadDashboard = leadDashboard,
    setLoadingLeadDashboard: (state, loadingLeadDashboard) => state.loadingLeadDashboard = loadingLeadDashboard,
}

const actions = {
    getLeadDashboard: async ({ commit }) => {
        return await API().get('lead-dashboard')
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}