import API from '../../Services/API'

const state = {
    teamNotification: [],
    loadingTeamNotification: false,
}

const getters = {
    teamNotification: (state) => state.teamNotification,
    loadingTeamNotification: (state) => state.loadingTeamNotification,
}

const mutations = {
    setTeamNotification: (state, teamNotification) => state.teamNotification = teamNotification,
    setLoadingTeamNotification: (state, loadingTeamNotification) => state.loadingTeamNotification = loadingTeamNotification,
}

const actions = {
    getTeamNotification: async ({ commit }) => {
        return await API().get('team-notification')
    },
    
}

export default {
    state,
    getters,
    mutations,
    actions
}