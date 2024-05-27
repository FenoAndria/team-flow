<template>
  <UserLayout>
    <div>
      <div v-if="loadingShowTeam">
        <span class="loading"></span>
      </div>
      <div v-else>
        <div v-if="team">
          <div class="flex justify-between">
            <div>
              <p>Name : {{ team.name }}</p>
              <p>Lead : {{ team.lead.name + " | " + team.lead.email }}</p>
            </div>
            <div>
              <button class="btn btn-error" @click="leave(team.id)">
                Leave
              </button>
            </div>
          </div>
          <div class="flex">
            <div class="w-1/2">
              <p>Tasks</p>
              <div class="list-container">
                <div class="list-content" v-for="task in team.task">
                  <div class="flex justify-between">
                    <p>{{ task.title }}</p>
                    <p :class="statusColor(task.status)">{{ task.status }}</p>
                  </div>
                  <hr />
                  <div>
                    <div
                      class="flex justify-between"
                      v-for="subtask in task.subtasks"
                    >
                      <p>{{ subtask.title }}</p>
                      <p>
                        {{
                          subtask.assigned_to
                            ? subtask.assigned_to.profil.name
                            : "none"
                        }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-1/2">
              <p>Members</p>
              <div class="list-container">
                <div
                  class="list-content flex justify-between"
                  v-for="member in team.member"
                >
                  <p>{{ member.profil.name }}</p>
                </div>
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
import {
  leaveTeam,
  showTeam,
} from "../../../Services/Member/MemberTeamService";
import dayjs from "dayjs";
import { useRoute } from "vue-router";
import router from '../../../Router/Index';
import statusColor from "../../../Services/statusColor";
export default {
  components: { UserLayout },
  setup(props) {
    const store = useStore();
    const route = useRoute();
    const team = computed(() => store.getters.showTeam);
    const loadingShowTeam = computed(() => store.getters.loadingShowTeam);
   
    const leave = async (teamId) => {
      await leaveTeam(teamId);
      router.push({ name: "TeamIndex" });
    };
    onMounted(async () => {
      await showTeam(route.params.team);
    });
    return {
      team,
      loadingShowTeam,
      dayjs,
      statusColor,
      leave,
    };
  },
};
</script>