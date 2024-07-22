<template>
  <AdminLayout>
    <div v-if="loadingTeams">
      <Loading />
    </div>
    <div v-else>
      <label
        class="
          text-info
          hover:underline
          font-semibold
          bg-neutral-100
          px-4
          rounded
          border
          hover:bg-neutral-200
          cursor-pointer
        "
        for="newTeamModal"
      >
        New team
      </label>
      <NewTeamModal modalId="newTeamModal" />
      <div class="my-card-container mt-2" v-if="teams.length">
        <div class="my-card list-content my-card-3" v-for="item in teams">
          <div class="">
            <p class="uppercase font-semibold text-primary text-lg">
              {{ item.name }}
            </p>
            <p class="text-sm space-x-1 font-semibold">
              <span class="bi bi-person-workspace"></span>
              <span class="">{{ item.lead ? item.lead.name : "None" }}</span>
            </p>
            <p class="text-sm space-x-1 font-semibold">
              <span class="bi bi-calendar-event"></span>
              <span class="">{{
                $dayjs(item.created_at).format("DD-MM-YYYY")
              }}</span>
            </p>
            <router-link
              :to="{ name: 'AdminTeamShow', params: { team: item.id } }"
              class="text-info hover:underline"
              >More...</router-link
            >
          </div>
        </div>
      </div>
      <div v-else>Empty</div>
    </div>
  </AdminLayout>
</template>
<script>
import { mapGetters } from "vuex";
import AdminLayout from "../../../Components/Layouts/AdminLayout.vue";
import { getTeams } from "../../../Services/Admin/TeamService";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import NewTeamModal from "../../../Components/Layouts/Modal/NewTeamModal.vue";
export default {
  components: { AdminLayout, Loading, StatusBadge, NewTeamModal },
  data() {
    return {};
  },
  computed: {
    ...mapGetters(["teams", "loadingTeams"]),
  },
  mounted() {
    getTeams()
  },
};
</script>
