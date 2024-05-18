<template>
  <UserLayout>
    <div>Team Index</div>
    <div>
      <div v-if="loadingTeams">
        <span class="loading"></span>
      </div>
      <div v-else>
        <div v-if="teams.length">
          <div class="list-container">
            <div
              class="list-content flex justify-between"
              v-for="item in teams"
            >
              <div>
                <p class="uppercase font-semibold">
                  {{ item.team.name }}
                </p>
                <p class="text-xs">
                  Managed by
                  <span class="font-semibold">{{ item.team.lead.name }}</span>
                </p>
                <p class="text-xs">
                  Member since {{ dayjs(item.created_at).format("DD-MM-YYYY") }}
                </p>
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
import { getTeams } from "../../../Services/Member/MemberTeamService";
import dayjs from "dayjs";
export default {
  components: { UserLayout },
  setup(props) {
    const store = useStore();
    const teams = computed(() => store.getters.teams);
    const loadingTeams = computed(() => store.getters.loadingTeams);

    onMounted(async () => {
      await getTeams();
    });
    return {
      teams,
      loadingTeams,
      dayjs,
    };
  },
};
</script>