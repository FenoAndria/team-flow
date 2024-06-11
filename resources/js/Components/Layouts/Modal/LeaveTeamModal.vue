<template>
  <Modal :modalId="modalId" :content="content">
    <p class="text-xl text-center">Are you sure to leave this team?</p>
    <div class="flex space-x-2 justify-center mt-4 text-lg">
      <button class="bg-danger w-16" @click="handleLeaveTeam('Yes')">
        Yes
      </button>
      <button class="bg-neutral w-16" @click="handleLeaveTeam('No')">No</button>
    </div>
  </Modal>
</template>
<script>
import Modal from "../Modal.vue";
import { mapGetters } from "vuex";
import { getTeamMember } from "../../../Services/Lead/LeadTeamService";
import {
  assignUserSubtask,
  showTeamTask,
} from "../../../Services/Lead/LeadTaskService";
import ValidationError from "../../ValidationError.vue";
import store from "../../../Stores/Index";
import { leaveTeam } from "../../../Services/Member/MemberTeamService";
import router from "../../../Router/Index";
export default {
  props: ["modalId", "content"],
  components: { Modal, ValidationError },
  data() {
    return {
      user: "",
    };
  },
  computed: {
    ...mapGetters(["teamMember", "loadingTeamMember", "loadingAssignUser"]),
  },

  methods: {
    async handleLeaveTeam(response) {
      if (response === "No") {
        document.querySelector("#" + this.modalId).checked = false;
      } else {
        await leaveTeam(this.content.id);
        router.push({ name: "TeamIndex" });
        document.querySelector("#" + this.modalId).checked = false;
      }
    },
  },
};
</script>