import Vuex from 'vuex'
import { VuexPersistence } from 'vuex-persist'
import Todo from './Todo';
import ValidationError from './ValidationError';
const vuexLocal = new VuexPersistence({
    key: 'vuex',
    storage: window.localStorage,
    reducer: (state) => {
        // const { loadingComments, ...commentState } = state.Comment;
        return {
            // comment: commentState,
            // Auth: state.Auth,
            // ...state.Actor,
        };
    }
})
const store = new Vuex.Store({
    modules: {
        Todo,
        ValidationError
    },
    plugins: [vuexLocal.plugin]
})
export default store;
