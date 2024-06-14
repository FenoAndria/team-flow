import store from "../../Stores/Index";

export const getTeams = async () => {
    store.commit('setLoadingTeams', true)
    await store.dispatch('getTeams').then((result) => {
        store.commit('setTeams', result.data)
        store.commit('setLoadingTeams', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const getTeam = async (team) => {
    store.commit('setLoadingTeam', true)
    await store.dispatch('getTeam', team).then((result) => {
        store.commit('setTeam', result.data)
        store.commit('setLoadingTeam', false)
    }).catch((err) => {
        console.log(err.response);
    });
}