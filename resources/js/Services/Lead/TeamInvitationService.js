import store from "../../Stores/Index";

export const getTeamInvitation = async () => {
    store.commit('setLoadingTeamInvitation', true)
    await store.dispatch('getTeamInvitation').then((result) => {
        store.commit('setTeamInvitation', result.data)
        store.commit('setLoadingTeamInvitation', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
