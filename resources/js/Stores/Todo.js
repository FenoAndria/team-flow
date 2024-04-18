import API from '../Services/API'

const state = {
    todoTab: [],
    loadingTodoTab: false
}

const getters = {
    todoTab: (state) => state.todoTab,
    loadingTodoTab: (state) => state.loadingTodoTab,
}

const mutations = {
    setTodoTab: (state, todoTab) => state.todoTab = todoTab,
    setLoadingTodoTab: (state, loadingTodoTab) => state.loadingTodoTab = loadingTodoTab,
}

const actions = {
    getTodoTab: async ({ commit }) => await API().get('/todo'),
    storeTodo: async ({ commit }, todo) => await API().post('/todo', todo),
    updateTodo: async ({ commit }, todo) => await API().put('/todo/' + todo.id, todo),
}

export default {
    state,
    getters,
    mutations,
    actions
}