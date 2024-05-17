<template>
  <UserLayout>
    <div>Invitation Index</div>
    <div>
      <div v-if="loadingMemberInvitations">
        <span class="loading"></span>
      </div>
      <div v-else>
        <div v-if="memberInvitations.length">
          <div class="list-container">
            <div
              class="list-content flex justify-between"
              v-for="memberInvitation in memberInvitations"
            >
              <div>
                <p class="uppercase font-semibold">
                  {{ memberInvitation.team.name }}
                </p>
                <p class="text-xs">
                  Managed by
                  <span class="font-semibold">{{
                    memberInvitation.team.lead.name
                  }}</span>
                  |
                  {{ dayjs(memberInvitation.created_at).format("DD-MM-YYYY") }}
                </p>
              </div>
              <div>
                <div
                  v-if="
                    memberInvitation.status == 'Accepted' ||
                    memberInvitation.status == 'Declined'
                  "
                  class="font-semibold"
                >
                  <p
                    :class="
                      memberInvitation.status == 'Accepted'
                        ? 'text-success-600'
                        : 'text-danger-600'
                    "
                  >
                    {{ memberInvitation.status }}
                  </p>
                </div>
                <div v-else class="flex">
                  <button
                    class="btn bg-green-500"
                    @click="replyInvitation(memberInvitation.id, 'Accepted')"
                  >
                    Accept
                  </button>
                  <button
                    class="btn bg-red-600"
                    @click="replyInvitation(memberInvitation.id, 'Declined')"
                  >
                    Decline
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else>Empty</div>
      </div>
    </div>
  </UserLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import UserLayout from "../../../Components/Layouts/UserLayout.vue";
import {
  getMemberInvitations,
  updateMemberInvitations,
} from "../../../Services/Member/MemberInvitationService";
import dayjs from "dayjs";
export default {
  components: { UserLayout },
  setup(props) {
    const store = useStore();
    const memberInvitations = computed(() => store.getters.memberInvitations);
    const loadingMemberInvitations = computed(
      () => store.getters.loadingMemberInvitations
    );
    const replyInvitation = async (id, status) => {
      await updateMemberInvitations({ id, status });
      getMemberInvitations();
    };
    onMounted(async () => {
      await getMemberInvitations();
    });
    return {
      memberInvitations,
      loadingMemberInvitations,
      replyInvitation,
      dayjs,
    };
  },
};
</script>