import API from '../../Services/API'

const state = {
    teamTasks: [],
    loadingTeamTasks: false
}

const getters = {
    teamTasks: (state) => state.teamTasks,
    loadingTeamTasks: (state) => state.loadingTeamTasks,
}

const mutations = {
    setTeamTasks: (state, teamTasks) => state.teamTasks = teamTasks,
    setLoadingTeamTasks: (state, loadingTeamTasks) => state.loadingTeamTasks = loadingTeamTasks
}

const actions = {
    getTeamTasks: async ({ commit }) => {
        return await API().get('team-task')
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}