<template>
  <LeadLayout pageTitle="Dashboard">
    <LeadDashboard />
  </LeadLayout>
</template>
<script>
import LeadLayout from "../../Components/Layouts/LeadLayout.vue";
import LeadDashboard from "../Lead/Dashboard/Index.vue";
export default {
  components: { LeadLayout, LeadDashboard },
};
</script>