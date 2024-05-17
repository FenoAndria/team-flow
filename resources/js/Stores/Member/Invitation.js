import API from '../../Services/API'

const state = {
    memberInvitations: [],
    loadingMemberInvitations: false
}

const getters = {
    memberInvitations: (state) => state.memberInvitations,
    loadingMemberInvitations: (state) => state.loadingMemberInvitations,
}

const mutations = {
    setMemberInvitations: (state, memberInvitations) => state.memberInvitations = memberInvitations,
    setLoadingMemberInvitations: (state, loadingMemberInvitations) => state.loadingMemberInvitations = loadingMemberInvitations
}

const actions = {
    getMemberInvitations: async ({ commit }) => {
        return await API().get('invitation')
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}