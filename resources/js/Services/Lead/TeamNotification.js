import store from "../../Stores/Index";

export const getTeamNotification = async () => {
    store.commit('setLoadingTeamNotification', true)
    await store.dispatch('getTeamNotification').then((result) => {
        store.commit('setTeamNotification', result.data)
        store.commit('setLoadingTeamNotification', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
