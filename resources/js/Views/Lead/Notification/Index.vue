<template>
  <LeadLayout pageTitle="Notifications">
    <div v-if="loadingTeamNotification"><Loading /></div>
    <div v-else>
      <Filter
        :filterTab="notificationFilter"
        @filterItem="handleFilterNotification"
        :count="filteredNotification.length"
      />
      <div class="flex justify-center">
        <div class="w-2/3">
          <div v-for="notif in filteredNotification">
            <div class="notification-content">
              <p>{{ notificationText(notif) }}</p>
              <p class="notification-date">
                {{ $dayjs(notif.created_at).format("DD-MM-YYYY HH:mm") }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </LeadLayout>
</template>
<script>
import { mapGetters } from "vuex";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import { getTeamNotification } from "../../../Services/Lead/TeamNotification";
import { notificationFilter } from "../../../Services/Filter/LeadFilter";
import Filter from "../../../Components/Filter/Filter.vue";
export default {
  components: { LeadLayout, Loading,Filter },
  data() {
    return {
      filteredNotification: [],
      notificationFilter
    };
  },
  computed: {
    ...mapGetters(["loadingTeamNotification", "teamNotification"]),
  },
  mounted() {
    getTeamNotification();
  },
  methods: {
     handleFilterNotification(e) {
      switch (e.tag) {
        case "Invitation accepted":
          this.filteredNotification = this.teamNotification.filter(
            (item) => item.type === "invitation_accepted"
          );
          break;
        case "New task assigned":
          this.filteredNotification = this.teamNotification.filter(
            (item) => item.type === "task_assigned"
          );
          break;
        case "Task completed":
          this.filteredNotification = this.teamNotification.filter(
            (item) => item.type === "task_completed"
          );
          break;
        case "Subtask updated":
          this.filteredNotification = this.teamNotification.filter(
            (item) => item.type === "subtask_updated"
          );
          break;
        
        default:
          this.filteredNotification = this.teamNotification;
          break;
      }
    },
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
<style lang="postcss">
.notification-content {
  @apply bg-gray-100 py-2 px-4 rounded text-primary font-semibold mb-1;
}
.notification-date {
  @apply text-xs text-neutral;
}
</style>