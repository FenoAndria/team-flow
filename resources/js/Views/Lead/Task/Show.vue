<template>
  <LeadLayout>
    <Breadcumb :previousPage="[{ name: 'LeadTaskIndex', tag: 'Tasks' }]" currentPage="Show"/>
    <div>
      <div v-if="loadingTeamTask">
        <Loading />
      </div>
      <div v-else>
        <div v-if="teamTask">
          <div class="">
            <div class="flex justify-between">
              <div>
                <p class="text-xl uppercase font-semibold text-primary">
                  {{ teamTask.title }}
                </p>
              </div>
              <div>
                <StatusBadge :status="teamTask.status" />
              </div>
            </div>
            <hr />
            <p class="text-sm">
              {{ teamTask.description }}
            </p>
            <p class="text-sm">
              Deadline :
              <span class="font-semibold">{{
                teamTask.deadline
                  ? $dayjs(teamTask.deadline).format("DD-MM-YYYY")
                  : "None"
              }}</span>
            </p>
            <p class="text-sm">
              Created at :
              <span class="font-semibold">{{
                $dayjs(teamTask.created_at).format("DD-MM-YYYY") ?? "None"
              }}</span>
            </p>
            <div class="flex justify-between items-center border-b">
              <p class="font-semibold text-lg">Subtasks :</p>
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
                @click="setNewSubtaskModalData(teamTask)"
                for="newSubtaskModal"
              >
                New subtask
              </label>
            </div>
            <div class="text-sm">
              <div v-if="teamTask.subtasks">
                <div class="my-card-container mt-2">
                  <div
                    class="my-card list-content my-card-3"
                    v-for="subtask in teamTask.subtasks"
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
                        <div
                          v-if="subtask.assigned_to"
                          class="flex items-center space-x-1"
                        >
                          <span
                            class="bi bi-person-fill text-info text-sm"
                          ></span>
                          <span>{{ subtask.assigned_to.profil.name }}</span>
                        </div>
                        <div v-else>
                          <label
                            class="
                              cursor-pointer
                              text-info
                              hover:text-primary
                              hover:underline
                              hover:font-semibold
                              flex
                              items-center
                              space-x-1
                            "
                            @click="setModalData(subtask)"
                            for="assignUserModal"
                          >
                            <span class="bi bi-person-plus-fill text-sm"></span>
                            <span> Assign to a user</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <new-subtask-modal
      modalId="newSubtaskModal"
      :content="newSubtaskModalContent"
    />
    <AssignUserModal
      modalId="assignUserModal"
      :content="assignUserModalContent"
    />
  </LeadLayout>
</template>
<script>
import { computed, onMounted, reactive, toRefs } from "@vue/runtime-core";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import AssignUserModal from "../../../Components/Layouts/Modal/AssignUserModal.vue";
import { showTeamTask } from "../../../Services/Lead/LeadTaskService";
import { useStore } from "vuex";
import { useRoute } from "vue-router";
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import NewSubtaskModal from "../../../Components/Layouts/Modal/NewSubtaskModal.vue";
import Breadcumb from "../../../Components/Layouts/Breadcumb.vue";
export default {
  components: {
    LeadLayout,
    AssignUserModal,
    StatusBadge,
    Loading,
    NewSubtaskModal,
    Breadcumb,
  },
  setup(props) {
    const route = useRoute();
    const store = useStore();
    const state = reactive({
      assignUserModalContent: {},
      newSubtaskModalContent: {},
    });
    const teamTask = computed(() => store.getters.teamTask);
    const loadingTeamTask = computed(() => store.getters.loadingTeamTask);
    const setModalData = (subtask) => {
      state.assignUserModalContent = subtask;
    };
    const setNewSubtaskModalData = (task) => {
      state.newSubtaskModalContent = task;
    };
    onMounted(async () => {
      await showTeamTask(route.params.task);
    });
    return {
      ...toRefs(state),
      teamTask,
      loadingTeamTask,
      setModalData,
      setNewSubtaskModalData,
    };
  },
};
</script>