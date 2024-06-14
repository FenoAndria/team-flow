import API from '../../Services/API'

const state = {
    tasks: [],
    loadingTasks: false,
}

const getters = {
    tasks: (state) => state.tasks,
    loadingTasks: (state) => state.loadingTasks,
}

const mutations = {
    setTasks: (state, tasks) => state.tasks = tasks,
    setLoadingTasks: (state, loadingTasks) => state.loadingTasks = loadingTasks,
}

const actions = {
    getTasks: async ({ commit }) => {
        return await API().get('task')
    },
    
}

export default {
    state,
    getters,
    mutations,
    actions
}