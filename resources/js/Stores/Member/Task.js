import API from '../../Services/API'

const state = {
    memberSubtasks: [],
    loadingMemberSubtasks: false
}

const getters = {
    memberSubtasks: (state) => state.memberSubtasks,
    loadingMemberSubtasks: (state) => state.loadingMemberSubtasks,
}

const mutations = {
    setMemberSubtasks: (state, memberSubtasks) => state.memberSubtasks = memberSubtasks,
    setLoadingMemberSubtasks: (state, loadingMemberSubtasks) => state.loadingMemberSubtasks = loadingMemberSubtasks
}

const actions = {
    getMemberSubtasks: async ({ commit }) => {
        return await API().get('subtask')
    },
    updateMemberSubtask: async ({ commit }, subtask) => {
        return await API().put('subtask/' + subtask.id, { status: subtask.status })
    },

}

export default {
    state,
    getters,
    mutations,
    actions
}