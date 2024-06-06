<template>
  <Modal :modalId="modalId" :content="content">
    <div v-if="content" class="text-xl border-b">{{ content.title }}</div>
    <div v-if="this.loadingTeamMember">
      <span class="loading"></span>
    </div>
    <div v-else class="mt-2">
      <form @submit="assignUser" v-if="teamMember">
        <ValidationError column="user_id" />
        <div v-for="item in teamMember" class="">
          <label class="flex items-center space-x-2 cursor-pointer">
            <input
              type="radio"
              v-model="user"
              :value="item.id"
              class="radio radio-xs radio-primary"
            />
            <span class="text-lg text-dark">{{ item.profil.name }}</span>
          </label>
        </div>
        <div class="">
          <div class="flex justify-center" v-if="loadingAssignUser">
            <span class="loading loading-dots"></span>
          </div>
          <button class="bg-info w-full mt-2" v-else>Assign</button>
        </div>
      </form>
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
      if (store.getters.withSuccess) {
        document.querySelector("#" + this.modalId).checked = false;
        await showTeamTask(this.content.task_id);
        store.commit("setWithSuccess", "");
        this.user = "";
        store.commit("setValidationError", "");
      }
    },
  },
};
</script>