import store from "../../Stores/Index"

export const getMemberSubtasks = async () => {
    store.commit('setLoadingMemberSubtasks', true)
    await store.dispatch('getMemberSubtasks').then((result) => {
        store.commit('setMemberSubtasks', result.data)
        store.commit('setLoadingMemberSubtasks', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const updateMemberSubtask = async (task) => {
    await store.dispatch('updateMemberSubtask', task).then((result) => {

    }).catch((err) => {
        console.log(err);
    });
}