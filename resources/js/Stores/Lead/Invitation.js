import API from '../../Services/API'

const state = {
    teamInvitation: [],
    loadingTeamInvitation: false,
}

const getters = {
    teamInvitation: (state) => state.teamInvitation,
    loadingTeamInvitation: (state) => state.loadingTeamInvitation,
}

const mutations = {
    setTeamInvitation: (state, teamInvitation) => state.teamInvitation = teamInvitation,
    setLoadingTeamInvitation: (state, loadingTeamInvitation) => state.loadingTeamInvitation = loadingTeamInvitation,
}

const actions = {
    getTeamInvitation: async ({ commit }) => {
        return await API().get('team-invitation')
    },
    
}

export default {
    state,
    getters,
    mutations,
    actions
}