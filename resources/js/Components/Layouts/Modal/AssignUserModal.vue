<template>
  <Modal :modalId="modalId" :content="content">
    <div v-if="content">{{ content.title }}</div>
    <div v-if="this.loadingTeamMember">
      <span class="loading"></span>
    </div>
    <div v-else>
      <form @submit="assignUser" v-if="teamMember">
        <label for="">Members :</label>
        <div v-for="item in teamMember">
          <label class="label cursor-pointer">
            <input type="radio" v-model="user" :value="item.id" class="radio" />
            <span class="">{{ item.profil.name }}</span>
          </label>
        </div>
        <button class="btn btn-primary text-white">Assign</button>
      </form>
    </div>
  </Modal>
</template>
<script>
import Modal from "../Modal.vue";
import { mapGetters } from "vuex";
import { getTeamMember } from "../../../Services/Lead/LeadTeamService";
import { assignUserSubtask, showTeamTask } from "../../../Services/Lead/LeadTaskService";
export default {
  props: ["modalId", "content"],
  components: { Modal },
  data() {
    return {
      user: "",
    };
  },
  computed: {
    ...mapGetters(["teamMember", "loadingTeamMember"]),
  },
  mounted() {
    getTeamMember();
  },
  methods: {
    async assignUser(e) {
      e.preventDefault();
        await assignUserSubtask({
          subtaskId: this.content.id,
          user_id: this.user,
        });
      document.querySelector("#" + this.modalId).checked = false;
      await showTeamTask(this.content.task_id);
    },
  },
};
</script>