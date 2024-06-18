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

export const updateMemberInvitation = async (invitation) => {
    await store.dispatch('updateMemberInvitation', invitation).then((result) => {

    }).catch((err) => {
        console.log(err);
    });
}

export const updateLeadInvitation = async (leadInvitation) => {
    await store.dispatch('updateLeadInvitation', leadInvitation).then(async (result) => {
        if (leadInvitation.status === 'Accepted') {
            localStorage.setItem("vuex", "");
            location.reload();
        } else {
            await getMemberInvitations();
        }
    }).catch((err) => {
        console.log(err);
    });
}