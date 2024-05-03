<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-200">
    <div
      class="w-1/2 space-y-2 px-4 py-2 rounded-lg shadow min-h-screen bg-white"
    >
      <div class="">
        <p class="font-bold">Nouveau</p>
        <form @submit="handleStoreTodo" class="flex items-center space-x-2">
          <div class="w-3/4 space-y-2">
            <input type="text" v-model="newTodo" />
            <ValidationError column="title" />
          </div>
          <div class="w-1/4">
            <button class="btn-default w-full">Save</button>
          </div>
        </form>
      </div>
      <div class="">
        <div v-if="loadingTodoTab">Loading...</div>
        <div v-else>
          <div v-if="todoTab.length" class="flex space-x-2">
            <div class="w-1/2">
              <p class="font-bold text-center btn-todo mb-1 text-white">
                TO DO ({{ todoOp(todoTab, false).length }})
              </p>
              <ul v-if="todoOp(todoTab, false).length" class="list-container">
                <li v-for="todo in todoOp(todoTab, false)" class="list-content">
                  <span> {{ todo.title }}</span>
                  <div class="flex flex-col">
                    <span class="text-right">{{ dayjs(todo.created_at).format('DD-MM-YYYY HH:mm') }}</span>
                    <div class="space-x-2">
                      <span
                        class="btn bg-red-300 text-red-500"
                        @click="handleDelete(todo)"
                        >Delete</span
                      >
                      <span
                        class="btn-done text-white font-semibold"
                        @click="handleDone(todo)"
                        >Done</span
                      >
                    </div>
                  </div>
                </li>
              </ul>
              <p v-else>VIDE</p>
            </div>
            <div class="w-1/2">
              <p class="font-bold text-center btn-done mb-1 text-white">
                DONE ({{ todoOp(todoTab, true).length }})
              </p>
              <ul v-if="todoOp(todoTab, true).length" class="list-container">
                <li v-for="todo in todoOp(todoTab, true)" class="list-content">
                  <span> {{ todo.title }}</span>
                  <div class="flex flex-col">
                    <span class="text-right">{{ dayjs(todo.updated_at).format('DD-MM-YYYY HH:mm') }}</span>
                    <div class="space-x-2">
                      <span
                        class="btn bg-red-300 text-red-500"
                        @click="handleDelete(todo)"
                        >Delete</span
                      >
                      <span
                        class="btn-todo text-white font-semibold"
                        @click="handleDone(todo)"
                        >To do</span
                      >
                    </div>
                  </div>
                </li>
              </ul>
              <p v-else>VIDE</p>
            </div>
          </div>
          <div v-else>Vide</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { computed, onMounted, reactive, toRefs } from "@vue/runtime-core";
import { useStore } from "vuex";
import {
  getTodoTab,
  updateTodo,
  storeTodo,
  deleteTodo,
} from "../../Services/TodoServices";
import ValidationError from "../../Components/ValidationError.vue";
import dayjs from 'dayjs'
export default {
  components: { ValidationError },
  setup(props) {
    const store = useStore();
    const state = reactive({
      newTodo: "",
    });
    onMounted(async () => {
      store.commit('setValidationError','')
      await getTodoTab();
    });
    const validationError = computed(() => store.getters.validationError);
    const todoTab = computed(() => store.getters.todoTab);
    const loadingTodoTab = computed(() => store.getters.loadingTodoTab);
    const todoOp = (tab, statut) => tab.filter((item) => item.done == statut);
    const handleDone = async(todo) => {
      store.commit('setValidationError','')
      await updateTodo(todo);
      getTodoTab();
    };
    const handleStoreTodo = async (e) => {
      e.preventDefault();
      store.commit("setValidationError", "");
      await storeTodo({ title: state.newTodo });

      if (!validationError.value) {
        getTodoTab();
        state.newTodo = "";
      }
    };
    const handleDelete = async (todo) => {
      store.commit('setValidationError','')
      await deleteTodo(todo);
      getTodoTab();
    };
    return {
      ...toRefs(state),
      todoTab,
      loadingTodoTab,
      todoOp,
      handleDone,
      handleStoreTodo,
      handleDelete,
      validationError,
      dayjs
    };
  },
};
</script>
<style lang="postcss">
.list-container {
  @apply space-y-1;
}
.list-content {
  @apply py-1 px-2 bg-gray-300 rounded flex justify-between  font-semibold;
}
</style>