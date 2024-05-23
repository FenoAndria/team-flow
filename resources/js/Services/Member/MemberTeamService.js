import store from "../../Stores/Index"

export const getTeams = async () => {
    store.commit('setLoadingTeams', true)
    await store.dispatch('getTeams').then((result) => {
        store.commit('setTeams', result.data)
        store.commit('setLoadingTeams', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const showTeam = async (team) => {
    store.commit('setLoadingShowTeam', true)
    await store.dispatch('showTeam', team).then((result) => {
        store.commit('setShowTeam', result.data)
        store.commit('setLoadingShowTeam', false)
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
