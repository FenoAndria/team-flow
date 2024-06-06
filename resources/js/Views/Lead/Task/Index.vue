<template>
  <LeadLayout>
    <div>
      <div v-if="loadingTeamTasks">
        <Loading />
      </div>
      <div v-else>
        <div class="page-title">All tasks</div>
        <div v-if="teamTasks.length">
          <div class="flex flex-wrap -mx-1">
            <div class="w-1/2 px-1" v-for="item in teamTasks">
              <div class="list-content">
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
                <p class="text-sm">
                  {{ item.description }}
                </p>
                <hr />
                <div class="flex justify-between items-center text-sm">
                  <p class="text-neutral">
                    Created at :
                    <span class="font-semibold">{{
                      dayjs(item.created_at).format("DD-MM-YYYY")
                    }}</span>
                  </p>
                  <router-link
                    :to="{ name: 'LeadTaskShow', params: { task: item.id } }"
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
    </div>
  </LeadLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { getTeamTasks } from "../../../Services/Lead/LeadTaskService";
import { useStore } from "vuex";
import statusColor from "../../../Services/statusColor";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import dayjs from "dayjs";
export default {
  components: { LeadLayout, Loading, StatusBadge },
  setup(props) {
    const store = useStore();
    const teamTasks = computed(() => store.getters.teamTasks);
    const loadingTeamTasks = computed(() => store.getters.loadingTeamTasks);

    onMounted(async () => {
      await getTeamTasks();
    });
    return {
      teamTasks,
      loadingTeamTasks,
      statusColor,
      dayjs,
    };
  },
};
</script>