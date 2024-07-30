<template>
  <AdminLayout pageTitle="Notifications">
    <div v-if="loadingAdminNotification"><Loading /></div>
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
  </AdminLayout> 
</template>
<script>
import { mapGetters } from "vuex";
import AdminLayout from "../../../Components/Layouts/AdminLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import { getAdminNotification } from "../../../Services/Admin/AdminNotification";
import Filter from "../../../Components/Filter/Filter.vue";
import { notificationFilter } from "../../../Services/Filter/AdminFilter";
export default {
  components: { AdminLayout, Loading, Filter },
  data() {
    return {
      filteredNotification: [],
      notificationFilter
    };
  },
  computed: {
    ...mapGetters(["loadingAdminNotification", "adminNotification"]),
  },
  mounted() {
    getAdminNotification();
  },
  methods: {
    handleFilterNotification(e) {
      switch (e.tag) {
        case "Lead invitation accepted":
          this.filteredNotification = this.adminNotification.filter(
            (item) => item.type === "lead_invitation_accepted"
          );
          break;
        case "Task completed":
          this.filteredNotification = this.adminNotification.filter(
            (item) => item.type === "task_completed"
          );
          break;
        case "Task beginning":
          this.filteredNotification = this.adminNotification.filter(
            (item) => item.type === "task_beginning"
          );
          break;
        default:
          this.filteredNotification = this.adminNotification;
          break;
      }
    },
    notificationText(notif) {
      switch (notif.type) {
        case "lead_invitation_accepted":
          return `'${notif.user.name}' accepted to lead the '${notif.team.name}' Team`;
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