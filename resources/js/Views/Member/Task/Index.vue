<template>
  <UserLayout>
    <div>Task Index</div>
    <div>
      <div v-if="loadingMemberSubtasks">
        <span class="loading"></span>
      </div>
      <div v-else>
        <div v-if="memberSubtasks.length">
          <div class="list-container">
            <div
              class="list-content flex justify-between"
              v-for="item in memberSubtasks"
            >
              <div>
                <p class="uppercase font-semibold">
                  {{ item.title }}
                </p>
                <p class="uppercase text-sm font-semibold">
                  {{ item.description }}
                </p>
                <p class="text-xs">
                  Team :
                  <span class="font-semibold">{{ item.task.team.name }}</span>
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
                <div>
                  <div v-if="item.status == 'Todo'">
                    <button
                      class="btn bg-blue-500"
                      @click="changeStatus(item.id, 'In Progress')"
                    >
                      Begin
                    </button>
                  </div>
                  <div v-else-if="item.status == 'In Progress'">
                    <p class="italic text-xs">
                      Started on :
                      {{ dayjs(item.updated_at).format("DD-MM-YYYY") }}
                    </p>
                    <button
                      class="btn bg-green-500"
                      @click="changeStatus(item.id, 'Completed')"
                    >
                      Complete
                    </button>
                    <button
                      class="btn bg-red-500"
                      @click="changeStatus(item.id, 'Cancelled')"
                    >
                      Cancel
                    </button>
                  </div>
                  <p class="italic text-xs" v-if="item.status == 'Completed'">
                      On :
                      {{ dayjs(item.updated_at).format("DD-MM-YYYY") }}
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else>Empty</div>
      </div>
    </div>
  </UserLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import UserLayout from "../../../Components/Layouts/UserLayout.vue";
import {
  getMemberSubtasks,
  updateMemberSubtask,
} from "../../../Services/Member/MemberSubtaskService";
import dayjs from "dayjs";
import statusColor from "../../../Services/statusColor";
export default {
  components: { UserLayout },
  setup(props) {
    const store = useStore();
    const memberSubtasks = computed(() => store.getters.memberSubtasks);
    const loadingMemberSubtasks = computed(
      () => store.getters.loadingMemberSubtasks
    );
   
    const changeStatus = async (subtaskId, status) => {
      await updateMemberSubtask({ id: subtaskId, status });
      getMemberSubtasks();
    };
    onMounted(async () => {
      await getMemberSubtasks();
    });
    return {
      memberSubtasks,
      loadingMemberSubtasks,
      dayjs,
      statusColor,
      changeStatus,
    };
  },
};
</script>