<template>
  <AdminLayout>
    <Breadcumb
      :previousPage="[{ name: 'AdminTaskIndex', tag: 'Tasks' }]"
      currentPage="Show"
    />
    <div v-if="loadingTask"><Loading /></div>
    <div v-else>
      <div class="">
        <div class="flex justify-between">
          <div>
            <p class="text-xl uppercase font-semibold text-primary">
              {{ task.title }}
            </p>
          </div>
          <div>
            <StatusBadge :status="task.status" />
          </div>
        </div>
        <hr />
        <p class="text-sm">
          {{ task.description }}
        </p>
        <p class="text-sm">
          Team : <span class="font-semibold">{{ task.team }}</span>
        </p>
        <p class="text-sm">
          Deadline :
          <span class="font-semibold">{{
            task.deadline ? $dayjs(task.deadline).format("DD-MM-YYYY") : "None"
          }}</span>
        </p>
        <p class="text-sm">
          Created at :
          <span class="font-semibold">{{
            $dayjs(task.created_at).format("DD-MM-YYYY") ?? "None"
          }}</span>
        </p>
        <div class="flex justify-between items-center border-b">
          <p class="font-semibold text-lg">Subtasks :</p>
        </div>
        <div class="text-sm">
          <div v-if="task.subtasks">
            <div class="my-card-container mt-2">
              <div
                class="my-card list-content my-card-3"
                v-for="subtask in task.subtasks"
              >
                <div class="">
                  <div class="flex justify-between items-center">
                    <p class="font-semibold text-lg text-primary">
                      {{ subtask.title }}
                    </p>
                    <StatusBadge :status="subtask.status" />
                  </div>
                  <div class="text-xs">
                    <p>
                      Deadline :
                      {{
                        subtask.deadline
                          ? $dayjs(subtask.deadline).format("DD-MM-YYYY")
                          : "None"
                      }}
                    </p>
                    <div class="flex items-center space-x-1">
                      <span class="bi bi-person-fill text-info text-sm"></span>
                      <span
                        v-if="subtask.assigned_to"
                        class="text-neutral font-bold"
                        >{{ subtask.assigned_to.profil.name }}</span
                      >
                      <span class="text-error font-semibold" v-else>None</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
<script>
import { mapGetters } from "vuex";
import AdminLayout from "../../../Components/Layouts/AdminLayout.vue";
import Breadcumb from "../../../Components/Layouts/Breadcumb.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import { getTask } from "../../../Services/Admin/TaskService";
export default {
  components: { AdminLayout, Breadcumb, Loading, StatusBadge },
  computed: {
    ...mapGetters(["loadingTask", "task"]),
  },
  mounted() {
    getTask(this.$route.params.task);
  },
};
</script>