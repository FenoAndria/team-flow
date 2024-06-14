import store from "../../Stores/Index"

export const getMemberTeams = async () => {
    store.commit('setLoadingMemberTeams', true)
    await store.dispatch('getMemberTeams').then((result) => {
        store.commit('setMemberTeams', result.data)
        store.commit('setLoadingMemberTeams', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const getMemberTeam = async (team) => {
    store.commit('setLoadingMemberTeam', true)
    await store.dispatch('getMemberTeam', team).then((result) => {
        store.commit('setMemberTeam', result.data)
        store.commit('setLoadingMemberTeam', false)
    }).catch((err) => {
        console.log(err.response);
    });
}
export const leaveTeam = async (teamId) => {
    await store.dispatch('leaveTeam', teamId).then((result) => {
        // console.log(result);
    }).catch((err) => {
        console.log(err.response);
    });
}
