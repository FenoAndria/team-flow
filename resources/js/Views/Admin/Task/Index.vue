<template>
  <AdminLayout>
    <div v-if="loadingTasks">
      <Loading />
    </div>
    <div v-else>
      <div class="page-title">All tasks</div>
      <label
        class="
          text-info
          hover:underline
          font-semibold
          bg-neutral-100
          px-4
          rounded
          border
          hover:bg-neutral-200
          cursor-pointer
        "
        for="newTaskModal"
      >
        New task
      </label>
      <NewTaskModal modalId="newTaskModal" :content="teams" />
      <div v-if="tasks.length" class="mt-2">
        <div class="my-card-container">
          <div class="my-card list-content my-card-3" v-for="item in tasks">
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
import { getTasks } from "../../../Services/Admin/TaskService";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import NewTaskModal from "../../../Components/Layouts/Modal/NewTaskModal.vue";
import { getTeams } from "../../../Services/Admin/TeamService";
export default {
  components: { AdminLayout, Loading, StatusBadge, NewTaskModal },
  computed: {
    ...mapGetters(["tasks", "loadingTasks", "teams", "loadingTeams"]),
  },
  mounted() {
    getTasks();
    getTeams();
  },
};
</script>