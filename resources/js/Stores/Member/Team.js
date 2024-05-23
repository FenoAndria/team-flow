import API from '../../Services/API'

const state = {
    teams: [],
    showTeam: '',
    loadingTeams: false,
    loadingShowTeam: false
}

const getters = {
    teams: (state) => state.teams,
    showTeam: (state) => state.showTeam,
    loadingTeams: (state) => state.loadingTeams,
    loadingShowTeam: (state) => state.loadingShowTeam,
}

const mutations = {
    setTeams: (state, teams) => state.teams = teams,
    setShowTeam: (state, showTeam) => state.showTeam = showTeam,
    setLoadingTeams: (state, loadingTeams) => state.loadingTeams = loadingTeams,
    setLoadingShowTeam: (state, loadingShowTeam) => state.loadingShowTeam = loadingShowTeam
}

const actions = {
    getTeams: async ({ commit }) => {
        return await API().get('team')
    },
    showTeam: async ({ commit }, teamId) => {
        return await API().get('team/' + teamId)
    },

}

export default {
    state,
    getters,
    mutations,
    actions
}