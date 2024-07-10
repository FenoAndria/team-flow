import API from '../../Services/API'

const state = {
    members: [],
    loadingMembers: false,
}

const getters = {
    members: (state) => state.members,
    loadingMembers: (state) => state.loadingMembers,
}

const mutations = {
    setMembers: (state, members) => state.members = members,
    setLoadingMembers: (state, loadingMembers) => state.loadingMembers = loadingMembers,
}

const actions = {
    getMembers: async ({ commit }) => {
        return await API().get('member')
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}