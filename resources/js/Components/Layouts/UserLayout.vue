<template>
  <div>
    <Navbar role="User" :links="links" />
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
        name: "TaskIndex",
        tag: "Task",
        activeClass: ["TaskIndex"],
      },
      {
        name: "TeamIndex",
        tag: "Team",
        activeClass: ["TeamIndex", "TeamShow"],
      },
      {
        name: "MemberInvitationIndex",
        tag: "Invitations",
        activeClass: ["MemberInvitationIndex"],
      },
      {
        name: "MemberMessageIndex",
        tag: "Messages",
        activeClass: ["MemberMessageIndex"],
      },
      {
        name: "MemberNotificationIndex",
        tag: "Notification",
        activeClass: ["MemberNotificationIndex"], 
      },
    ];
    return { links };
  },
};
</script>