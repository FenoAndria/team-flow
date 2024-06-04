<template>
  <div>
    <Navbar role="User" :links="links" />
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
        activeClass: ["AppIndex"],
      },
      {
        name: "MemberInvitationIndex",
        tag: "Invitations",
        activeClass: ["MemberInvitationIndex"],
      },
      {
        name: "TeamIndex",
        tag: "Team",
        activeClass: ["TeamIndex", "TeamShow"],
      },
      {
        name: "TaskIndex",
        tag: "Task",
        activeClass: ["TaskIndex"],
      },
    ];
    return { links };
  },
};
</script>