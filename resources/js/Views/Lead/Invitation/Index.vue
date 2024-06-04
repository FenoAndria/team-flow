<template>
  <LeadLayout>
    <div>Lead - invitation index</div>
    <div>
        <label for="inviteModal"  class="btn bg-blue-300">
          Invite
        </label>
        <InviteModal modalId="inviteModal"/>
      <div v-if="loadingTeamInvitation">
        <span class="loading"></span>
      </div>
      <div v-else>
        <div v-if="teamInvitation && teamInvitation.length">
          <div class="list-container">
            <div class="list-content" v-for="item in teamInvitation">
              <div class="flex justify-between">
                <div>
                  <p>{{ item.user.profil.name }} | {{ item.user.email }}</p>
                  <p class="text-xs">
                    {{ dayjs(item.created_at).format("DD-MM-YYYY") }}
                  </p>
                </div>
                <div>
                  <p :class="statusColor(item.status)">{{ item.status }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else>Empty</div>
      </div>
    </div>
  </LeadLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { useStore } from "vuex";
import dayjs from "dayjs";
import statusColor from "../../../Services/StatusColor";
import { getTeamInvitation } from "../../../Services/Lead/TeamInvitationService";
import InviteModal from "../../../Components/Layouts/InviteModal.vue";
export default {
  components: { LeadLayout, InviteModal },
  setup(props) {
    const store = useStore();
    const teamInvitation = computed(() => store.getters.teamInvitation);
    const loadingTeamInvitation = computed(
      () => store.getters.loadingTeamInvitation
    );

    onMounted(async () => {
      await getTeamInvitation();
    });
    return {
      dayjs,
      teamInvitation,
      loadingTeamInvitation,
      statusColor,
    };
  },
};
</script>