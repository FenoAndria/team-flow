import API from '../../Services/API'

const state = {
    leadInvitation: [],
    loadingLeadInvitation: false,
    usersInvitable: [],
    loadingUsersInvitable: false,
    loadingStoreLeadInvitation: false,
}

const getters = {
    leadInvitation: (state) => state.leadInvitation,
    loadingLeadInvitation: (state) => state.loadingLeadInvitation,
    usersInvitable: (state) => state.usersInvitable,
    loadingUsersInvitable: (state) => state.loadingUsersInvitable,
    loadingStoreLeadInvitation: (state) => state.loadingStoreLeadInvitation,
}

const mutations = {
    setLeadInvitation: (state, leadInvitation) => state.leadInvitation = leadInvitation,
    setLoadingLeadInvitation: (state, loadingLeadInvitation) => state.loadingLeadInvitation = loadingLeadInvitation,
    setUsersInvitable: (state, usersInvitable) => state.usersInvitable = usersInvitable,
    setLoadingUsersInvitable: (state, loadingUsersInvitable) => state.loadingUsersInvitable = loadingUsersInvitable,
    setLoadingStoreLeadInvitation: (state, loadingStoreLeadInvitation) => state.loadingStoreLeadInvitation = loadingStoreLeadInvitation,
}

const actions = {
    getLeadInvitation: async ({ commit }) => {
        return await API().get('lead-invitation')
    },
    getLeadInvitable: async ({ commit }) => {
        return await API().get('lead-invitable')
    },
    storeLeadInvitation: async ({ commit }, data) => {
        return await API().post('lead-invitation', data)
    },

}

export default {
    state,
    getters,
    mutations,
    actions
}