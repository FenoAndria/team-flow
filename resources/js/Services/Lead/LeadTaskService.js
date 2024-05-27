import store from "../../Stores/Index";

export const getTeamTasks = async () => {
    store.commit('setLoadingTeamTasks', true)
    await store.dispatch('getTeamTasks').then((result) => {
        console.log(result.data);
        store.commit('setTeamTasks', result.data)
        store.commit('setLoadingTeamTasks', false)
    }).catch((err) => {
        console.log(err.response);
    });
}