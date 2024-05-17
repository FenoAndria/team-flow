import { createRouter, createWebHistory } from "vue-router";
import UserData from "../services/UserData";
import NotFound from './../Views/NotFound.vue'
import AppIndex from "./../Views/Index.vue"
import TodoIndex from "./../Views/Todo/Index.vue"
import UserIndex from "./../Views/User/Index.vue"
import UserEdit from "./../Views/User/Edit.vue"
import Login from "./../Views/Auth/Login.vue"
import Register from "./../Views/Auth/Register.vue"

import AdminIndex from '../Components/Layouts/AdminIndex.vue'
import UserIndexPage from '../Components/Layouts/UserIndex.vue'
import RoleValidation from "../Middleware/RoleValidation";
import MemberRoutes from "./MemberRoutes";
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
            component: UserData ? (UserData.role == 'User' ? UserIndexPage : AdminIndex) : AppIndex,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/member',
            name: 'Member',
            children: [
                ...MemberRoutes
            ]
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
            ],
            beforeEnter: RoleValidation('User')
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
        if ((to.name == 'Login' || to.name == 'Register') && UserData.token) {
            next({ name: 'AppIndex' })
        } else if (to.name == 'NotFound' && !UserData.token) {
            next({ name: 'Login' })
        } else {
            next()
        }
    } else {
        if (!UserData.token) {
            next({ name: 'Login' })
        } else {
            next()
        }
    }
})

export default router;