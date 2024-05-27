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

                  <!-- <p class="text-xs">
                  Assigned on {{ dayjs(item.updated_at).format("DD-MM-YYYY") }}
                </p> -->
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
              <div class="text-sm">
                <p class="font-semibold underline">Subtasks :</p>
                <div v-if="item.subtasks.length">
                  <div v-for="subtask in item.subtasks">
                    <div class="flex justify-between">
                      <p>{{ subtask.title }}</p>
                      <p
                        :class="statusColor(subtask.status) + ' font-semibold'"
                      >
                        {{ subtask.status }}
                      </p>
                    </div>
                    <div class="text-xs">
                      <p>Deadline : {{ subtask.deadline }}</p>
                      <p>
                        Assigned to :
                        {{
                          subtask.assigned_to
                            ? subtask.assigned_to.profil.name
                            : "none"
                        }}
                      </p>
                      <p>-----</p>
                    </div>
                  </div>
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
export default {
  components: { LeadLayout },
  setup(props) {
    const store = useStore();
    const teamTasks = computed(() => store.getters.teamTasks);
    const loadingTeamTasks = computed(() => store.getters.loadingTeamTasks);
    const statusColor = (status) => {
      switch (status) {
        case "Todo":
          return "text-blue-500";
          break;
        case "In Progress":
          return "text-orange-500";
          break;
        case "Completed":
          return "text-green-500";
          break;
        case "Cancelled":
          return "text-red-500";
          break;
        default:
          break;
      }
    };
    onMounted(async () => {
      console.log("e");
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