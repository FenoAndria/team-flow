import store from "../../Stores/Index"

export const getTeams = async () => {
    store.commit('setLoadingTeams', true)
    await store.dispatch('getTeams').then((result) => {
        store.commit('setTeams', result.data)
        store.commit('setLoadingTeams', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
