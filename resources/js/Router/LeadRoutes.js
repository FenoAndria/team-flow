import LeadTaskIndex from './../Views/Lead/Task/Index.vue'
import LeadTaskShow from './../Views/Lead/Task/Show.vue'
import LeadTeamMember from './../Views/Lead/TeamMember/Index.vue'
import LeadInvitationIndex from './../Views/Lead/Invitation/Index.vue'
import LeadMessageIndex from './../Views/Lead/Message/Index.vue'
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
    {
        path: 'message/',
        name: "LeadMessage",
        children: [
            {
                path: '',
                name: "LeadMessageIndex",
                component: LeadMessageIndex,
            },
        ]
    },
]
export default routes