<template>
  <LeadLayout pageTitle="Task list">
    <div>
      <div v-if="loadingTeamTasks">
        <Loading />
      </div>
      <div v-else>
        <Filter
          :filterTab="taskFilter"
          @filterItem="handleFilterTask"
          :count="filteredTask.length"
        />
        <div v-if="filteredTask.length">
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

                <div class="flex justify-between items-center text-sm">
                  <p class="text-neutral">
                    Created at :
                    <span class="font-semibold">{{
                      $dayjs(item.created_at).format("DD-MM-YYYY")
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
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { getTeamTasks } from "../../../Services/Lead/LeadTaskService";
import { mapGetters } from "vuex";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import Filter from "../../../Components/Filter/Filter.vue";
import { taskFilter } from "../../../Services/Filter/LeadFilter";
export default {
  components: { LeadLayout, Loading, StatusBadge, Filter },
  data() {
    return {
      filteredTask: [],
      taskFilter,
    };
  },
  computed: {
    ...mapGetters(["teamTasks", "loadingTeamTasks"]),
  },
  methods: {
    handleFilterTask(e) {
      if (e.name === "All") {
        this.filteredTask = this.teamTasks;
      } else {
        this.filteredTask = this.teamTasks.filter(
          (item) => item.status == e.name
        );
      }
    },
  },
  mounted() {
    getTeamTasks();
    this.filteredTask = this.teamTasks;
  },
};
</script>