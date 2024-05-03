<template>
  <div class="inline-block bg-red-500 rounded-full px-1 font-bold text-white text-xs">
    <div v-if="getUnfinished(todoTab)">{{ getUnfinished(todoTab) }}</div>
  </div>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import { getTodoTab } from "../Services/TodoServices";
export default {
  setup(props) {
    const store = useStore();
    const loadingTodoTab = computed(() => store.getters.loadingTodoTab);
    const todoTab = computed(() => store.getters.todoTab);
    const getUnfinished = (todoTab) => (todoTab.filter((item) => !item.done)).length;
    onMounted(async () => {
      await getTodoTab();
    });
    return {
      loadingTodoTab,
      todoTab,
      getUnfinished,
    };
  },
};
</script>