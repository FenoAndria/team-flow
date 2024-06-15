import API from '../../Services/API'

const state = {
    tasks: [],
    loadingTasks: false,
    loadingStoreTask: false,
}

const getters = {
    tasks: (state) => state.tasks,
    loadingTasks: (state) => state.loadingTasks,
    loadingStoreTask: (state) => state.loadingStoreTask,
}

const mutations = {
    setTasks: (state, tasks) => state.tasks = tasks,
    setLoadingTasks: (state, loadingTasks) => state.loadingTasks = loadingTasks,
    setLoadingStoreTask: (state, loadingStoreTask) => state.loadingStoreTask = loadingStoreTask,
}

const actions = {
    getTasks: async ({ commit }) => {
        return await API().get('task')
    },
    storeTask: async ({ commit }, task) => {
        return await API().post('task',task)
    },

}

export default {
    state,
    getters,
    mutations,
    actions
}