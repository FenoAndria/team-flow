<template>
  <Modal :modalId="modalId" :content="content">
    <h1>Create subtask</h1>
    <div v-if="content">Task : {{ content.title }}</div>
    <form @submit="handleStoreSubtask">
      <div class="">
        <label for="title">Title</label>
        <input type="text" v-model="subtask.title" />
      </div>
      <div class="">
        <label for="description">Description</label>
        <input type="text" v-model="subtask.description" />
      </div>
      <div class="">
        <label for="deadline">Deadline</label>
        <input type="date" v-model="subtask.deadline" />
      </div>
      <button class="bg-info w-full">Save</button>
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
export default {
  props: ["modalId", "content"],
  components: { Modal },
  data() {
    return {
      user: "",
      subtask: {
        title: "",
        description: "",
        deadline: null,
      },
    };
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
      }
    },
  },
};
</script>