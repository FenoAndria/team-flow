<template>
  <div class="">
    <Loading v-if="loadingLeadDashboard" />
    <div class="" v-else>
      <div class="" v-if="leadDashboard">
        <div class="" v-if="leadDashboard.global_stat">
          <p class="text-xl text-primary font-semibold border-b">
            Global statistic
          </p>
          <div class="my-card-container mt-2">
            <div class="my-card list-content my-card-3 flex items-center">
              <div class="w-1/2 border-r border-primary text-primary">
                <p class="text-center text-6xl font-semibold">
                  {{ leadDashboard.global_stat.team_member_stat.all }}
                </p>
                <p class="text-center text-3xl font-semibold">Members</p>
              </div>
              <div class="w-1/2">
                <div class="pl-4">
                  <p class="text-xl font-semibold text-info">
                    {{
                      leadDashboard.global_stat.team_member_stat.subtask
                        .have_subtask
                    }}
                    Have subtask
                  </p>
                  <p class="text-xl font-semibold text-neutral">
                    {{
                      leadDashboard.global_stat.team_member_stat.subtask
                        .no_subtask
                    }}
                    No Subtask
                  </p>
                </div>
              </div>
            </div>
            <div class="my-card list-content my-card-3 flex items-center">
              <div class="w-1/3 border-r border-primary text-primary">
                <p class="text-center text-6xl font-semibold">
                  {{ leadDashboard.global_stat.task_stat.all }}
                </p>
                <p class="text-center text-3xl font-semibold">Tasks</p>
              </div>
              <div class="w-2/3">
                <div class="pl-4">
                  <p class="text-xl font-semibold text-info">
                    {{ leadDashboard.global_stat.task_stat.Todo }}
                    To Do
                  </p>
                  <p class="text-xl font-semibold text-secondary">
                    {{ leadDashboard.global_stat.task_stat["In Progress"] }}
                    In Progress
                  </p>
                  <p class="text-xl font-semibold text-success">
                    {{ leadDashboard.global_stat.task_stat.Completed }}
                    Completed
                  </p>
                  <p class="text-xl font-semibold text-error">
                    {{ leadDashboard.global_stat.task_stat.Cancelled }}
                    Cancelled
                  </p>
                </div>
              </div>
            </div>
            <div class="my-card list-content my-card-3 flex items-center">
              <div class="w-1/2 border-r border-primary text-primary">
                <p class="text-center text-6xl font-semibold">
                  {{ leadDashboard.global_stat.subtask_stat.all }}
                </p>
                <p class="text-center text-3xl font-semibold">Subtasks</p>
              </div>
              <div class="w-1/2">
                <div class="pl-4">
                  <p class="text-xl font-semibold text-info">
                    {{ leadDashboard.global_stat.subtask_stat.Todo }}
                    To Do
                  </p>
                  <p class="text-xl font-semibold text-secondary">
                    {{ leadDashboard.global_stat.subtask_stat["In Progress"] }}
                    In Progress
                  </p>
                  <p class="text-xl font-semibold text-success">
                    {{ leadDashboard.global_stat.subtask_stat.Completed }}
                    Completed
                  </p>
                  <p class="text-xl font-semibold text-error">
                    {{ leadDashboard.global_stat.subtask_stat.Cancelled }}
                    Cancelled
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="flex mb-2 space-x-2">
          <div class="w-1/2" v-if="leadDashboard.particular_stat">
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
                      leadDashboard.particular_stat.team_member_subtasks
                        .team_member
                    }}</span>
                    <span class="particular-stat-count">{{
                      leadDashboard.particular_stat.team_member_subtasks.count
                    }}</span>
                  </div>
                </div>
                <div class="particular-stat-container">
                  <div class="particular-stat-label">
                    Team member who appears most in teams
                  </div>
                  <div class="particular-stat">
                    <span>{{
                      leadDashboard.particular_stat.team_member_appearance
                        .team_member
                    }}</span>
                    <span class="particular-stat-count">{{
                      leadDashboard.particular_stat.team_member_appearance
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
                      leadDashboard.particular_stat
                        .team_member_completed_subtasks.team_member
                    }}</span>
                    <span class="particular-stat-count"
                      >{{
                        leadDashboard.particular_stat
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
                      leadDashboard.particular_stat.team_completed_tasks.team
                    }}</span>
                    <span class="particular-stat-count"
                      >{{
                        leadDashboard.particular_stat.team_completed_tasks
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
                      leadDashboard.particular_stat.team_have_tasks.team
                    }}</span>
                    <span class="particular-stat-count">{{
                      leadDashboard.particular_stat.team_have_tasks.count
                    }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-1/2" v-if="leadDashboard.latest_tasks">
            <p class="text-xl text-primary font-semibold border-b">
              Latest tasks
            </p>
            <div class="my-card-container mt-2">
              <div class="my-card list-content my-card-1 space-y-2">
                <div
                  class="particular-stat-container"
                  v-for="task in leadDashboard.latest_tasks"
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
                  v-for="notification in leadDashboard.latest_notifications"
                >
                  <div class="particular-stat-label">
                    <span> {{ notificationText(notification) }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import Loading from "../../../Components/Layouts/Loading.vue";
import { getLeadDashboard } from "../../../Services/Lead/LeadDashboard";
export default {
  components: { Loading },
  computed: {
    ...mapGetters(["loadingLeadDashboard", "leadDashboard"]),
  },
  mounted() {
    getLeadDashboard();
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