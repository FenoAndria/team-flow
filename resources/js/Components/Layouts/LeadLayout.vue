<template>
  <div>
    <Navbar :links="links"/>
    <slot></slot>
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
      },
      {
        name: "LeadTaskIndex",
        tag: "Task",
      },
      {
        name: "LeadTeamMember",
        tag: "Member",
      },
      {
        name: "LeadInvitationIndex",
        tag: "Invitation",
      },
    ];
    return { links };
  },
};
</script>