<template>
  <Modal :modalId="modalId" :content="content">
    <div class="text-xl border-b">Invite user</div>
    <div v-if="this.loadingUsersInvitable">
      <span class="loading"></span>
    </div>
    <div v-else class="mt-2">
      <form @submit="handleStoreLeadInvitation" v-if="usersInvitable">
        <ValidationError column="user_id" />
        <div v-for="item in usersInvitable" class="">
          <label class="flex items-center space-x-2 cursor-pointer">
            <input
              type="radio"
              v-model="user"
              :value="item.id"
              class="radio radio-xs radio-primary"
            />
            <div class="flex justify-between w-full">

            <span class="text-lg text-dark">{{ item.profil.name }}</span>
            <span class=" text-neutral">{{ item.email }}</span>
            </div>
          </label>
        </div>
        <div class="">
          <div class="flex justify-center" v-if="loadingStoreLeadInvitation">
            <span class="loading loading-dots"></span>
          </div>
          <button class="bg-info w-full mt-2" v-else>Invite</button>
        </div>
      </form>
    </div>
  </Modal>
</template>
<script>
import Modal from "../Modal.vue";
import { mapGetters } from "vuex";
import ValidationError from "../../ValidationError.vue";
import store from "../../../Stores/Index";
import {
  getUsersInvitable,
  inviteUserLead,
} from "../../../Services/Admin/TeamService";
import router from "../../../Router/Index";
export default {
  props: ["modalId", "content"],
  components: { Modal, ValidationError },
  data() {
    return {
      user: "",
    };
  },
  computed: {
    ...mapGetters([
      "usersInvitable",
      "loadingUsersInvitable",
      "loadingStoreLeadInvitation",
    ]),
  },
  mounted() {
    getUsersInvitable();
  },
  methods: {
    async handleStoreLeadInvitation(e) {
      e.preventDefault();
      await inviteUserLead({
        team_id: this.content.id,
        user_id: this.user,
      });
      if (store.getters.withSuccess) {
        document.querySelector("#" + this.modalId).checked = false;
        router.push({ name: "AdminTeamIndex" });
        store.commit("setWithSuccess", "");
        this.user = "";
        store.commit("setValidationError", "");
      }
    },
  },
};
</script>