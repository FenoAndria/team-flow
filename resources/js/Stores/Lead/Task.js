import API from '../../Services/API'

const state = {
    teamTask: Object,
    loadingTeamTask: false,
    teamTasks: [],
    loadingTeamTasks: false,
    loadingStoreSubtask: false,
    loadingAssignUser: false,
}

const getters = {
    teamTask: (state) => state.teamTask,
    loadingTeamTask: (state) => state.loadingTeamTask,
    teamTasks: (state) => state.teamTasks,
    loadingTeamTasks: (state) => state.loadingTeamTasks,
    loadingStoreSubtask: (state) => state.loadingStoreSubtask,
    loadingAssignUser: (state) => state.loadingAssignUser,
}

const mutations = {
    setTeamTask: (state, teamTask) => state.teamTask = teamTask,
    setLoadingTeamTask: (state, loadingTeamTask) => state.loadingTeamTask = loadingTeamTask,
    setTeamTasks: (state, teamTasks) => state.teamTasks = teamTasks,
    setLoadingTeamTasks: (state, loadingTeamTasks) => state.loadingTeamTasks = loadingTeamTasks,
    setLoadingStoreSubtask: (state, loadingStoreSubtask) => state.loadingStoreSubtask = loadingStoreSubtask,
    setLoadingAssignUser: (state, loadingAssignUser) => state.loadingAssignUser = loadingAssignUser,
}

const actions = {
    getTeamTasks: async ({ commit }) => {
        return await API().get('team-task')
    },
    showTeamTask: async ({ commit }, taskId) => {
        return await API().get('team-task/' + taskId)
    },
    storeSubtask: async ({ commit }, data) => {
        return await API().post('subtask/' + data.taskId, { ...data.subtask })
    },
    assignUser: async ({ commit }, data) => {
        return await API().post('assign-user-subtask/' + data.subtaskId, { user_id: data.user_id })
    },
    completeTask: async ({ commit }, data) => {
        return await API().post('team-task-complete/' + data)
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}