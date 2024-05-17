import MemberInvitation from '../Views/Member/Invitation/Index.vue'

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
]