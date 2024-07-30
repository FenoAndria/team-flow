<template>
  <AdminLayout pageTitle="Team list">
    <div v-if="loadingTeams">
      <Loading />
    </div>
    <div v-else>
      <NewButton forLabel="newTeamModal" tagLabel="New Team" />
      <Filter
        :filterTab="teamFilter"
        @filterItem="handleFilterTeam"
        :count="filteredTeam.length"
      />

      <NewTeamModal modalId="newTeamModal" />
      <div class="my-card-container mt-2" v-if="filteredTeam.length">
        <div
          class="my-card list-content my-card-3"
          v-for="item in filteredTeam"
        >
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
import NewButton from "../../../Components/Layouts/NewButton.vue";
import FilterTeam from "../../../Components/Filter/FilterTeam.vue";
import Filter from "../../../Components/Filter/Filter.vue";
import { teamFilter } from "../../../Services/Filter/AdminFilter";
export default {
  components: {
    AdminLayout,
    Loading,
    StatusBadge,
    NewTeamModal,
    NewButton,
    FilterTeam,
    Filter,
  },
  data() {
    return {
      filteredTeam: [],
      teamFilter,
    };
  },
  computed: {
    ...mapGetters(["teams", "loadingTeams"]),
  },
  methods: {
    handleFilterTeam(e) {
      switch (e.tag) {
        case "Have Lead":
          this.filteredTeam = this.teams.filter((item) => item.lead);
          break;
        case "No Lead":
          this.filteredTeam = this.teams.filter((item) => !item.lead);
          break;
        default:
          this.filteredTeam = this.teams;
          break;
      }
      
    },
  },
  mounted() {
    getTeams();
  },
};
</script>
