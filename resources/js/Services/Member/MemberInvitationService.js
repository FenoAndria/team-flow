import store from "../../Stores/Index"

export const getMemberInvitations = async () => {
    store.commit('setLoadingMemberInvitations', true)
    await store.dispatch('getMemberInvitations').then((result) => {
        store.commit('setMemberInvitations', result.data)
        store.commit('setLoadingMemberInvitations', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const updateMemberInvitations = async (invitation) => {
    await store.dispatch('updateMemberInvitations', invitation).then((result) => {

    }).catch((err) => {
        console.log(err);
    });
}