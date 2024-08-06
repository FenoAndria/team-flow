import store from "../../Stores/Index";

export const getAdminDashboard = async () => {
    store.commit('setLoadingAdminDashboard', true)
    await store.dispatch('getAdminDashboard').then((result) => {
        store.commit('setAdminDashboard', result.data)
        store.commit('setLoadingAdminDashboard', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
