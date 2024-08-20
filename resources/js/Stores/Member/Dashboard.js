import API from '../../Services/API'

const state = {
    memberDashboard: [],
    loadingMemberDashboard: false,
}

const getters = {
    memberDashboard: (state) => state.memberDashboard,
    loadingMemberDashboard: (state) => state.loadingMemberDashboard,
}

const mutations = {
    setMemberDashboard: (state, memberDashboard) => state.memberDashboard = memberDashboard,
    setLoadingMemberDashboard: (state, loadingMemberDashboard) => state.loadingMemberDashboard = loadingMemberDashboard,
}

const actions = {
    getMemberDashboard: async ({ commit }) => {
        return await API().get('member-dashboard')
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}