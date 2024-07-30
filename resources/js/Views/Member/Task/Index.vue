<template>
  <UserLayout pageTitle="Task list">
    <div>
      <div v-if="loadingMemberSubtasks">
        <Loading />
      </div>
      <div v-else>
        <Filter
          :filterTab="subtaskFilter"
          @filterItem="handleFilterTask"
          :count="filteredSubtask.length"
        />
        <div class="my-card-container" v-if="filteredSubtask.length">
          <div
            class="my-card list-content my-card-3"
            v-for="item in filteredSubtask"
          >
            <div class="">
              <div>
                <div class="flex justify-between border-b py-1">
                  <p class="font-semibold text-lg text-primary">
                    {{ item.title }}
                  </p>
                  <StatusBadge :status="item.status" />
                </div>
                <p class="text-sm text-neutral-600">
                  {{ item.description }}
                </p>
                <p class="text-sm font-semibold">
                  <span class="uppercase">{{ item.task.team.name }}</span>
                  Team | {{ item.task.title }}
                </p>
              </div>
              <div class="flex justify-between">
                <div></div>
                <div>
                  <div v-if="item.status == 'Todo'">
                    <button
                      class="bg-blue-500"
                      @click="changeStatus(item.id, 'In Progress')"
                    >
                      Begin
                    </button>
                  </div>
                  <div
                    v-else-if="item.status == 'In Progress'"
                    class="space-x-2"
                  >
                    <button
                      class="bg-green-500"
                      @click="changeStatus(item.id, 'Completed')"
                    >
                      Complete
                    </button>
                    <button
                      class="bg-red-500"
                      @click="changeStatus(item.id, 'Cancelled')"
                    >
                      Cancel
                    </button>
                  </div>
                  <p
                    class="italic text-xs text-neutral"
                    v-if="item.status == 'Completed'"
                  >
                    {{ $dayjs(item.updated_at).format("DD-MM-YYYY HH:mm") }}
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
import { mapGetters } from "vuex";
import UserLayout from "../../../Components/Layouts/UserLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import {
  getMemberSubtasks,
  updateMemberSubtask,
} from "../../../Services/Member/MemberSubtaskService";
import StatusBadge from "../../../Components/Layouts/StatusBadge.vue";
import Filter from "../../../Components/Filter/Filter.vue";
import { subtaskFilter } from "../../../Services/Filter/TeamMemberFilter";
export default {
  components: { UserLayout, StatusBadge, Loading,Filter },
  data() {
    return {
      filteredSubtask: [],
      subtaskFilter,
    };
  },
  computed: {
    ...mapGetters(["memberSubtasks", "loadingMemberSubtasks"]),
  },
  methods: {
    async changeStatus(subtaskId, status) {
      await updateMemberSubtask({ id: subtaskId, status });
      getMemberSubtasks();
    },
     handleFilterTask(e) {
      if (e.name === "All") {
        this.filteredSubtask = this.memberSubtasks;
      } else {
        this.filteredSubtask = this.memberSubtasks.filter(
          (item) => item.status == e.name
        );
      }
    },
  },
  mounted() {
    getMemberSubtasks();
  },
};
</script>