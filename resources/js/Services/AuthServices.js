import store from '../Stores/Index'

export const login = async (user) => {
    await store
        .dispatch("LOGIN", user)
        .then((result) => {
            store.commit("SET_IS_AUTHENTICATED", true);
            store.commit("SET_USER_TOKEN", result.data.token);
            store.commit("SET_USERNAME", result.data.name);
            location.reload()
        })
        .catch((err) => {
            console.log(err.response);
            if (err && (err.response.status == 422 || err.response.status == 401)) {
                store.commit('setValidationError', err.response.data)
            }
        });
}

export const register = async (user) => {
    await store
        .dispatch("REGISTER", user)
        .then((result) => {
            store.commit("SET_IS_AUTHENTICATED", true);
            store.commit("SET_USER_TOKEN", result.data.token);
            store.commit("SET_USERNAME", result.data.name);
            location.reload()
        })
        .catch((err) => {
            console.log(err);
            if (err && err.response.status == 422) {
                store.commit('setValidationError', err.response.data)
            }
        });
}
