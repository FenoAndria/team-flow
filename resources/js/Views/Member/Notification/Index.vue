<template>
  <UserLayout pageTitle="Notifications">
    <div v-if="loadingMemberNotification"><Loading /></div>
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
  </UserLayout>
</template>
<script>
import { mapGetters } from "vuex";
import UserLayout from "../../../Components/Layouts/UserLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import { getMemberNotification } from "../../../Services/Member/MemberNotification";
import Filter from "../../../Components/Filter/Filter.vue";
import { notificationFilter } from "../../../Services/Filter/TeamMemberFilter";
export default {
  components: { UserLayout, Loading, Filter },
  data() {
    return {
      filteredNotification: [],
      notificationFilter,
    };
  },
  computed: {
    ...mapGetters(["loadingMemberNotification", "memberNotification"]),
  },
  mounted() {
    getMemberNotification();
  },
  methods: {
    handleFilterNotification(e) {
      switch (e.tag) {
        case "New subtask assigned":
          this.filteredNotification = this.memberNotification.filter(
            (item) => item.type === "new_subtask_assigned"
          );
          break;
        case "New team member invitation":
          this.filteredNotification = this.memberNotification.filter(
            (item) => item.type === "team_member_invitation"
          );
          break;
        case "New team lead invitation":
          this.filteredNotification = this.memberNotification.filter(
            (item) => item.type === "team_lead_invitation"
          );
          break;

        default:
          this.filteredNotification = this.memberNotification;
          break;
      }
    },
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
<style lang="postcss">
.notification-content {
  @apply bg-gray-100 py-2 px-4 rounded text-primary font-semibold mb-1;
}
.notification-date {
  @apply text-xs text-neutral;
}
</style>