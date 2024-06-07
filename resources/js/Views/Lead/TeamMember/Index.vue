<template>
  <LeadLayout>
    <div>
      <div v-if="loadingTeamMember">
        <span class="loading"></span>
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
                      {{ dayjs().diff(item.profil.birth_date, "year") }} years
                    </p>
                    <p class="text-neutral text-sm">
                      {{ item.profil.bio }}
                    </p>
                    <hr class="my-1">
                    <p class="text-neutral text-sm">
                      Member since {{ dayjs(item.created_at).format('DD MMM YYYY') }}
                    </p>
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
import { computed, onMounted } from "@vue/runtime-core";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { getTeamMember } from "../../../Services/Lead/LeadTeamService";
import { useStore } from "vuex";
import dayjs from "dayjs";
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
      dayjs,
    };
  },
};
</script>