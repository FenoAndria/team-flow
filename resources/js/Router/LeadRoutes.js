import LeadTaskIndex from './../Views/Lead/Task/Index.vue'
import LeadTaskShow from './../Views/Lead/Task/Show.vue'
import LeadCreateSubtask from './../Views/Lead/Task/CreateSubtask.vue'
import LeadTeamMember from './../Views/Lead/TeamMember/Index.vue'
import LeadInvitationIndex from './../Views/Lead/Invitation/Index.vue'
const routes = [
    {
        path: 'task/',
        name: "LeadTask",
        children: [
            {
                path: '',
                component: LeadTaskIndex,
                name: "LeadTaskIndex",
            },
            {
                path: ':task',
                name: "LeadTaskShow",
                component: LeadTaskShow,
            },
            {
                path: ':task/create-subtask',
                name: "LeadCreateSubtask",
                component: LeadCreateSubtask,
            },
        ],
    },
    {
        path: 'team/',
        name: "LeadTeam",
        children: [
            {
                path: 'member',
                name: "LeadTeamMember",
                component: LeadTeamMember,
            },
        ]
    },
    {
        path: 'invitation/',
        name: "LeadInvitation",
        children: [
            {
                path: '',
                name: "LeadInvitationIndex",
                component: LeadInvitationIndex,
            },
        ]
    },
]
export default routes