import API from '../../Services/API'

const state = {
    teamInvitation: [],
    loadingTeamInvitation: false,
    usersInvited: [],
    loadingUsersInvited: false,
}

const getters = {
    teamInvitation: (state) => state.teamInvitation,
    loadingTeamInvitation: (state) => state.loadingTeamInvitation,
    usersInvited: (state) => state.usersInvited,
    loadingUsersInvited: (state) => state.loadingUsersInvited,
}

const mutations = {
    setTeamInvitation: (state, teamInvitation) => state.teamInvitation = teamInvitation,
    setLoadingTeamInvitation: (state, loadingTeamInvitation) => state.loadingTeamInvitation = loadingTeamInvitation,
    setUsersInvited: (state, usersInvited) => state.usersInvited = usersInvited,
    setLoadingUsersInvited: (state, loadingUsersInvited) => state.loadingUsersInvited = loadingUsersInvited,
}

const actions = {
    getTeamInvitation: async ({ commit }) => {
        return await API().get('team-invitation')
    },
    getUsersInvitable: async ({ commit }) => {
        return await API().get('users-invitable')
    },
    inviteUser: async ({ commit }, user_id) => {
        return await API().post('team-invitation', user_id)
    },

}

export default {
    state,
    getters,
    mutations,
    actions
}