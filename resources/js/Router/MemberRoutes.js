import MemberInvitation from '../Views/Member/Invitation/Index.vue'
import TaskIndex from '../Views/Member/Task/Index.vue'
import TeamIndex from '../Views/Member/Team/Index.vue'
import TeamShow from '../Views/Member/Team/Show.vue'
import MemberMessageIndex from '../Views/Member/Message/Index.vue'
import MemberNotificationIndex from '../Views/Member/Notification/Index.vue'

export default [
    {
        path: 'invitation/',
        name: "Invitation",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "MemberInvitationIndex",
                component: MemberInvitation,
                meta: {

                }
            },
        ],
    },
    {
        path: 'task/',
        name: "Task",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "TaskIndex",
                component: TaskIndex,
                meta: {

                }
            },
        ],
    },
    {
        path: 'message/',
        name: "Message",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "MemberMessageIndex",
                component: MemberMessageIndex,
                meta: {

                }
            },
            
        ],
    },
    {
        path: 'team/',
        name: "Team",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "TeamIndex",
                component: TeamIndex,
                meta: {

                }
            },
            {
                path: ':team',
                name: "TeamShow",
                component: TeamShow,
                meta: {

                }
            },
        ],
    },
    {
        path: 'notification/',
        name: "MemberNotification",
        children: [
            {
                path: '',
                name: "MemberNotificationIndex",
                component: MemberNotificationIndex,
            },
        ]
    },
]