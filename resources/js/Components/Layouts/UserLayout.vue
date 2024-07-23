<template>
  <div>
    <Menu :sidebarLinks="sidebarLinks" :navbarLinks="navbarLinks" :pageTitle="pageTitle"/>
    <div id="main">
      <slot></slot>
    </div>
  </div>
</template>
<script>
import Menu from "../Layouts/Menu.vue";
export default {
  props:['pageTitle'],
  components: { Menu },
  setup(props) {
    const navbarLinks = [
      {
        name: "MemberMessageIndex",
        tag: "bi bi-envelope",
        activeClass: ["MemberMessageIndex"],
      },

      {
        name: "MemberInvitationIndex",
        tag: "bi bi-people",
        activeClass: ["MemberInvitationIndex"],
      },
      {
        name: "MemberNotificationIndex",
        tag: "bi bi-bell",
        activeClass: ["MemberNotificationIndex"],
      },
    ];
    const sidebarLinks = [
      {
        name: "AppIndex",
        tag: "Dashboard",
        icon: "bi bi-clipboard-data",
        activeClass: ["AppIndex"],
      },
      {
        name: "TaskIndex",
        tag: "Task",
        icon: "bi bi-kanban",
        activeClass: ["TaskIndex"],
      },
      {
        name: "TeamIndex",
        tag: "Team",
        icon: "bi bi-collection",
        activeClass: ["TeamIndex", "TeamShow"],
      },
    ];
    return { navbarLinks, sidebarLinks };
  },
};
</script>