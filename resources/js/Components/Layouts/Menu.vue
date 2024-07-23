<template>
  <div class="flex">
    <Sidebar :sidebarLinks="sidebarLinks" />
    <Navbar :navbarLinks="navbarLinks">
      <template v-slot:pageTitle>{{ pageTitle }}</template>
    </Navbar>
  </div>
</template>
<script>
import Sidebar from "../../Components/Layouts/Sidebar.vue";
import Navbar from "../../Components/Layouts/Navbar.vue";
export default {
  props: ["navbarLinks", "sidebarLinks", "pageTitle"],
  components: { Sidebar, Navbar },
};
</script>