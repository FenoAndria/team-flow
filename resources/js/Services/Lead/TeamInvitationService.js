import store from "../../Stores/Index";

export const getTeamInvitation = async () => {
    store.commit('setLoadingTeamInvitation', true)
    await store.dispatch('getTeamInvitation').then((result) => {
        store.commit('setTeamInvitation', result.data)
        store.commit('setLoadingTeamInvitation', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const getUsersInvitable = async () => {
    store.commit('setLoadingUsersInvited', true)
    await store.dispatch('getUsersInvitable').then((result) => {
        store.commit('setUsersInvited', result.data)
        store.commit('setLoadingUsersInvited', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const inviteUser = async (user_id) => {
    store.commit('setLoadingInviteUser', true)
    await store.dispatch('inviteUser', { user_id }).then((result) => {
        store.commit('setWithSuccess', true)
        store.commit('setLoadingInviteUser', false)
    }).catch((err) => {
        if (err && (err.response.status == 422)) {
            store.commit('setValidationError', err.response.data)
        }
        store.commit('setLoadingInviteUser', false)
    });
}
