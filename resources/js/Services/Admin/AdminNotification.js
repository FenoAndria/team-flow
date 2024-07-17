import store from "../../Stores/Index";

export const getAdminNotification = async () => {
    store.commit('setLoadingAdminNotification', true)
    await store.dispatch('getAdminNotification').then((result) => {
        store.commit('setAdminNotification', result.data)
        store.commit('setLoadingAdminNotification', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
