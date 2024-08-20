import store from "../../Stores/Index";

export const getMemberDashboard = async () => {
    store.commit('setLoadingMemberDashboard', true)
    await store.dispatch('getMemberDashboard').then((result) => {
        store.commit('setMemberDashboard', result.data)
        store.commit('setLoadingMemberDashboard', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
