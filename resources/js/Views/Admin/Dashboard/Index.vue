<template>
  <div class="">
    <Loading v-if="loadingAdminDashboard" />
    <div class="" v-else>
      <div class="" v-if="adminDashboard">
        <div class="" v-if="adminDashboard.global_stat">
          <p class="text-xl text-primary font-semibold border-b">
            Global statistic
          </p>
          <div class="my-card-container mt-2">
            <div class="my-card list-content my-card-3 flex items-center">
              <div class="w-1/3 border-r border-primary text-primary">
                <p class="text-center text-6xl font-semibold">
                  {{ adminDashboard.global_stat.user_stat.all }}
                </p>
                <p class="text-center text-3xl font-semibold">Users</p>
              </div>
              <div class="w-2/3">
                <div class="pl-4">
                  <p class="text-xl font-semibold text-info">
                    {{ adminDashboard.global_stat.user_stat.team_lead }} Team
                    Lead
                  </p>
                  <p class="text-xl font-semibold text-success">
                    {{ adminDashboard.global_stat.user_stat.team_member }}
                    Team Member
                  </p>
                  <p class="text-xl font-semibold text-neutral">
                    {{ adminDashboard.global_stat.user_stat.others }} Others
                  </p>
                </div>
              </div>
            </div>
            <div class="my-card list-content my-card-3 flex items-center">
              <div class="w-1/3 border-r border-primary text-primary">
                <p class="text-center text-6xl font-semibold">
                  {{ adminDashboard.global_stat.team_stat.all }}
                </p>
                <p class="text-center text-3xl font-semibold">Teams</p>
              </div>
              <div class="w-2/3">
                <div class="pl-4">
                  <p class="text-xl font-semibold text-info">
                    {{ adminDashboard.global_stat.team_stat.have_leader }}
                    Have Leader
                  </p>
                  <p class="text-xl font-semibold text-neutral">
                    {{ adminDashboard.global_stat.team_stat.no_leader }}
                    No Leader
                  </p>
                </div>
              </div>
            </div>
            <div class="my-card list-content my-card-3 flex items-center">
              <div class="w-1/3 border-r border-primary text-primary">
                <p class="text-center text-6xl font-semibold">
                  {{ adminDashboard.global_stat.task_stat.all }}
                </p>
                <p class="text-center text-3xl font-semibold">Tasks</p>
              </div>
              <div class="w-2/3">
                <div class="pl-4">
                  <p class="text-xl font-semibold text-info">
                    {{ adminDashboard.global_stat.task_stat.Todo }}
                    To Do
                  </p>
                  <p class="text-xl font-semibold text-secondary">
                    {{ adminDashboard.global_stat.task_stat["In Progress"] }}
                    In Progress
                  </p>
                  <p class="text-xl font-semibold text-success">
                    {{ adminDashboard.global_stat.task_stat.Completed }}
                    Completed
                  </p>
                  <p class="text-xl font-semibold text-error">
                    {{ adminDashboard.global_stat.task_stat.Cancelled }}
                    Cancelled
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex mb-2 space-x-2">
          <div class="w-1/2" v-if="adminDashboard.particular_stat">
            <p class="text-xl text-primary font-semibold border-b">
              Particular statistic
            </p>
            <div class="my-card-container mt-2">
              <div class="my-card list-content my-card-1 space-y-2">
                <div class="particular-stat-container">
                  <div class="particular-stat-label">
                    Team member with the most subtasks
                  </div>
                  <div class="particular-stat">
                    <span>{{
                      adminDashboard.particular_stat.team_member_subtasks
                        .team_member
                    }}</span>
                    <span class="particular-stat-count">{{
                      adminDashboard.particular_stat.team_member_subtasks.count
                    }}</span>
                  </div>
                </div>
                <div class="particular-stat-container">
                  <div class="particular-stat-label">
                    Team member who appears most in teams
                  </div>
                  <div class="particular-stat">
                    <span>{{
                      adminDashboard.particular_stat.team_member_appearance
                        .team_member
                    }}</span>
                    <span class="particular-stat-count">{{
                      adminDashboard.particular_stat.team_member_appearance
                        .count
                    }}</span>
                  </div>
                </div>
                <div class="particular-stat-container">
                  <div class="particular-stat-label">
                    Team member that has completed the most subtasks
                  </div>
                  <div class="particular-stat">
                    <span>{{
                      adminDashboard.particular_stat
                        .team_member_completed_subtasks.team_member
                    }}</span>
                    <span class="particular-stat-count"
                      >{{
                        adminDashboard.particular_stat
                          .team_member_completed_subtasks.percentage
                      }}
                      %</span
                    >
                  </div>
                </div>
                <div class="particular-stat-container">
                  <div class="particular-stat-label">
                    Team that has completed the most tasks
                  </div>
                  <div class="particular-stat">
                    <span>{{
                      adminDashboard.particular_stat.team_completed_tasks.team
                    }}</span>
                    <span class="particular-stat-count"
                      >{{
                        adminDashboard.particular_stat.team_completed_tasks
                          .percentage
                      }}
                      %</span
                    >
                  </div>
                </div>
                <div class="particular-stat-container">
                  <div class="particular-stat-label">
                    Team with the most tasks
                  </div>
                  <div class="particular-stat">
                    <span>{{
                      adminDashboard.particular_stat.team_have_tasks.team
                    }}</span>
                    <span class="particular-stat-count">{{
                      adminDashboard.particular_stat.team_have_tasks.count
                    }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-1/2" v-if="adminDashboard.latest_tasks">
            <p class="text-xl text-primary font-semibold border-b">
              Latest tasks
            </p>
            <div class="my-card-container mt-2">
              <div class="my-card list-content my-card-1 space-y-2">
                <div
                  class="particular-stat-container"
                  v-for="task in adminDashboard.latest_tasks"
                >
                  <div class="particular-stat-label">
                    <span> {{ task.title }}</span>
                  </div>
                  <div class="particular-stat">
                    <span class="particular-stat-count">
                      {{ task.team.name }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <p class="text-xl text-primary font-semibold border-b">
              Latest notifications
            </p>
            <div class="my-card-container mt-2">
              <div class="my-card list-content my-card-1 space-y-2">
                <div
                  class="particular-stat-container"
                  v-for="notification in adminDashboard.latest_notifications"
                >
                  <div class="particular-stat-label">
                    <span> {{ notificationText(notification) }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import Loading from "../../../Components/Layouts/Loading.vue";
import { getAdminDashboard } from "../../../Services/Admin/AdminDashboard";
export default {
  components: { Loading },
  computed: {
    ...mapGetters(["loadingAdminDashboard", "adminDashboard"]),
  },
  mounted() {
    getAdminDashboard();
  },
  methods: {
    notificationText(notif) {
      switch (notif.type) {
        case "lead_invitation_accepted":
          return `'${notif.user.profil.name}' accepted to lead the '${notif.team.name}' Team`;
        case "task_beginning":
          const { task } = JSON.parse(notif.data);
          return `'${task}' began in the '${notif.team.name}' Team`;
        case "task_completed":
          return `The task '${JSON.parse(notif.data).task}' in the ${
            notif.team.name
          } Team is completed`;
        default:
          break;
      }
    },
  },
};
</script>
<style lang="postcss">
.particular-stat-container {
  @apply w-full flex justify-between items-center rounded bg-neutral-200 py-2 px-2 shadow;
}
.particular-stat-label {
  /* @apply  text-neutral-600  */
}
.particular-stat {
  @apply space-x-1 uppercase font-semibold text-right text-neutral-600 flex flex-wrap justify-end;
}
.particular-stat-count {
  @apply rounded-lg px-2 bg-primary text-white;
}
</style>