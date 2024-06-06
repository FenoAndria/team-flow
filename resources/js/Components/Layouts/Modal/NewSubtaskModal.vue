<template>
  <Modal :modalId="modalId" :content="content">
    <p class="text-xl border-b">Create subtask</p>
    <div v-if="content" class="text-dark">{{ content.title }}</div>
    <form @submit="handleStoreSubtask">
      <div class="">
        <label for="title">Title</label>
        <input type="text" v-model="subtask.title" />
        <ValidationError column="title" />
      </div>
      <div class="">
        <label for="description">Description</label>
        <input type="text" v-model="subtask.description" />
        <ValidationError column="description" />
      </div>
      <div class="">
        <label for="deadline">Deadline</label>
        <input type="date" v-model="subtask.deadline" />
        <ValidationError column="deadline" />
      </div>
      <div class="">
        <div class="flex justify-center" v-if="loadingStoreSubtask">
          <span class="loading loading-dots"></span>
        </div>
        <button class="bg-info w-full mt-2" v-else>Save</button>
      </div>
    </form>
  </Modal>
</template>
<script>
import Modal from "../Modal.vue";
import { mapGetters } from "vuex";
import {
  showTeamTask,
  storeSubtask,
} from "../../../Services/Lead/LeadTaskService";
import store from "../../../Stores/Index";
import ValidationError from "../../ValidationError.vue";
export default {
  props: ["modalId", "content"],
  components: { Modal, ValidationError },
  data() {
    return {
      subtask: {
        title: "",
        description: "",
        deadline: null,
      },
    };
  },
  computed: {
    ...mapGetters(["loadingStoreSubtask"]),
  },
  methods: {
    async handleStoreSubtask(e) {
      e.preventDefault();
      await storeSubtask({ taskId: this.content.id, subtask: this.subtask });
      if (store.getters.withSuccess) {
        document.querySelector("#" + this.modalId).checked = false; // hide modal
        await showTeamTask(this.content.id); // reload task list
        store.commit("setWithSuccess", ""); // reinitialize withSuccess state
        this.subtask = ""; // reinitialize subtask :)
        store.commit("setValidationError", ""); // reinitialize validationError state
      }
    },
  },
};
</script>