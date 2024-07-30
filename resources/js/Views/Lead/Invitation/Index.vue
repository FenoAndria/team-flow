<template>
  <LeadLayout pageTitle="Team member invitation">
    <div>
      <div v-if="loadingTeamInvitation">
        <Loading />
      </div>
      <div v-else class="pt-2">
        <NewButton forLabel="inviteModal" tagLabel="Invite" />
        <InviteModal modalId="inviteModal" />
        <Filter
          :filterTab="teamMemberInvitationFilter"
          @filterItem="handleFilterInvitation"
          :count="teamInvitationFiltered.length"
        />
        <div v-if="teamInvitationFiltered && teamInvitationFiltered.length" class="mt-2">
          <div class="my-card-container">
            <div
              class="my-card list-content my-card-3"
              v-for="item in teamInvitationFiltered"
            >
              <div class="flex justify-between">
                <div>
                  <div class="flex items-center space-x-2">
                    <img
                      src="./../../../../../public/assets/Avatar.png"
                      class="avatar-navbar"
                    />
                    <div class="">
                      <p class="text-primary text-xl">
                        {{ item.user.profil.name }}<br />
                      </p>
                      <p class="text-xs text-neutral">
                        {{ item.user.email }}
                      </p>
                    </div>
                  </div>
                  <p class="text-sm text-neutral font-semibold">
                    {{ $dayjs(item.created_at).format("DD-MM-YYYY") }}
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
        <div v-else>Empty</div>
      </div>
    </div>
  </LeadLayout>
</template>
<script>
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import { mapGetters } from "vuex";
import { getTeamInvitation } from "../../../Services/Lead/TeamInvitationService";
import InviteModal from "../../../Components/Layouts/InviteModal.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import NewButton from "../../../Components/Layouts/NewButton.vue";
import Filter from "../../../Components/Filter/Filter.vue";
import { teamMemberInvitationFilter } from "../../../Services/Filter/LeadFilter";
export default {
  components: { LeadLayout, InviteModal, Loading, StatusBadge, NewButton,Filter },
  data() {
    return {
      teamInvitationFiltered: [],
      teamMemberInvitationFilter,
    };
  },
  computed: {
    ...mapGetters(["teamInvitation", "loadingTeamInvitation"]),
  },
  methods: {
    handleFilterInvitation(e) {
      if (e.name === "All") {
        this.teamInvitationFiltered = this.teamInvitation;
      } else {
        this.teamInvitationFiltered = this.teamInvitation.filter((item) => item.status == e.name);
      }
    },
  },
  mounted() {
    getTeamInvitation();
  },
};
</script>