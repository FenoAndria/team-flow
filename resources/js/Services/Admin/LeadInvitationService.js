import store from "../../Stores/Index";

export const getLeadInvitation = async () => {
    store.commit('setLoadingLeadInvitation', true)
    await store.dispatch('getLeadInvitation').then((result) => {
        store.commit('setLeadInvitation', result.data)
        store.commit('setLoadingLeadInvitation', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
