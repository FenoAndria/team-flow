<template>
  <AdminLayout>
    <Breadcumb
      :previousPage="[{ name: 'AdminTeamIndex', tag: 'Team' }]"
      currentPage="Show"
    />
    <div>
      <div v-if="loadingTeam">
        <Loading />
      </div>
      <div v-else>
        <div v-if="team">
          <div
            class="
              flex
              justify-between
              items-center
              border-b-2 border-info
              pb-1
            "
          >
            <div>
              <p class="text-2xl text-primary uppercase font-semibold">
                {{ team.name }}
              </p>
              <p class="text-neutral-500">
                <span class="bi bi-person-workspace"></span>
                {{ team.lead.name }}
              </p>
            </div>
          </div>
          <div class="flex space-x-2">
            <div class="w-1/2">
              <p class="text-xl text-info font-semibold my-2">
                <span class="bi bi-clipboard"></span> Tasks
              </p>
              <div class="">
                <div class="list-content mb-2" v-for="task in team.task">
                  <div class="flex justify-between items-center">
                    <p class="text-primary text-lg">{{ task.title }}</p>
                    <StatusBadge :status="task.status" />
                  </div>
                </div>
              </div>
            </div>
            <div class="w-1/2">
              <p class="text-xl text-info font-semibold my-2">
                <span class="bi bi-person-square"></span> Members
              </p>
              <div class="space-y-2">
                <div
                  class="
                    list-content
                    flex
                    items-center
                    space-x-2
                    text-neutral-600
                    font-semibold
                  "
                  v-for="member in team.member"
                >
                  <img
                    src="./../../../../../public/assets/Avatar.png"
                    class="h-8 rounded-full border border-neutral"
                  />
                  <p class="text-lg">{{ member.profil.name }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else>Empty</div>
      </div>
    </div>
  </AdminLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import AdminLayout from "../../../Components/Layouts/AdminLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import Breadcumb from "../../../Components/Layouts/Breadcumb.vue";
import UserData from "../../../Services/UserData";
import { getTeam } from "../../../Services/Admin/TeamService";
import dayjs from "dayjs";
import { useRoute } from "vue-router";
export default {
  components: { AdminLayout, Loading, StatusBadge, Breadcumb },
  setup(props) {
    const store = useStore();
    const route = useRoute();
    const team = computed(() => store.getters.team);
    const loadingTeam = computed(() => store.getters.loadingTeam);

    onMounted(async () => {
      await getTeam(route.params.team);
    });
    return {
      team,
      loadingTeam,
      dayjs,
      UserData,
    };
  },
};
</script>