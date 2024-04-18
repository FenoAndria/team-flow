const state = {
    validationError: '',
}

const getters = {
    validationError: (state) => state.validationError,
}

const mutations = {
    setValidationError: (state, validationError) => state.validationError = validationError,
}

const actions = {
    
}

export default {
    state,
    getters,
    mutations,
    actions
}