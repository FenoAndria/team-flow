import store from "../../Stores/Index";
import router from '../../Router/Index'

export const getTeamTasks = async () => {
    store.commit('setLoadingTeamTasks', true)
    await store.dispatch('getTeamTasks').then((result) => {
        store.commit('setTeamTasks', result.data)
        store.commit('setLoadingTeamTasks', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const showTeamTask = async (taskId) => {
    store.commit('setLoadingTeamTask', true)
    await store.dispatch('showTeamTask', taskId).then((result) => {
        store.commit('setTeamTask', result.data)
        store.commit('setLoadingTeamTask', false)
    }).catch((err) => {
        console.log(err.response);
    });
}

export const storeSubtask = async (data) => {
    await store.dispatch('storeSubtask', data).then((result) => {
        console.log(result.data);
        router.push({ name: 'LeadTaskShow', params: { task: data.taskId } })
    }).catch((err) => {
        console.log(err.response);
    });
}