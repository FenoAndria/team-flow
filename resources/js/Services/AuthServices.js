import store from '../Stores/Index'
export const login = async (user) => {
    store.commit('setLoadingAuth', true)
    await store
        .dispatch("LOGIN", user)
        .then((result) => {
            store.commit("SET_IS_AUTHENTICATED", true);
            store.commit("SET_USERDATA", result.data);
            location.reload()
            store.commit('setLoadingAuth', false)
        })
        .catch((err) => {
            if (err && (err.response.status == 422 || err.response.status == 401)) {
                store.commit('setValidationError', err.response.data)
            }
            store.commit('setLoadingAuth', false)
        });
}

export const register = async (user) => {
    store.commit('setLoadingAuth', true)
    await store
        .dispatch("REGISTER", user)
        .then((result) => {
            store.commit("SET_IS_AUTHENTICATED", true);
            store.commit("SET_USERDATA", result.data);
            location.reload()
            store.commit('setLoadingAuth', false)
        })
        .catch((err) => {
            if (err && err.response.status == 422) {
                store.commit('setValidationError', err.response.data)
            }
            store.commit('setLoadingAuth', false)
        });
}
