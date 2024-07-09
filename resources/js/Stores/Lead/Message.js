import API from '../../Services/API'

const state = {
    leadMessages: [],
    loadingLeadMessages: false,
}

const getters = {
    leadMessages: (state) => state.leadMessages,
    loadingLeadMessages: (state) => state.loadingLeadMessages,
}

const mutations = {
    setLeadMessages: (state, leadMessages) => state.leadMessages = leadMessages,
    setLoadingLeadMessages: (state, loadingLeadMessages) => state.loadingLeadMessages = loadingLeadMessages,
}

const actions = {
    getLeadMessages: async ({ commit }) => {
        return await API().get('lead-messages')
    },
    startPolling: async ({ commit }) => {
        return await API().get('long-polling')
    },
    sendLeadMessage: async ({ commit }, message) => {
        const { content } = message
        return await API().post('lead-message', { content })
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}