import AdminTaskIndex from '../Views/Admin/Task/Index.vue'
import AdminTeamIndex from '../Views/Admin/Team/Index.vue'
import AdminTeamShow from '../Views/Admin/Team/Show.vue'
export default [
    {
        path: 'tasks/',
        name: "AdminTask",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "AdminTaskIndex",
                component: AdminTaskIndex,
                meta: {

                }
            },
        ],
    },
    {
        path: 'teams/',
        name: "AdminTeam",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "AdminTeamIndex",
                component: AdminTeamIndex,
                meta: {

                }
            },
            {
                path: ':team',
                name: "AdminTeamShow",
                component: AdminTeamShow,
                meta: {

                }
            },
        ],
    },
   
]