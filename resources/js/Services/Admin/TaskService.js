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