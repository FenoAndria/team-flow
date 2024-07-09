import store from "../../Stores/Index";

export const getTeamMessages = async (team) => {
    store.commit('setLoadingTeamMessages', true)
    await store.dispatch('getTeamMessages', team).then((result) => {
        store.commit('setTeamMessages', result.data)
        store.commit('setLoadingTeamMessages', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
