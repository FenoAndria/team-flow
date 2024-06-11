<template>
  <UserLayout>
    <Breadcumb :previousPage="[{ name: 'TeamIndex', tag: 'Team' }]" currentPage="Show"/>
    <div>
      <div v-if="loadingShowTeam">
        <Loading />
      </div>
      <div v-else>
        <div v-if="team">
          <LeaveTeamModal modalId="leaveTeamModal" :content="team" />
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
            <div>
              <label class="button bg-danger" for="leaveTeamModal">
                <span class="bi bi-person-x-fill"></span> Leave
              </label>
            </div>
          </div>
          <div class="flex space-x-2">
            <div class="w-1/2">
              <p class="text-xl text-info font-semibold my-2">
                <span class="bi bi-clipboard"></span> Tasks
              </p>
              <div class="">
                <div class="list-content mb-2" v-for="task in team.task">
                  <div class="flex justify-between items-center border-b">
                    <p class="text-primary text-lg">{{ task.title }}</p>
                    <StatusBadge :status="task.status" />
                  </div>
                  <div class="pl-2">
                    <div
                      class="
                        flex
                        justify-between
                        border
                        py-1
                        px-2
                        rounded
                        hover:rounded-lg
                        hover:bg-white
                        hover:shadow-sm
                        my-1
                        transition-all
                        delay-75
                      "
                      v-for="subtask in task.subtasks"
                    >
                      <p class="text-neutral-600">{{ subtask.title }}</p>
                      <div
                        class="
                          flex
                          items-center
                          space-x-2
                          text-neutral
                          font-semibold
                        "
                        v-if="subtask.assigned_to"
                      >
                        <span
                          v-if="subtask.assigned_to.email == UserData.email"
                          class="text-success"
                        >
                          You
                        </span>
                        <span v-else>{{
                          subtask.assigned_to.profil.name
                        }}</span>
                      </div>
                      <p class="text-danger font-semibold" v-else>None</p>
                    </div>
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
                    class="h-8 rounded-full border border-neutral border-2"
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
  </UserLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import UserLayout from "../../../Components/Layouts/UserLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import Breadcumb from "../../../Components/Layouts/Breadcumb.vue";
import LeaveTeamModal from "../../../Components/Layouts/Modal/LeaveTeamModal.vue";
import UserData from "../../../Services/UserData";
import { showTeam } from "../../../Services/Member/MemberTeamService";
import dayjs from "dayjs";
import { useRoute } from "vue-router";
export default {
  components: { UserLayout, Loading, StatusBadge, LeaveTeamModal, Breadcumb },
  setup(props) {
    const store = useStore();
    const route = useRoute();
    const team = computed(() => store.getters.showTeam);
    const loadingShowTeam = computed(() => store.getters.loadingShowTeam);

    onMounted(async () => {
      await showTeam(route.params.team);
    });
    return {
      team,
      loadingShowTeam,
      dayjs,
      UserData,
    };
  },
};
</script>