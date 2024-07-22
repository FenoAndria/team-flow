import AdminTaskIndex from '../Views/Admin/Task/Index.vue'
import AdminTaskShow from '../Views/Admin/Task/Show.vue'
import AdminTeamIndex from '../Views/Admin/Team/Index.vue'
import AdminTeamShow from '../Views/Admin/Team/Show.vue'
import MemberIndex from '../Views/Admin/Member/Index.vue'

import AdminLeadInvitationIndex from '../Views/Admin/LeadInvitation/Index.vue'
import AdminNotificationIndex from '../Views/Admin/Notification/Index.vue'

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
            },
            {
                path: ':task',
                name: "AdminTaskShow",
                component: AdminTaskShow,
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
            },
            {
                path: ':team',
                name: "AdminTeamShow",
                component: AdminTeamShow,
            },
        ],
    },
    {
        path: 'invitations/',
        name: "AdminLeadInvitation",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "AdminLeadInvitationIndex",
                component: AdminLeadInvitationIndex,
            },
        ],
    },
    {
        path: 'members/',
        name: "AdminMember",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "MemberIndex",
                component: MemberIndex,
            },
        ],
    },
    {
        path: 'notifications/',
        name: "AdminNotification",
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '',
                name: "AdminNotificationIndex",
                component: AdminNotificationIndex,
            },
        ],
    },
]