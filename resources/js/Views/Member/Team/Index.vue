<template>
  <UserLayout>
    <div>
      <div v-if="loadingTeams">
        <Loading />
      </div>
      <div v-else>
        <div class="flex flex-wrap -mx-1" v-if="teams.length">
          <div class="w-1/3 px-1" v-for="item in teams">
            <div class="list-content">
              <p class="uppercase font-semibold text-primary text-lg">
                {{ item.team.name }}
              </p>
              <p class="text-sm space-x-1 font-semibold">
                <span class="bi bi-person-workspace"></span>
                <span class="">{{ item.team.lead.name }}</span>
              </p>
              <p class="text-sm space-x-1 font-semibold">
                <span class="bi bi-calendar-event"></span>
                <span class="">{{
                  dayjs(item.created_at).format("DD-MM-YYYY")
                }}</span>
              </p>
              <router-link
                :to="{ name: 'TeamShow', params: { team: item.team.id } }"
                class="text-info hover:underline"
                >More...</router-link
              >
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
import Loading from "../../../Components/Layouts/Loading.vue";
import { getTeams } from "../../../Services/Member/MemberTeamService";
import dayjs from "dayjs";
export default {
  components: { UserLayout, Loading },
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