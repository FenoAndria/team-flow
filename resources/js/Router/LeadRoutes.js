import LeadTaskIndex from '../Views/Lead/Task/Index.vue'

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
        ],
    },
    
]