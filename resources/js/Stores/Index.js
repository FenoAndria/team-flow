import Vuex from 'vuex'
import { VuexPersistence } from 'vuex-persist'

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
        
    },
    plugins: [vuexLocal.plugin]
})
export default store;
