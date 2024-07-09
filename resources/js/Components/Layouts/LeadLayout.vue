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
        name: "LeadTaskIndex",
        tag: "Task",
        activeClass: ["LeadTaskIndex", "LeadTaskShow"],
      },
      {
        name: "LeadTeamMember",
        tag: "Member",
        activeClass: ["LeadTeamMember"],
      },
      {
        name: "LeadInvitationIndex",
        tag: "Invitation",
        activeClass: ["LeadInvitationIndex"],
      },
      {
        name: "LeadMessageIndex",
        tag: "Message",
        activeClass: ["LeadMessageIndex"],
      },
    ];
    return { links };
  },
};
</script>