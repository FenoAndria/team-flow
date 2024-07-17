<template>
  <AdminLayout>
    <div v-if="loadingAdminNotification"><Loading /></div>
    <div v-else class="flex justify-center">
      <div class="w-2/3">
        <div v-for="notif in adminNotification">
          <div class="notification-content">
            <p>{{ notificationText(notif) }}</p>
            <p class="notification-date">
              {{ $dayjs(notif.created_at).format("DD-MM-YYYY HH:mm") }}
            </p>
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
export default {
  components: { AdminLayout, Loading },
  computed: {
    ...mapGetters(["loadingAdminNotification", "adminNotification"]),
  },
  mounted() {
    getAdminNotification();
  },
  methods: {
    notificationText(notif) {
      switch (notif.type) {
        case "lead_invitation_accepted":
          return `'${notif.user.name}' accepted to lead the '${notif.team.name}' Team`;
        case "task_beginning":
          const { task } = JSON.parse(notif.data);
          return `'${task}' began in the '${notif.team.name}' Team`;
        case "task_completed":
          return `The task '${JSON.parse(notif.data).task}' in the ${notif.team.name} Team is completed`;
        default:
          break;
      }
    },
  },
};
</script>