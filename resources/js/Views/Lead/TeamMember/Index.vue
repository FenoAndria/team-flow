<template>
  <LeadLayout  pageTitle="Team member list">
    <div>
      <div v-if="loadingTeamMember">
        <Loading />
      </div>
      <div v-else>
        <div v-if="teamMember.length">
          <div class="list-container">
            <div class="w-1/3 px-1 mb-2" v-for="item in teamMember">
              <div class="list-content">
                <div class="flex justify-between">
                  <div>
                    <p class="text-primary text-xl font-semibold">
                      {{ item.profil.name }}
                    </p>
                    <p class="text-neutral text-sm">{{ item.email }}</p>
                    <p class="text-neutral text-sm">
                      {{ item.profil.bio }}
                    </p>
                    <hr class="my-1" />
                  </div>
                  <div>
                    <img
                      src="./../../../../../public/assets/Avatar.png"
                      class="avatar-user"
                    />
                  </div>
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
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import { getTeamMember } from "../../../Services/Lead/LeadTeamService";
import { mapGetters } from "vuex";
export default {
  components: { LeadLayout, Loading },
  computed: {
    ...mapGetters(["teamMember", "loadingTeamMember"]),
  },
  mounted() {
    getTeamMember();
  },
};
</script>