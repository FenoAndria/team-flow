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


export const storeTeam = async (team) => {
    store.commit('setLoadingStoreTeam', true)
    await store.dispatch('storeTeam', team).then((result) => {
        store.commit('setWithSuccess', true)
        store.commit('setLoadingStoreTeam', false)
    }).catch((err) => {
        if (err && (err.response.status == 422)) {
            store.commit('setValidationError', err.response.data)
        }
        store.commit('setLoadingStoreTeam', false)
    });
}
