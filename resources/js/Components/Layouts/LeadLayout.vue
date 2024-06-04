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
        activeClass: [
            "AppIndex",
        ],
      },
      {
        name: "LeadTaskIndex",
        tag: "Task",
        activeClass: [
            "LeadTaskIndex",
            "LeadTaskShow",
            "LeadCreateSubtask",
        ],
      },
      {
        name: "LeadTeamMember",
        tag: "Member",
        activeClass: [
            "LeadTeamMember",
        ],
      },
      {
        name: "LeadInvitationIndex",
        tag: "Invitation",
        activeClass: [
            "LeadInvitationIndex",
        ],
      },
    ];
    return { links };
  },
};
</script>