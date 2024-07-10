import store from "../../Stores/Index";

export const getMembers = async () => {
    store.commit('setLoadingMembers', true)
    await store.dispatch('getMembers').then((result) => {
        store.commit('setMembers', result.data)
        store.commit('setLoadingMembers', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
