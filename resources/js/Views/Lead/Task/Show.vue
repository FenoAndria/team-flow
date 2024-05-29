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
              <router-link
                :to="{
                  name: 'LeadCreateSubtask',
                  params: { task: teamTask.id },
                }"
              >
                <button class="btn bg-primary text-white">New subtask</button>
              </router-link>
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
                    <div v-if="subtask.assigned_to">
                      Assigned to :
                      {{ subtask.assigned_to.profil.name }}
                    </div>
                    <div v-else>
                      <button
                        class="cursor-pointer"
                        for="assignToUserModal"
                        @click="openModal(subtask)"
                      >
                        Assign to a user
                      </button>
                    </div>
                    <p>-----</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Modal
      modalId="assignToUserModal"
      :isOpen="isModalOpen"
      :content="modalContent"
      @close="closeModal"
      @reloadShowTeamTask="reloadShowTeamTask"
    />
  </LeadLayout>
</template>
<script>
import { computed, onMounted, reactive, toRefs } from "@vue/runtime-core";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import Modal from "../../../Components/Layouts/Modal.vue";
import { showTeamTask } from "../../../Services/Lead/LeadTaskService";
import { useStore } from "vuex";
import { useRoute } from "vue-router";
import statusColor from "../../../Services/statusColor";
export default {
  components: { LeadLayout, Modal },
  setup(props) {
    const route = useRoute();
    const store = useStore();
    const state = reactive({
      isModalOpen: false,
      modalContent: {},
    });
    const teamTask = computed(() => store.getters.teamTask);
    const loadingTeamTask = computed(() => store.getters.loadingTeamTask);
    const openModal = (subtask) => {
      state.modalContent = subtask;
      state.isModalOpen = true;
    };
    const closeModal = () => {
      state.modalContent = {};
      state.isModalOpen = false;
    };
    const reloadShowTeamTask = async () => {
      await showTeamTask(route.params.task);
    };
    onMounted(async () => {
      await showTeamTask(route.params.task);
    });
    return {
      ...toRefs(state),
      teamTask,
      loadingTeamTask,
      statusColor,
      closeModal,
      openModal,
      reloadShowTeamTask,
    };
  },
};
</script>