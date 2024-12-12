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
        <div class="flex mb-2 space-x-2">
          <div class="w-1/2">
            <div v-if="leadDashboard.particular_stat">
              <p class="text-xl text-primary font-semibold border-b">
                Particular statistic
              </p>
              <div class="my-card-container mt-2">
                <div class="my-card list-content my-card-1 space-y-2">
                  <div
                    class="particular-stat-container"
                    v-if="leadDashboard.particular_stat.team_member_subtasks"
                  >
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
                  <div
                    class="particular-stat-container"
                    v-if="
                      leadDashboard.particular_stat
                        .team_member_completed_subtasks
                    "
                  >
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
                            .team_member_completed_subtasks.count.percentage
                        }}
                        %</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="leadDashboard.recent_completed_tasks">
              <p class="text-xl text-primary font-semibold border-b">
                Recent completed tasks
              </p>
              <div class="my-card-container mt-2">
                <div class="my-card list-content my-card-1 space-y-2">
                  <div
                    class="particular-stat-container"
                    v-for="task in leadDashboard.recent_completed_tasks"
                  >
                    <div
                      class="particular-stat-label flex justify-between items-center w-full"
                    >
                      <span>{{ task.title }}</span>
                      <span class="text-neutral text-sm">{{
                        $dayjs(task.updated_at).format("DD-MM-YYYY HH:mm")
                      }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-1/2">
            <div v-if="leadDashboard.latest_notifications">
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
            <div v-if="leadDashboard.new_member">
              <p class="text-xl text-primary font-semibold border-b">
                New members
              </p>
              <div class="my-card-container mt-2">
                <div class="my-card list-content my-card-1 space-y-2">
                  <div
                    class="particular-stat-container"
                    v-for="invitation in leadDashboard.new_member"
                  >
                    <div
                      class="particular-stat-label flex justify-between items-center w-full"
                    >
                      <span>{{ invitation.user.profil.name }}</span>
                      <!-- <span class="text-neutral text-sm">{{
                        $dayjs(member.updated_at).format("DD-MM-YYYY HH:mm")
                      }}</span> -->
                    </div>
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
        case "task_assigned":
          return (
            "A new task " +
            (notif.data ?? "") +
            " has been assigned to your team"
          );
        case "invitation_accepted":
          return `${notif.user.profil.name} has accepted an invitation to join you team.`;
        case "subtask_updated":
          const { subtask, status } = JSON.parse(notif.data);
          return `${notif.user.profil.name} ${
            status == "In Progress" ? "begin" : status
          } subtask '${subtask}' .`;
        case "task_completed":
          return `The task '${JSON.parse(notif.data).task}' is completed`;
        default:
          break;
      }
    },
  },
};
</script>