import { createRouter, createWebHistory } from "vue-router";
import UserData from "../services/UserData";
import NotFound from './../Views/NotFound.vue'
import AppIndex from "./../Views/Index.vue"
import UserIndex from "./../Views/User/Index.vue"
import UserEdit from "./../Views/User/Edit.vue"
import Login from "./../Views/Auth/Login.vue"
import Register from "./../Views/Auth/Register.vue"

import AdminIndexPage from '../Views/Admin/AdminIndex.vue'
import UserIndexPage from '../Views/Member/UserIndex.vue'
import LeadIndexPage from '../Views/Lead/LeadIndex.vue'

import RoleValidation from "../Middleware/RoleValidation";
import MemberRoutes from "./MemberRoutes";
import LeadRoutes from "./LeadRoutes";
import AdminRoutes from "./AdminRoutes";

const setIndexPage = (indexPage) => {
    switch (indexPage) {
        case 'Admin':
            return AdminIndexPage
            break;
        case 'Lead':
            return LeadIndexPage
            break;
        case 'User':
            return UserIndexPage
            break;
    }
}

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
            component: UserData.role ? setIndexPage(UserData.role) : AppIndex,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/admin/',
            name: 'Admin',
            children: [
                ...AdminRoutes
            ],
            beforeEnter: RoleValidation('Admin')
        },
        {
            path: '/member/',
            name: 'Member',
            children: [
                ...MemberRoutes
            ],
            beforeEnter: RoleValidation('User')
        },
        {
            path: '/lead/',
            name: 'Lead',
            children: [
                ...LeadRoutes
            ],
            meta: {
                requiresAuth: true
            },
            beforeEnter: RoleValidation('Lead')
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