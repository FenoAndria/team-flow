<template>
  <AdminLayout>
    <div v-if="loadingTasks">
      <Loading />
    </div>
    <div v-else>
      <div class="page-title">All tasks</div>
      <div v-if="tasks.length">
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
                {{item.team}}
              </p>
              <div class="flex justify-between items-center text-sm">
                <p class="text-neutral">
                  Created at :
                  <span class="font-semibold">{{
                    dayjs(item.created_at).format("DD-MM-YYYY")
                  }}</span>
                </p>
                <!-- <router-link
                  :to="{ name: 'LeadTaskShow', params: { task: item.id } }"
                  class="text-info hover:underline"
                  >More...</router-link
                > -->
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
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import dayjs from "dayjs";
import AdminLayout from "../../../Components/Layouts/AdminLayout.vue";
import { getTasks } from "../../../Services/Admin/TaskService";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
export default {
  components: { AdminLayout, Loading, StatusBadge },
  setup(props) {
    const store = useStore();
    const tasks = computed(() => store.getters.tasks);
    const loadingTasks = computed(() => store.getters.loadingTasks);

    onMounted(async () => {
      await getTasks();
    });
    return {
      tasks,
      loadingTasks,
      dayjs,
    };
  },
};
</script>