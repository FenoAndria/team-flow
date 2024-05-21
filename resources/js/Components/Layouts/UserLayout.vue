<template>
  <div>
    <Navbar role="User" :links="links"/>
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
        name: "MemberInvitationIndex",
        tag: "Invitations",
      },
      {
        name: "TeamIndex",
        tag: "Team",
      },
      {
        name: "TaskIndex",
        tag: "Task",
      },
    ];
    return { links };
  },
};
</script>