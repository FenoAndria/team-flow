import API from '../../Services/API'

const state = {
    teams: [],
    loadingTeams: false
}

const getters = {
    teams: (state) => state.teams,
    loadingTeams: (state) => state.loadingTeams,
}

const mutations = {
    setTeams: (state, teams) => state.teams = teams,
    setLoadingTeams: (state, loadingTeams) => state.loadingTeams = loadingTeams
}

const actions = {
    getTeams: async ({ commit }) => {
        return await API().get('team')
    },
    
}

export default {
    state,
    getters,
    mutations,
    actions
}