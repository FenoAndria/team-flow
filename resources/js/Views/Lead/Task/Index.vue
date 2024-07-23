<template>
  <LeadLayout pageTitle="Task list">
    <div>
      <div v-if="loadingTeamTasks">
        <Loading />
      </div>
      <div v-else>
        <div class="page-title">All tasks</div>
        <div v-if="teamTasks.length">
          <div class="my-card-container">
            <div
              class="my-card list-content my-card-3"
              v-for="item in teamTasks"
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
export default {
  components: { LeadLayout, Loading, StatusBadge },
  computed: {
    ...mapGetters(["teamTasks", "loadingTeamTasks"]),
  },
  mounted() {
    getTeamTasks();
  },
};
</script>