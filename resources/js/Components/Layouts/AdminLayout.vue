<template>
  <div>
    <Menu :navbarLinks="navbarLinks" :sidebarLinks="sidebarLinks" :pageTitle="pageTitle"/>
    <div id="main">
      <slot></slot>
    </div>
  </div>
</template>
<script>
import Menu from "../Layouts/Menu.vue";
export default {
  props: ["pageTitle"],
  components: { Menu },
  setup(props) {
    const navbarLinks = [
      {
        name: "AdminLeadInvitationIndex",
        tag: "bi bi-people",
        activeClass: ["AdminLeadInvitationIndex"],
      },
      {
        name: "AdminNotificationIndex",
        tag: "bi bi-bell",
        activeClass: ["AdminNotificationIndex"],
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
        name: "AdminTaskIndex",
        tag: "Tasks",
        icon: "bi bi-kanban",
        activeClass: ["AdminTaskIndex", "AdminTaskShow"],
      },
      {
        name: "AdminTeamIndex",
        tag: "Teams",
        icon: "bi bi-collection",
        activeClass: ["AdminTeamIndex", "AdminTeamShow"],
      },
      {
        name: "MemberIndex",
        tag: "Members",
        icon: "bi bi-people",
        activeClass: ["MemberIndex"],
      },
    ];
    return { navbarLinks, sidebarLinks };
  },
};
</script>