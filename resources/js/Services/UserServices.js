import store from '../Stores/Index'
import router from '../Router/Index'
export const getUser = async () => {
    store.commit('setLoadingUser', true)
    await store.dispatch('getUser')
        .then((result) => {
            store.commit('setUser', result.data)
            store.commit('setLoadingUser', false)
        }).catch((err) => {
            console.log(err);
        });
}

export const updateUser = async (userProfil) => {
    await store.dispatch('updateUser', userProfil)
        .then((result) => {
            router.push({ name: "UserIndex" });
        }).catch((err) => {
            console.log(err);
        });
}
