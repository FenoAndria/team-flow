<template>
  <Modal :modalId="modalId" :content="content">
    <p class="text-xl border-b">Create task</p>
    <form @submit="handleStoreTask">
      <div class="">
        <label for="title">Title</label>
        <input type="text" v-model="task.title" />
        <ValidationError column="title" />
      </div>
      <div class="">
        <label for="description">Description</label>
        <input type="text" v-model="task.description" />
        <ValidationError column="description" />
      </div>
      <div class="">
        <label for="deadline">Deadline</label>
        <input type="date" v-model="task.deadline" />
        <ValidationError column="deadline" />
      </div>
      <div class="" v-if="content">
        <label for="team">Team</label>
        <div v-for="item in content" class="">
          <label class="flex items-center space-x-2 cursor-pointer" v-if="item.lead">
            <input
              type="radio"
              v-model="task.team_id"
              :value="item.id"
              class="radio radio-xs radio-primary"
            />
            <span class="text-lg text-dark">{{ item.name }}</span>
          </label>
        </div>
        <ValidationError column="team_id" />
      </div>
      <div class="">
        <div class="flex justify-center" v-if="loadingStoreTask">
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
import { getTasks, storeTask } from "../../../Services/Admin/TaskService";
import store from "../../../Stores/Index";
import ValidationError from "../../ValidationError.vue";
export default {
  props: ["modalId", "content"],
  components: { Modal, ValidationError },
  data() {
    return {
      task: {
        title: "boat",
        description: "",
        deadline: null,
        team_id: "",
      },
    };
  },
  computed: {
    ...mapGetters(["loadingStoreTask"]),
  },
  methods: {
    async handleStoreTask(e) {
      e.preventDefault();
      await storeTask(this.task);
      if (store.getters.withSuccess) {
        document.querySelector("#" + this.modalId).checked = false; // hide modal
        await getTasks(); // reload task list
        store.commit("setWithSuccess", ""); // reinitialize withSuccess state
        this.task = ""; // reinitialize task :)
        store.commit("setValidationError", ""); // reinitialize validationError state
      }
    },
  },
};
</script>