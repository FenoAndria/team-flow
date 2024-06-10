<template>
  <Modal :modalId="modalId" :content="content">
    <p class="text-xl border-b">Invite user</p>
    <div v-if="this.loadingUsersInvited">
      <span class="loading"></span>
    </div>
    <div v-else>
      <form @submit="handleInviteUser" v-if="this.usersInvited">
        <ValidationError column="user_id" />
        <div v-for="item in this.usersInvited">
          <label for="" class="flex items-center space-x-2 cursor-pointer">
            <input
              type="radio"
              v-model="user"
              :value="item.id"
              class="radio radio-xs radio-primary"
            />
            <span class="text-lg text-dark">{{ item.profil.name }}</span>
          </label>
        </div>
        <div class="">
          <div class="flex justify-center" v-if="loadingInviteUser">
            <span class="loading loading-dots"></span>
          </div>
          <button class="bg-info w-full mt-2" v-else>Invite</button>
        </div>
      </form>
    </div>
  </Modal>
</template>
<script>
import { mapGetters } from "vuex";
import {
  getTeamInvitation,
  getUsersInvitable,
  inviteUser,
} from "../../Services/Lead/TeamInvitationService";
import store from "../../Stores/Index";
import ValidationError from "../ValidationError.vue";
import Modal from "./Modal.vue";
export default {
  props: ["modalId", "content"],
  components: { Modal, ValidationError },
  data() {
    return {
      user: "",
    };
  },
  computed: {
    ...mapGetters(["usersInvited", "loadingUsersInvited", "loadingInviteUser"]),
  },
  methods: {
    async handleInviteUser(e) {
      e.preventDefault();
      await inviteUser(this.user);
      if (store.getters.withSuccess) {
        document.querySelector("#" + this.modalId).checked = false;
        getTeamInvitation();
        store.commit("setWithSuccess", "");
        this.user = "";
        store.commit("setValidationError", "");
      }
    },
  },
  async mounted() {
    await getUsersInvitable();
  },
};
</script>