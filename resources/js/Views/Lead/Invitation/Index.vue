<template>
  <LeadLayout>
    <div>
      <div v-if="loadingTeamInvitation">
        <Loading />
      </div>
      <div v-else class="pt-2">
        <label
          for="inviteModal"
          class="
            text-info
            hover:underline
            font-semibold
            bg-neutral-100
            px-4
            py-2
            rounded
            border
            hover:bg-neutral-200
            cursor-pointer
          "
        >
          <span class="bi bi-person-plus-fill"></span> Invite
        </label>
        <InviteModal modalId="inviteModal"/>
        <div v-if="teamInvitation && teamInvitation.length" class="mt-2">
          <div class="list-container">
            <div class="w-1/3 px-1 mb-2" v-for="item in teamInvitation">
              <div class="list-content">
                <div class="flex justify-between">
                  <div>
                    <div class="flex space-x-2">
                      <img
                        src="./../../../../../public/assets/Avatar.png"
                        class="avatar-navbar"
                      />
                      <p class="text-primary text-xl">
                        {{ item.user.profil.name }}
                      </p>
                    </div>
                    <p class="text-sm text-neutral font-semibold">
                      {{ dayjs(item.created_at).format("DD-MM-YYYY") }}
                    </p>
                  </div>
                  <div>
                    <StatusBadge :status="item.status">{{
                      item.status
                    }}</StatusBadge>
                  </div>
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
import Loading from "../../../Components/Layouts/Loading.vue";
import { useStore } from "vuex";
import dayjs from "dayjs";
import statusColor from "../../../Services/StatusColor";
import { getTeamInvitation } from "../../../Services/Lead/TeamInvitationService";
import InviteModal from "../../../Components/Layouts/InviteModal.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
export default {
  components: { LeadLayout, InviteModal, Loading, StatusBadge },
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