import { createRouter, createWebHistory } from "vue-router";
import UserToken from "../services/UserToken";
import NotFound from './../Views/NotFound.vue'
import AppIndex from "./../Views/Index.vue"
import TodoIndex from "./../Views/Todo/Index.vue"
import UserIndex from "./../Views/User/Index.vue"
import UserEdit from "./../Views/User/Edit.vue"
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
            path: '/user/',
            name: "User",
            meta: {
                requiresAuth: true
            },
            children: [
                {
                    path: '',
                    name: "UserIndex",
                    component: UserIndex,
                    meta: {

                    }
                },
                {
                    path: 'edit',
                    name: "UserEdit",
                    component: UserEdit,
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
    // const vuexLocalStorage = localStorage.getItem('vuex') ? JSON.parse(localStorage.getItem('vuex') || '{}') : '';

    if (!to.meta.requiresAuth) {
        if ((to.name == 'Login' || to.name == 'Register') && UserToken) {
            next({ name: 'AppIndex' })
        } else if (to.name == 'NotFound' && !UserToken) {
            next({ name: 'Login' })
        } else {
            next()
        }
    } else {
        if (!UserToken) {
            next({ name: 'Login' })
        } else {
            next()
        }
    }
})

export default router;