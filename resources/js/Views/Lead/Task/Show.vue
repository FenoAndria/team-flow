<template>
  <LeadLayout>
    <div>
      <div v-if="loadingTeamTask">
        <Loading />
      </div>
      <div v-else>
        <div v-if="teamTask">
          <div class="list-container">
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
                  ? dayjs(teamTask.deadline).format("DD-MM-YYYY")
                  : "None"
              }}</span>
            </p>
            <p class="text-sm">
              Created at :
              <span class="font-semibold">{{
                dayjs(teamTask.created_at).format("DD-MM-YYYY") ?? "None"
              }}</span>
            </p>
            <div class="flex justify-between items-center border-b">
              <p class="font-semibold text-lg">Subtasks :</p>
              <router-link
                :to="{
                  name: 'LeadCreateSubtask',
                  params: { task: teamTask.id },
                }"
              >
                <p class="text-info hover:underline">New subtask</p>
              </router-link>
            </div>
            <div class="text-sm">
              <div v-if="teamTask.subtasks">
                <div class="flex flex-wrap -mx-1">
                  <div
                    class="w-1/3 px-1 mb-2"
                    v-for="subtask in teamTask.subtasks"
                  >
                    <div class="list-content hover:bg-neutral-100">
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
                              ? dayjs(subtask.deadline).format("DD-MM-YYYY")
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
                          <div
                            class="cursor-pointer text-info hover:text-primary hover:underline hover:font-semibold flex items-center space-x-1"
                            @click="openModal(subtask)"
                          >
                            <span
                              class="bi bi-person-plus-fill  text-sm"
                            ></span>
                            <span> Assign to a user</span>
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
    </div>
    <Modal
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
import Loading from "../../../Components/Layouts/Loading.vue";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import dayjs from "dayjs";
export default {
  components: { LeadLayout, Modal, StatusBadge, Loading },
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
      dayjs,
    };
  },
};
</script>