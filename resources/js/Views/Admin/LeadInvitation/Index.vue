<template>
  <AdminLayout  pageTitle="Team Lead invitation">
    <div v-if="loadingLeadInvitation">
      <Loading />
    </div>
    <div v-else>
      <div class="my-card-container" v-if="leadInvitation.length">
        <div
          class="my-card list-content my-card-3"
          v-for="item in leadInvitation"
        >
          <div class="flex justify-between">
            <p class="text-primary text-lg font-semibold">
              {{ item.team.name }}
            </p>
            <StatusBadge :status="item.status" />
          </div>
          <p class="font-semibold">
            <span class="bi bi-person"></span> {{ item.user.profil.name }}
          </p>
          <p class="text-sm text-neutral">
            {{ $dayjs(item.created_at).format("DD-MM-YYYY") }}
          </p>
        </div>
      </div>
      <div v-else>Empty</div>
    </div>
  </AdminLayout>
</template>
<script>
import { mapGetters } from "vuex";
import AdminLayout from "../../../Components/Layouts/AdminLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import { getLeadInvitation } from "../../../Services/Admin/LeadInvitationService";
export default {
  components: { AdminLayout, Loading, StatusBadge },
  computed: { ...mapGetters(["loadingLeadInvitation", "leadInvitation"]) },
  mounted() {
    getLeadInvitation();
  },
};
</script>