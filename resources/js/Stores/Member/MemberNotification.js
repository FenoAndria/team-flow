import API from '../../Services/API'

const state = {
    memberNotification: [],
    loadingMemberNotification: false,
}

const getters = {
    memberNotification: (state) => state.memberNotification,
    loadingMemberNotification: (state) => state.loadingMemberNotification,
}

const mutations = {
    setMemberNotification: (state, memberNotification) => state.memberNotification = memberNotification,
    setLoadingMemberNotification: (state, loadingMemberNotification) => state.loadingMemberNotification = loadingMemberNotification,
}

const actions = {
    getMemberNotification: async ({ commit }) => {
        return await API().get('member-notification')
    },
    
}

export default {
    state,
    getters,
    mutations,
    actions
}