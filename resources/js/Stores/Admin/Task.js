import API from '../../Services/API'

const state = {
    tasks: [],
    task: '',
    loadingTask: false,
    loadingTasks: false,
    loadingStoreTask: false,
}

const getters = {
    task: (state) => state.task,
    tasks: (state) => state.tasks,
    loadingTask: (state) => state.loadingTask,
    loadingTasks: (state) => state.loadingTasks,
    loadingStoreTask: (state) => state.loadingStoreTask,
}

const mutations = {
    setTask: (state, task) => state.task = task,
    setTasks: (state, tasks) => state.tasks = tasks,
    setLoadingTask: (state, loadingTask) => state.loadingTask = loadingTask,
    setLoadingTasks: (state, loadingTasks) => state.loadingTasks = loadingTasks,
    setLoadingStoreTask: (state, loadingStoreTask) => state.loadingStoreTask = loadingStoreTask,
}

const actions = {
    getTask: async ({ commit }, taskId) => {
        return await API().get('task/' + taskId)
    },
    getTasks: async ({ commit }) => {
        return await API().get('task')
    },
    storeTask: async ({ commit }, task) => {
        return await API().post('task', task)
    },

}

export default {
    state,
    getters,
    mutations,
    actions
}