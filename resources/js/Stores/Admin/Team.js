import API from '../../Services/API'

const state = {
    teams: [],
    loadingTeams: false,
    team: '',
    loadingTeam: false,
    loadingStoreTeam: false,
}

const getters = {
    teams: (state) => state.teams,
    loadingTeams: (state) => state.loadingTeams,
    team: (state) => state.team,
    loadingTeam: (state) => state.loadingTeam,
    loadingStoreTeam: (state) => state.loadingStoreTeam,
}

const mutations = {
    setTeams: (state, teams) => state.teams = teams,
    setLoadingTeams: (state, loadingTeams) => state.loadingTeams = loadingTeams,
    setTeam: (state, team) => state.team = team,
    setLoadingTeam: (state, loadingTeam) => state.loadingTeam = loadingTeam,
    setLoadingStoreTeam: (state, loadingStoreTeam) => state.loadingStoreTeam = loadingStoreTeam,
}

const actions = {
    getTeams: async ({ commit }) => {
        return await API().get('team')
    },
    getTeam: async ({ commit }, team) => {
        return await API().get('team/' + team)
    },
    storeTeam: async ({ commit }, team) => {
        return await API().post('team', team)
    },

}

export default {
    state,
    getters,
    mutations,
    actions
}