<template>
  <LeadLayout>
    <div>Lead - show task index</div>
    <div>
      <div v-if="loadingTeamTask">
        <span class="loading"></span>
      </div>
      <div v-else>
        <div v-if="teamTask">
          <div class="list-container">
            <div class="flex justify-between">
              <div>
                <p class="uppercase font-semibold">
                  {{ teamTask.title }}
                </p>
              </div>
              <div>
                <p>
                  Status :
                  <span
                    :class="statusColor(teamTask.status) + ' font-semibold'"
                  >
                    {{ teamTask.status }}</span
                  >
                </p>
              </div>
            </div>
            <hr />
            <p class="text-sm">
              {{ teamTask.description }}
            </p>
            <p class="text-sm">
              Deadline :
              <span class="font-semibold">{{ teamTask.deadline }}</span>
            </p>
            <hr />
            <div class="text-sm">
              <p class="font-semibold underline">Subtasks :</p>
              <div v-if="teamTask.subtasks">
                <div v-for="subtask in teamTask.subtasks">
                  <div class="flex justify-between">
                    <p>{{ subtask.title }}</p>
                    <p :class="statusColor(subtask.status) + ' font-semibold'">
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
    </div>
  </LeadLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { showTeamTask } from "../../../Services/Lead/LeadTaskService";
import { useStore } from "vuex";
import { useRoute } from "vue-router";
import statusColor from "../../../Services/statusColor";
export default {
  components: { LeadLayout },
  setup(props) {
    const route = useRoute();
    const store = useStore();
    const teamTask = computed(() => store.getters.teamTask);
    const loadingTeamTask = computed(() => store.getters.loadingTeamTask);

    onMounted(async () => {
      await showTeamTask(route.params.task);
    });
    return {
      teamTask,
      loadingTeamTask,
      statusColor,
    };
  },
};
</script>