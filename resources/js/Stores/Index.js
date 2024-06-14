import Vuex from 'vuex'
import { VuexPersistence } from 'vuex-persist'
import Todo from './Todo';
import ValidationError from './ValidationError';
import ModalEvent from './ModalEvent';
import Auth from './Auth';
import User from './User';

import Member from './Member/Index'
import Lead from './Lead/Index'
import Admin from './Admin/Index'

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
        ModalEvent,
        Auth,
        User,
        ...Member,
        ...Lead,
        ...Admin,
    },
    plugins: [vuexLocal.plugin]
})
export default store;
