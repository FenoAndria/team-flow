import { createRouter, createWebHistory } from "vue-router";

import NotFound from './../Views/NotFound.vue'
import AppIndex from "./../Views/Index.vue"
import TodoIndex from "./../Views/Todo/Index.vue"
import Login from "./../Views/Auth/Login.vue"
import Register from "./../Views/Auth/Register.vue"

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: NotFound,
            meta: {
                title: 'Page Not Found',
                requiresAuth: false
            }
        },
        {
            path: '',
            name: "AppIndex",
            component: AppIndex,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/todo/',
            name: "Todo",
            meta: {
                requiresAuth: true
            },
            children: [
                {
                    path: '',
                    name: "TodoIndex",
                    component: TodoIndex,
                    meta: {

                    }
                },
            ]
        },
        {
            path: '/login',
            name: "Login",
            component: Login,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/register',
            name: "Register",
            component: Register,
            meta: {
                requiresAuth: false
            }
        },
    ]
})

router.beforeEach((to, from, next) => {
    const vuexLocalStorage = localStorage.getItem('vuex') ? JSON.parse(localStorage.getItem('vuex') || '{}') : '';

    if (!to.meta.requiresAuth) {
        if ((to.name == 'Login' || to.name == 'Register') && vuexLocalStorage) {
            next({ name: 'AppIndex' })
        } else if (to.name == 'NotFound' && !vuexLocalStorage) {
            next({ name: 'Login' })
        } else {
            next()
        }
    } else {
        if (!vuexLocalStorage) {
            next({ name: 'Login' })
        } else {
            if (!vuexLocalStorage.Auth) {
                localStorage.setItem('vuex', '')
                next({ name: 'Login' })
            } else {
                next()
            }
        }
    }
})

export default router;