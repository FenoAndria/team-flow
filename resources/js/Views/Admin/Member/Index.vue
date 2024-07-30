<template>
  <AdminLayout pageTitle="Member list">
    <div v-if="loadingMembers">
      <Loading />
    </div>
    <div v-else>
      <Filter :filterTab="memberFilter" @filterItem="handleFilterMember" :count="filteredMember.length"/>
      <div v-if="filteredMember.length">
        <div class="my-card-container">
          <div class="my-card-3 list-content" v-for="member in filteredMember">
            <div class="flex justify-between">
              <div class="">
                <p class="text-primary text-xl font-semibold">
                  {{ member.profil.name }}
                </p>
                <p class="text-neutral text-sm">{{ member.email }}</p>
                <hr class="my-1" />
                <div class="text-sm" v-if="member.team_lead">
                  <p class="underline">Lead :</p>
                  <p>
                    <span class="uppercase">{{ member.team_lead.name }}</span>
                    Team
                  </p>
                </div>
                <div
                  class="text-sm"
                  v-if="member.team_member && member.team_member.length"
                >
                  <p class="underline">Member :</p>
                  <p v-for="team in member.team_member">
                    <span class="uppercase">{{ team.name }} </span>
                  </p>
                </div>
              </div>
              <div class="">
                <img
                  src="./../../../../../public/assets/Avatar.png"
                  class="avatar-user"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else>EMPTY</div>
    </div>
  </AdminLayout>
</template>
<script>
import { mapGetters } from "vuex";
import AdminLayout from "../../../Components/Layouts/AdminLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import { getMembers } from "../../../Services/Admin/MemberService";
import FilterMember from "../../../Components/Filter/FilterMember.vue";
import Filter from "../../../Components/Filter/Filter.vue";
import { memberFilter } from "../../../Services/Filter/AdminFilter";
export default {
  components: { AdminLayout, Loading, FilterMember,Filter },
  data() {
    return {
      filteredMember: [],
      memberFilter
    };
  },
  computed: {
    ...mapGetters(["members", "loadingMembers"]),
  },
  methods: {
    handleFilterMember(e) {
      switch (e.tag) {
        case "Team Lead":
          this.filteredMember = this.members.filter((item) => item.team_lead);
          break;
        case "Team Member":
          this.filteredMember = this.members.filter(
            (item) => item.team_member && item.team_member.length
          );
          break;
        case "Others":
          this.filteredMember = this.members.filter(
            (item) => !(item.team_member && item.team_member.length) && !item.team_lead
          );
          break;
        default:
          this.filteredMember = this.members;
          break;
      }
    },
  },
  mounted() {
    getMembers();
  },
};
</script>