import store from "../../Stores/Index";

export const getTeamTasks = async () => {
    store.commit('setLoadingTeamTasks', true)
    await store.dispatch('getTeamTasks').then((result) => {
        store.commit('setTeamTasks', result.data)
        store.commit('setLoadingTeamTasks', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const showTeamTask = async (taskId) => {
    store.commit('setLoadingTeamTask', true)
    await store.dispatch('showTeamTask', taskId).then((result) => {
        store.commit('setTeamTask', result.data)
        store.commit('setLoadingTeamTask', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const storeSubtask = async (data) => {
    store.commit('setLoadingStoreSubtask', true)
    await store.dispatch('storeSubtask', data).then((result) => {
        store.commit('setWithSuccess', true)
        store.commit('setLoadingStoreSubtask', false)
    }).catch((err) => {
        if (err && (err.response.status == 422)) {
            store.commit('setValidationError', err.response.data)
        }
        store.commit('setLoadingStoreSubtask', false)
    });
}

export const assignUserSubtask = async (data) => {
    store.commit('setLoadingAssignUser', true)
    await store.dispatch('assignUser', data).then((result) => {
        store.commit('setWithSuccess', true)
        store.commit('setLoadingAssignUser', false)
    }).catch((err) => {
        if (err && (err.response.status == 422)) {
            store.commit('setValidationError', err.response.data)
        }
        store.commit('setLoadingAssignUser', false)
    });
}