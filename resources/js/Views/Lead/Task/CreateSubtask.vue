<template>
  <LeadLayout>
    <h1>Create subtask</h1>
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
      <button class="btn bg-success-500">Save</button>
    </form>
  </LeadLayout>
</template>
<script>
import { reactive, toRefs } from "@vue/reactivity";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { storeSubtask } from "../../../Services/Lead/LeadTaskService";
import { useRoute } from "vue-router";
export default {
  components: { LeadLayout },
  setup(props) {
    const state = reactive({
      subtask: {
        title: "",
        description: "",
        deadline: null,
      },
    });
    const route = useRoute();
    const handleStoreSubtask = async (e) => {
      e.preventDefault();
      await storeSubtask({ taskId: route.params.task, subtask: state.subtask });
    };
    return {
      ...toRefs(state),
      handleStoreSubtask,
    };
  },
};
</script>