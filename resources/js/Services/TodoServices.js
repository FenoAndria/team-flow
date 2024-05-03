import store from '../Stores/Index'

export const getTodoTab = async () => {
    store.commit('setLoadingTodoTab', true)
    await store.dispatch('getTodoTab')
        .then((result) => {
            store.commit('setTodoTab', result.data)
            store.commit('setLoadingTodoTab', false)
        }).catch((err) => {
            console.log(err);

        });
}

export const updateTodo = async (todo) => {
    todo.done = todo.done == 1 ? 0 : 1 // à re-coder 
    store.commit('setLoadingTodoTab', true)
    await store.dispatch('updateTodo', todo)
        .then((result) => {
            store.commit('setLoadingTodoTab', false)
        }).catch((err) => {
            console.log(err);

        });
}

export const storeTodo = async (todo) => {
    await store.dispatch('storeTodo', todo)
        .then((result) => {
            
        }).catch((err) => {
            console.log(err.response);
            if (err && err.response.status == 422) {
                store.commit('setValidationError', err.response.data)
            }
        });
}

export const deleteTodo = async (todo) => {
    store.commit('setLoadingTodoTab', true)
    await store.dispatch('deleteTodo', todo)
        .then((result) => {
            store.commit('setLoadingTodoTab', false)
        }).catch((err) => {
            console.log(err);

        });
}