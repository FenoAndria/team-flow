<template>
  <AdminLayout pageTitle="Dashboard">
    <AdminDashboard />
  </AdminLayout>
</template>
<script>
import AdminLayout from "../../Components/Layouts/AdminLayout.vue";
import AdminDashboard from "../Admin/Dashboard/Index.vue";
export default {
  components: { AdminLayout, AdminDashboard },
};
</script>