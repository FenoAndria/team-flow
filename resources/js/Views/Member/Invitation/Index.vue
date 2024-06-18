<template>
  <UserLayout>
    <div>
      <div v-if="loadingMemberInvitations">
        <Loading />
      </div>
      <div v-else>
        <div class="">
          <p class="text-lg text-primary font-semibold">
            Team member invitation(s)
          </p>
          <div
            class="my-card-container"
            v-if="
              memberInvitations.teamMember &&
              memberInvitations.teamMember.length
            "
          >
            <div
              class="my-card list-content my-card-4"
              v-for="memberInvitation in memberInvitations.teamMember"
            >
              <div class="">
                <div>
                  <p class="uppercase font-semibold text-primary text-lg">
                    {{ memberInvitation.team.name }}
                  </p>
                  <p class="text-sm space-x-1 font-semibold">
                    <span class="bi bi-person-workspace"></span>
                    <span class="">{{ memberInvitation.team.lead.name }}</span>
                  </p>
                  <p class="text-xs font-semibold text-neutral italic">
                    On
                    {{
                      dayjs(memberInvitation.created_at).format("DD-MM-YYYY")
                    }}
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
                          ? 'text-success'
                          : 'text-danger'
                      "
                    >
                      {{ memberInvitation.status }}
                    </p>
                  </div>
                  <div v-else class="flex justify-between">
                    <div></div>
                    <div class="space-x-2">
                      <button
                        class="bg-green-500"
                        @click="
                          replyInvitation(memberInvitation.id, 'Accepted')
                        "
                      >
                        Accept
                      </button>
                      <button
                        class="bg-red-600"
                        @click="
                          replyInvitation(memberInvitation.id, 'Declined')
                        "
                      >
                        Decline
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else>Empty</div>
        </div>
        <div class="">
          <p class="text-lg text-primary font-semibold">Lead invitation(s)</p>
          <div
            class="my-card-container"
            v-if="memberInvitations.lead && memberInvitations.lead.length"
          >
            <div
              class="my-card list-content my-card-4"
              v-for="memberInvitation in memberInvitations.lead"
            >
              <div class="">
                <p class="uppercase font-semibold text-primary text-lg">
                  {{ memberInvitation.team.name }}
                </p>
                <p class="text-xs font-semibold text-neutral italic">
                  On
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
                        ? 'text-success'
                        : 'text-danger'
                    "
                  >
                    {{ memberInvitation.status }}
                  </p>
                </div>
                <div v-else class="flex justify-between">
                  <div></div>
                  <div class="space-x-2">
                    <button
                      class="bg-green-500"
                      @click="
                        replyLeadInvitation(memberInvitation.id, 'Accepted')
                      "
                    >
                      Accept
                    </button>
                    <button
                      class="bg-red-600"
                      @click="
                        replyLeadInvitation(memberInvitation.id, 'Declined')
                      "
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
    </div>
  </UserLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import UserLayout from "../../../Components/Layouts/UserLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import {
  getMemberInvitations,
  updateLeadInvitation,
  updateMemberInvitation,
} from "../../../Services/Member/MemberInvitationService";
import dayjs from "dayjs";
export default {
  components: { UserLayout, Loading },
  setup(props) {
    const store = useStore();
    const memberInvitations = computed(() => store.getters.memberInvitations);
    const loadingMemberInvitations = computed(
      () => store.getters.loadingMemberInvitations
    );
    const replyInvitation = async (id, status) => {
      await updateMemberInvitation({ id, status });
      getMemberInvitations();
    };
    const replyLeadInvitation = async (id, status) => {
      await updateLeadInvitation({ id, status });
    };
    onMounted(async () => {
      await getMemberInvitations();
    });
    return {
      memberInvitations,
      loadingMemberInvitations,
      replyInvitation,
      replyLeadInvitation,
      dayjs,
    };
  },
};
</script>