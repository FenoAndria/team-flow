<template>
  <div>
    <Navbar :links="links" />
    <div id="main">
      <slot></slot>
    </div>
  </div>
</template>
<script>
import Navbar from "../Layouts/Navbar.vue";
export default {
  components: { Navbar },
  setup(props) {
    const links = [
      {
        name: "AppIndex",
        tag: "Home",
        activeClass: ["AppIndex"],
      }, 
      {
        name: "AdminTaskIndex",
        tag: "Tasks",
        activeClass: ["AdminTaskIndex"],
      }, 
      {
        name: "AdminTeamIndex",
        tag: "Teams",
        activeClass: ["AdminTeamIndex","AdminTeamShow"],
      }, 
      {
        name: "AdminLeadInvitationIndex",
        tag: "Invitations",
        activeClass: ["AdminLeadInvitationIndex"],
      }, 
    ];
    return {links}
  },
};
</script>