import LeadTaskIndex from '../Views/Lead/Task/Index.vue'
import LeadTaskShow from '../Views/Lead/Task/Show.vue'

export default [
    {
        path: 'task/',
        name: "LeadInvitation",
        children: [
            {
                path: '',
                name: "LeadTaskIndex",
                component: LeadTaskIndex,
                meta: {

                }
            },
            {
                path: ':task',
                name: "LeadTaskShow",
                component: LeadTaskShow,
                meta: {

                }
            },
        ],
    },
    
]