<template>
  <AdminLayout pageTitle="Task list">
    <div v-if="loadingTasks">
      <Loading />
    </div>
    <div v-else class="">
      <NewButton forLabel="newTaskModal" tagLabel="New Task" />
      <NewTaskModal modalId="newTaskModal" :content="teams" />
      <Filter
        :filterTab="taskFilter"
        @filterItem="handleFilterTask"
        :count="filteredTask.length"
      />
      <div v-if="filteredTask.length" class="mt-2">
        <div class="my-card-container">
          <div
            class="my-card list-content my-card-3"
            v-for="item in filteredTask"
          >
            <div class="">
              <div class="flex justify-between">
                <div>
                  <p class="uppercase font-semibold">
                    {{ item.title }}
                  </p>
                </div>
                <div>
                  <StatusBadge :status="item.status" />
                </div>
              </div>
              <hr class="my-1" />
              <p class="">
                {{ item.team }}
              </p>
              <div class="flex justify-between items-center text-sm">
                <p class="text-neutral font-semibold">
                  {{ $dayjs(item.created_at).format("DD-MM-YYYY") }}
                </p>
                <router-link
                  :to="{ name: 'AdminTaskShow', params: { task: item.id } }"
                  class="text-info hover:underline"
                  >More...</router-link
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else>Empty</div>
    </div>
  </AdminLayout>
</template>
<script>
import { mapGetters } from "vuex";
import AdminLayout from "../../../Components/Layouts/AdminLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import NewTaskModal from "../../../Components/Layouts/Modal/NewTaskModal.vue";
import NewButton from "../../../Components/Layouts/NewButton.vue";
import Filter from "../../../Components/Filter/Filter.vue";
import { getTasks } from "../../../Services/Admin/TaskService";
import { getTeams } from "../../../Services/Admin/TeamService";
import { taskFilter } from "../../../Services/Filter/AdminFilter";

export default {
  components: {
    AdminLayout,
    Loading,
    StatusBadge,
    NewTaskModal,
    NewButton,
    Filter,
  },
  data() {
    return {
      filteredTask: [],
      taskFilter,
    };
  },
  computed: {
    ...mapGetters(["tasks", "loadingTasks", "teams", "loadingTeams"]),
  },
  methods: {
    handleFilterTask(e) {
      if (e.name === "All") {
        this.filteredTask = this.tasks;
      } else {
        this.filteredTask = this.tasks.filter((item) => item.status == e.name);
      }
    },
  },
  async mounted() {
    await getTasks();
    getTeams();
    this.filteredTask = this.tasks;
  },
  watch: {
    tasks() {
      this.filteredTask = this.tasks;
    },
  },
};
</script>
