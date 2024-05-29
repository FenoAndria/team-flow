import API from '../../Services/API'

const state = {
    teamMember: [],
    loadingTeamMember: false,
}

const getters = {
    teamMember: (state) => state.teamMember,
    loadingTeamMember: (state) => state.loadingTeamMember,
}

const mutations = {
    setTeamMember: (state, teamMember) => state.teamMember = teamMember,
    setLoadingTeamMember: (state, loadingTeamMember) => state.loadingTeamMember = loadingTeamMember,
}

const actions = {
    getTeamMember: async ({ commit }) => {
        return await API().get('team-member')
    },
    
}

export default {
    state,
    getters,
    mutations,
    actions
}