import Vuex from 'vuex'
import { VuexPersistence } from 'vuex-persist'
import Todo from './Todo';
import ValidationError from './ValidationError';
import Auth from './Auth';
import User from './User';

import Member from './Member/Index'
import Lead from './Lead/Index'

const vuexLocal = new VuexPersistence({
    key: 'vuex',
    storage: window.localStorage,
    reducer: (state) => {
        if (state.Auth.isAuthenticated) {
            return {
                Auth: state.Auth
            };
        }
        return {}
    }
})
const store = new Vuex.Store({
    modules: {
        Todo,
        ValidationError,
        Auth,
        User,
        ...Member,
        ...Lead,
    },
    plugins: [vuexLocal.plugin]
})
export default store;
