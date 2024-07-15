import store from "../../Stores/Index";

export const getMemberNotification = async () => {
    store.commit('setLoadingMemberNotification', true)
    await store.dispatch('getMemberNotification').then((result) => {
        store.commit('setMemberNotification', result.data)
        store.commit('setLoadingMemberNotification', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
