<template>
  <div>
    <Menu :navbarLinks="navbarLinks" :sidebarLinks="sidebarLinks" />
    <div id="main">
      <slot></slot>
    </div>
  </div>
</template>
<script>
import Menu from "../Layouts/Menu.vue";
export default {
  components: { Menu },
  setup(props) {
    const navbarLinks = [
      {
        name: "LeadMessageIndex",
        tag: "bi bi-envelope",
        activeClass: ["LeadMessageIndex"],
      },
      {
        name: "LeadInvitationIndex",
        tag: "bi bi-people",
        activeClass: ["LeadInvitationIndex"],
      },
      {
        name: "LeadNotificationIndex",
        tag: "bi bi-bell",
        activeClass: ["LeadNotificationIndex"],
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
        name: "LeadTaskIndex",
        tag: "Task",
        icon: "bi bi-kanban",
        activeClass: ["LeadTaskIndex", "LeadTaskShow"],
      },
      {
        name: "LeadTeamMember",
        tag: "Member",
        icon: "bi bi-people",
        activeClass: ["LeadTeamMember"],
      },
    ];
    return { navbarLinks, sidebarLinks };
  },
};
</script>