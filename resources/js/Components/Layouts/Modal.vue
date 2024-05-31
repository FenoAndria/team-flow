<template>
  <!-- <input type="checkbox" :id="modalId" class="modal-toggle" /> -->
  <div class="modal" :class="{ 'modal-open': isOpen }">
    <div class="modal-box">
      <div v-if="content">Subtask title : {{ content.title }}</div>
      <form @submit="assignUser">
        <label for="">Members :</label>
        <div v-for="item in teamMember">
          <label for="" class=""
            >{{ item.profil.name }}
            <input type="radio" v-model="user" :value="item.id" class="radio"
          /></label>
        </div>
        <button class="btn btn-primary text-white">Assign</button>
      </form>
      <div class="modal-action">
        <button
          class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
          @click="closeModal"
        >
          ✕
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { assignUserSubtask } from "../../Services/Lead/LeadTaskService";
import { getTeamMember } from "../../Services/Lead/LeadTeamService";
export default {
  props: ["isOpen", "content"],
  data() {
    return {
      user: "",
    };
  },
  computed: {
    ...mapGetters(["teamMember", "loadingTeamMember"]),
  },
  methods: {
    closeModal() {
      this.$emit("close");
    },
    async assignUser(e) {
      e.preventDefault();
      await assignUserSubtask({
        subtaskId: this.content.id,
        user_id: this.user,
      });
      this.$emit("close");
      this.$emit("reloadShowTeamTask");
    },
  },
  mounted() {
    getTeamMember();
  },
};
</script>