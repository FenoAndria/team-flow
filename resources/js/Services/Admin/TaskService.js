import store from "../../Stores/Index";

export const getTasks = async () => {
    store.commit('setLoadingTasks', true)
    await store.dispatch('getTasks').then((result) => {
        store.commit('setTasks', result.data)
        store.commit('setLoadingTasks', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const storeTask = async (data) => {
    store.commit('setLoadingStoreTask', true)
    await store.dispatch('storeTask', data).then((result) => {
        store.commit('setWithSuccess', true)
        store.commit('setLoadingStoreTask', false)
    }).catch((err) => {
        if (err && (err.response.status == 422)) {
            store.commit('setValidationError', err.response.data)
        }
        store.commit('setLoadingStoreTask', false)
    });
}
