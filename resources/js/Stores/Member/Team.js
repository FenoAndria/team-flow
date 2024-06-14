import API from '../../Services/API'

const state = {
    memberTeams: [],
    memberTeam: '',
    loadingMemberTeams: false,
    loadingMemberTeam: false
}

const getters = {
    memberTeams: (state) => state.memberTeams,
    memberTeam: (state) => state.memberTeam,
    loadingMemberTeams: (state) => state.loadingMemberTeams,
    loadingMemberTeam: (state) => state.loadingMemberTeam,
}

const mutations = {
    setMemberTeams: (state, memberTeams) => state.memberTeams = memberTeams,
    setMemberTeam: (state, memberTeam) => state.memberTeam = memberTeam,
    setLoadingMemberTeams: (state, loadingMemberTeams) => state.loadingMemberTeams = loadingMemberTeams,
    setLoadingMemberTeam: (state, loadingMemberTeam) => state.loadingMemberTeam = loadingMemberTeam
}

const actions = {
    getMemberTeams: async ({ commit }) => {
        return await API().get('member-team')
    },
    getMemberTeam: async ({ commit }, teamId) => {
        return await API().get('member-team/' + teamId)
    },
    leaveTeam: async ({ commit }, teamId) => {
        return await API().post('leave-team/' + teamId)
    },

}

export default {
    state,
    getters,
    mutations,
    actions
}