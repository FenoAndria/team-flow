const state = {
    withSuccess: '',
}

const getters = {
    withSuccess: (state) => state.withSuccess,
}

const mutations = {
    setWithSuccess: (state, withSuccess) => state.withSuccess = withSuccess,
}

const actions = {
    
}

export default {
    state,
    getters,
    mutations,
    actions
}