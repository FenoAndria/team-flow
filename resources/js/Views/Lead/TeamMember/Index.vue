<template>
  <LeadLayout>
    <div>Lead - team member index</div>
    <div>
      <div v-if="loadingTeamMember">
        <span class="loading"></span>
      </div>
      <div v-else>
        <div v-if="teamMember.length">
          <div class="list-container">
            <div class="list-content" v-for="item in teamMember">
              <div class="flex justify-between">
                <div>
                  <p class="">Name : {{ item.profil.name }}</p>
                  <p class="">Birth date : {{ item.profil.birth_date }}</p>
                  <p class="">Bio : {{ item.profil.bio }}</p>
                  <p class="">Gender : {{ item.profil.gender }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else>Empty</div>
      </div>
    </div>
  </LeadLayout>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { getTeamMember } from "../../../Services/Lead/LeadTeamService";
import { useStore } from "vuex";
import statusColor from "../../../Services/statusColor";
export default {
  components: { LeadLayout },
  setup(props) {
    const store = useStore();
    const teamMember = computed(() => store.getters.teamMember);
    const loadingTeamMember = computed(() => store.getters.loadingTeamMember);

    onMounted(async () => {
      await getTeamMember();
    });
    return {
      teamMember,
      loadingTeamMember,
      statusColor,
    };
  },
};
</script>