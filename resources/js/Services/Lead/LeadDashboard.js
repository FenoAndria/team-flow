import store from "../../Stores/Index";

export const getLeadDashboard = async () => {
    store.commit('setLoadingLeadDashboard', true)
    await store.dispatch('getLeadDashboard').then((result) => {
        store.commit('setLeadDashboard', result.data)
        store.commit('setLoadingLeadDashboard', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
