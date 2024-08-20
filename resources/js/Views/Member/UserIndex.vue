<template>
  <UserLayout pageTitle="Dashboard">
    <MemberDashboard />
  </UserLayout>
</template>
<script>
import UserLayout from "../../Components/Layouts/UserLayout.vue";
import MemberDashboard from "../Member/Dashboard/Index.vue";
export default {
  components: { UserLayout, MemberDashboard },
  setup(props) {},
};
</script>