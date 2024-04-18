import { createRouter, createWebHistory } from "vue-router";

import NotFound from './../Views/NotFound.vue'
import AppIndex from "./../Views/Index.vue"
import TodoIndex from "./../Views/Todo/Index.vue"

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: NotFound,
            meta: {
                title: 'Page Not Found',
                // middleware: 'Guest'
            }
        },
        {
            path: '',
            name: "AppIndex",
            component: AppIndex,
            meta: {
                // middleware: 'Guest'
            }
        },
        {
            path: '/todo/',
            name: "Todo",
            meta: {
                // middleware: 'Guest'
            },
            children: [
                {
                    path: '',
                    name: "TodoIndex",
                    component: TodoIndex,
                    meta: {
                        // middleware: 'Guest'
                    }
                },
            ]
        },
    ]
})

export default router;