<template>
  <UserLayout>
    <div>
      <div v-if="loadingMemberTeams">
        <Loading />
      </div>
      <div v-else>
        <div class="my-card-container" v-if="memberTeams.length">
          <div
            class="my-card list-content my-card-3"
            v-for="item in memberTeams"
          >
            <div class="">
              <p class="uppercase font-semibold text-primary text-lg">
                {{ item.name }}
              </p>
              <p class="text-sm space-x-1 font-semibold">
                <span class="bi bi-person-workspace"></span>
                <span class="">{{ item.lead.name }}</span>
              </p>
              <p class="text-sm space-x-1 font-semibold">
                <span class="bi bi-calendar-event"></span>
                <span class="">{{
                  $dayjs(item.created_at).format("DD-MM-YYYY")
                }}</span>
              </p>
              <router-link
                :to="{ name: 'TeamShow', params: { team: item.id } }"
                class="text-info hover:underline"
                >More...</router-link
              >
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
import { getMemberTeams } from "../../../Services/Member/MemberTeamService";
export default {
  components: { UserLayout, Loading },
  computed: {
    ...mapGetters(["memberTeams", "loadingMemberTeams"]),
  },
  mounted() {
    getMemberTeams();
  },
};
</script>