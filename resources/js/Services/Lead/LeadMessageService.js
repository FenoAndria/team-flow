import store from "../../Stores/Index";

export const getLeadMessages = async () => {
    // store.commit('setLoadingLeadMessages', true)
    await store.dispatch('getLeadMessages').then((result) => {
        store.commit('setLeadMessages', result.data)
        // store.commit('setLoadingLeadMessages', false)
    }).catch((err) => {
        console.log(err.response);
    }); 
}
