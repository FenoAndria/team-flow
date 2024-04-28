import Vuex from 'vuex'
import { VuexPersistence } from 'vuex-persist'
import Todo from './Todo';
import ValidationError from './ValidationError';
import Auth from './Auth';

const vuexLocal = new VuexPersistence({
    key: 'vuex',
    storage: window.localStorage,
    reducer: (state) => {
        return {
            Auth: state.Auth,
        };
    }
})
const store = new Vuex.Store({
    modules: {
        Todo,
        ValidationError,
        Auth
    },
    plugins: [vuexLocal.plugin]
})
export default store;
