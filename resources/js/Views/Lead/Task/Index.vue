<template>
  <LeadLayout>
    <div>Lead task index</div>
    <div>
      <div v-if="loadingTeamTasks">
        <span class="loading"></span>
      </div>
      <div v-else>
        <div v-if="teamTasks.length">
          <div class="list-container">
            <div class="list-content" v-for="item in teamTasks">
              <div class="flex justify-between">
                <div>
                  <p class="uppercase font-semibold">
                    {{ item.title }}
                  </p>
                </div>
                <div>
                  <p>
                    Status :
                    <span :class="statusColor(item.status) + ' font-semibold'">
                      {{ item.status }}</span
                    >
                  </p>
                </div>
              </div>
              <hr />
              <p class="text-sm">
                {{ item.description }}
              </p>
              <p class="text-sm">
                Deadline :
                <span class="font-semibold">{{ item.deadline }}</span>
              </p>
              <hr />
              <router-link
                :to="{ name: 'LeadTaskShow', params: { task: item.id } }"
              >Details</router-link>
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
export default {
  components: { LeadLayout },
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
    };
  },
};
</script>