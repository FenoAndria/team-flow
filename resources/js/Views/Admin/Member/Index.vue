<template>
  <AdminLayout>
    <div v-if="loadingMembers">
      <Loading />
    </div>
    <div v-else>
      <div v-if="members.length">
        <div class="my-card-container">
          <div class="my-card-3 list-content" v-for="member in members">
            <div class="flex justify-between">
              <div class="">
                <p class="text-primary text-xl font-semibold">
                  {{ member.profil.name }}
                </p>
                <p class="text-neutral text-sm">{{ member.email }}</p>
                <hr class="my-1" />
                <div class="text-sm" v-if="member.team_lead">
                    <p class="underline">Lead : </p>
                    <p><span class="uppercase">{{member.team_lead.name}}</span> Team</p>
                </div>
                <div class="text-sm" v-if="member.team_member && member.team_member.length">
                    <p class="underline">Member :</p>
                    <p  v-for="team in member.team_member"> <span class="uppercase">{{team.name}} </span></p>
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
export default {
  components: { AdminLayout, Loading },
  computed: {
    ...mapGetters(["members", "loadingMembers"]),
  },
  mounted() {
    getMembers();
  },
};
</script>