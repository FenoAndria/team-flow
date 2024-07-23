<template>
  <div class="flex">
    <Sidebar :sidebarLinks="sidebarLinks"/>
    <Navbar :navbarLinks="navbarLinks" />
  </div>
</template>
<script>
import Sidebar from "../../Components/Layouts/Sidebar.vue";
import Navbar from "../../Components/Layouts/Navbar.vue";
export default {
  props: ["navbarLinks", "sidebarLinks"],
  components: { Sidebar, Navbar },
};
</script>