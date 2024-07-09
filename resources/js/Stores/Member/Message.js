import API from '../../Services/API'

const state = {
    teamMessages: [],
    loadingTeamMessages: false,
}

const getters = {
    teamMessages: (state) => state.teamMessages,
    loadingTeamMessages: (state) => state.loadingTeamMessages,
}

const mutations = {
    setTeamMessages: (state, teamMessages) => state.teamMessages = teamMessages,
    setLoadingTeamMessages: (state, loadingTeamMessages) => state.loadingTeamMessages = loadingTeamMessages,
}

const actions = {
    getTeamMessages: async ({ commit }, team) => {
        return await API().get('team-messages/' + team.id)
    },
    // startPolling: async ({ commit }) => {
    //     return await API().get('long-polling')
    // },
    sendTeamMessage: async ({ commit }, message) => {
        const { team_id, content } = message
        return await API().post('team-message/' + team_id, { content })
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}