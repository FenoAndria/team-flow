import store from "../../Stores/Index";

export const getTeamMember = async () => {
    store.commit('setLoadingTeamMember', true)
    await store.dispatch('getTeamMember').then((result) => {
        store.commit('setTeamMember', result.data)
        store.commit('setLoadingTeamMember', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
