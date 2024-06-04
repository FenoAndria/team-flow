<template>
  <input type="checkbox" :id="modalId" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box">
      <p class="text-xl">Invite user</p>
      <div v-if="this.loadingUsersInvited">
        <span class="loading"></span>
      </div>
      <div v-else>
        <form @submit="handleInviteUser" v-if="this.usersInvited">
          <div v-for="item in this.usersInvited">
            <label for="" class=""
              >{{ item.profil.name }}
              <input type="radio" v-model="user" :value="item.id" class="radio"
            /></label>
          </div>
          <button class="btn btn-primary text-white">Invite</button>
        </form>
      </div>
      <div class="modal-action">
        <label
          :for="modalId"
          class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
        >
          ✕
        </label>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import {
  getTeamInvitation,
  getUsersInvitable,
  inviteUser,
} from "../../Services/Lead/TeamInvitationService";
export default {
  props: ["modalId", "content"],
  data() {
    return {
      user: "",
    };
  },
  computed: {
    ...mapGetters(["usersInvited", "loadingUsersInvited"]),
  },
  methods: {
    async handleInviteUser(e) {
      e.preventDefault();
      await inviteUser(this.user);
      getTeamInvitation();
      document.querySelector("#" + this.modalId).checked = false;
    },
  },
  async mounted() {
    await getUsersInvitable();
  },
};
</script>