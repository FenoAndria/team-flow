<template>
  <Modal :modalId="modalId" :content="content">
    <p class="text-xl border-b">Create team</p>
    <form @submit="handleStoreTeam">
      <div class="">
        <label for="name">Name</label>
        <input type="text" v-model="team.name" />
        <ValidationError column="name" />
      </div>
      <div class="">
        <div class="flex justify-center" v-if="loadingStoreTeam">
          <span class="loading loading-dots"></span>
        </div>
        <button class="bg-info w-full mt-2" v-else>Save</button>
      </div>
    </form>
  </Modal>
</template>
<script>
import Modal from "../Modal.vue";
import { mapGetters } from "vuex";
import { getTeams, storeTeam } from "../../../Services/Admin/TeamService";
import store from "../../../Stores/Index";
import ValidationError from "../../ValidationError.vue";
export default {
  props: ["modalId", "content"],
  components: { Modal, ValidationError },
  data() {
    return {
      team: {
        name: "",
      },
    };
  },
  computed: {
    ...mapGetters(["loadingStoreTeam"]),
  },
  methods: {
    async handleStoreTeam(e) {
      e.preventDefault();
      await storeTeam(this.team);
      if (store.getters.withSuccess) {
        document.querySelector("#" + this.modalId).checked = false; // hide modal
        await getTeams(); // reload team list
        store.commit("setWithSuccess", ""); // reinitialize withSuccess state
        this.team = ""; // reinitialize team :)
        store.commit("setValidationError", ""); // reinitialize validationError state
      }
    },
  },
};
</script>