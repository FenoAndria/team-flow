<template>
  <div class="">
    <Loading v-if="loadingMemberDashboard" />
    <div class="" v-else>
      <div class="" v-if="memberDashboard">
        <div class="my-card-container mt-2">
          <div
            class="my-card list-content my-card-3 flex items-center"
            v-if="memberDashboard.subtask_stat"
          >
            <div class="w-1/2 border-r border-primary text-primary">
              <p class="text-center text-6xl font-semibold">
                {{ memberDashboard.subtask_stat.all }}
              </p>
              <p class="text-center text-3xl font-semibold">Subtasks</p>
            </div>
            <div class="w-1/2">
              <div class="pl-4">
                <p class="text-xl font-semibold text-info">
                  {{ memberDashboard.subtask_stat.Todo }}
                  To Do
                </p>
                <p class="text-xl font-semibold text-secondary">
                  {{ memberDashboard.subtask_stat["In Progress"] }}
                  In Progress
                </p>
                <p class="text-xl font-semibold text-success">
                  {{ memberDashboard.subtask_stat.Completed }}
                  Completed
                </p>
                <p class="text-xl font-semibold text-error">
                  {{ memberDashboard.subtask_stat.Cancelled }}
                  Cancelled
                </p>
              </div>
            </div>
          </div>
          <div class="my-card list-content my-card-3 space-y-2" v-if="memberDashboard.subtask_team_count">
            <p class="text-xl text-primary font-semibold border-b">
              Subtasks count in each teams
            </p>
            <div
              class="particular-stat-container"
              v-for="subtask in memberDashboard.subtask_team_count"
            >
              <div class="particular-stat-label">
                <span>{{ subtask.team }}</span>
              </div>
              <div class="particular-stat">
                <span class="particular-stat-count">{{ subtask.count }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="my-card-container mt-2">
        <div
          class="my-card list-content my-card-2 space-y-2"
          v-if="memberDashboard.latest_notifications"
        >
          <p class="text-xl text-primary font-semibold border-b">
            Latest notifications
          </p>
          <div
            class="particular-stat-container"
            v-for="notification in memberDashboard.latest_notifications"
          >
            <div class="particular-stat-label">
              <span>{{ notificationText(notification) }}</span>
            </div>
            <!-- <div class="particular-stat">
                <span class="particular-stat-count">{{ subtask.count }}</span>
              </div> -->
          </div>
        </div>
        <div
          class="my-card list-content my-card-2 space-y-2"
          v-if="memberDashboard.subtask_completed"
        >
          <p class="text-xl text-primary font-semibold border-b">
            Subtasks completed
          </p>
          <div
            class="particular-stat-container"
            v-for="subtask in memberDashboard.subtask_completed"
          >
            <div class="particular-stat-label">
              <span>{{ subtask.title }}</span>
            </div>
            <div class="particular-stat">
              <span class="text-sm">{{
                $dayjs(subtask.created_at).format("DD-MM-YYYY")
              }}</span>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="" v-if="leadDashboard">
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
                      class="
                        particular-stat-label
                        flex
                        justify-between
                        items-center
                        w-full
                      "
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
                      class="
                        particular-stat-label
                        flex
                        justify-between
                        items-center
                        w-full
                      "
                    >
                      <span>{{ invitation.user.profil.name }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import Loading from "../../../Components/Layouts/Loading.vue";
import { getMemberDashboard } from "../../../Services/Member/MemberDashboard";
export default {
  components: { Loading },
  computed: {
    ...mapGetters(["loadingMemberDashboard", "memberDashboard"]),
  },
  mounted() {
    getMemberDashboard();
  },
  methods: {
    notificationText(notif) {
      switch (notif.type) {
        case "team_member_invitation":
          return `You are invited to join the '${notif.team.name}' Team`;
        case "team_lead_invitation":
          return `You are invited to lead the '${notif.team.name}' Team`;
        case "new_subtask_assigned":
          const { task, subtask } = JSON.parse(notif.data);
          return `A new subtask '${subtask}' for the '${task} task' has been assigned to you in the '${notif.team.name} team'`;
        default:
          break;
      }
    },
  },
};
</script>