import MemberInvitation from '../Views/Member/Invitation/Index.vue'
import TeamIndex from '../Views/Member/Team/Index.vue'
export default [
    {
        path: '/invitation/',
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
        // beforeEnter: RoleValidation('User')
    },
    {
        path: '/team/',
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
        ],
        // beforeEnter: RoleValidation('User')
    },
]