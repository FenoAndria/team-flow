<template>
  <UserLayout>
    <div class="flex space-x-2">
      <div class="w-1/4">
        <div class="p-4 bg-white rounded shadow border">
          <h3 class="text-xl text-primary font-semibold border-b mb-1">
            Discussions
          </h3>
          <div id="discussions-container">
            <div v-for="team in memberTeams">
              <div
                class="discussion-team"
                :class="{ 'discussion-active': team == memberTeams[0] }"
                @click="changeDiscussion(team)"
                :id="'discussion-team-' + team.id"
              >
                {{ team.name }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-3/4">
        <Loading v-if="loading" />
        <Message
          :discussion="discussion"
          :loading="loading"
          @sendMessage="sendTeamMessage"
        />
      </div>
    </div>
  </UserLayout>
</template>
<script>
import { mapGetters } from "vuex";
import UserLayout from "../../../Components/Layouts/UserLayout.vue";
import Loading from "../../../Components/Layouts/Loading.vue";
import Message from "../../../Components/Layouts/Message/Message.vue";

import { getMemberTeams } from "../../../Services/Member/MemberTeamService";
import { getTeamMessages } from "../../../Services/Member/MemberMessageService";
import store from "../../../Stores/Index";
export default {
  components: { UserLayout, Message, Loading },
  data() {
    return {
      discussion: "",
      currentTeam: "",
      timeoutId: "",
      loading: false,
    };
  },
  computed: {
    ...mapGetters([
      "memberTeams",
      "loadingMemberTeams",
      "loadingTeamMessages",
      "teamMessages",
    ]),
  },
  methods: {
    async changeDiscussion(team) {
      this.loading = true;
      let discussionTeam = document.getElementsByClassName("discussion-team");
      for (const iterator of discussionTeam) {
        iterator.classList.remove("discussion-active");
      }
      document
        .getElementById("discussion-team-" + team.id)
        .classList.add("discussion-active");
      await getTeamMessages(team);
      this.loading = false;
      this.discussion = this.teamMessages;
      this.currentTeam = team;
    },
    async sendTeamMessage(message) {
      await store.dispatch("sendTeamMessage", {
        team_id: this.currentTeam.id,
        content: message,
      });
    },
    poll() {
      store
        .dispatch("startPolling")
        .then(async (result) => {
          if (result.data.updated) {
            await getTeamMessages(this.currentTeam);
            this.discussion = this.teamMessages;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    startPolling() {
      this.poll();
      this.timeoutId = setInterval(this.poll, 2000);
    },
  },
  async mounted() {
    await getMemberTeams();
    this.changeDiscussion(this.memberTeams[0]);
    this.startPolling();
  },
  beforeUnmount() {
    if (this.timeoutId) {
      clearInterval(this.timeoutId);
    }
  },
};
</script>
<style lang="postcss">
#discussions-container {
  height: calc(100vh - 150px);
  scrollbar-color: #3f51b5 #f1f1f1;
  scrollbar-width: thin;
  @apply space-y-1 overflow-y-auto pr-1;
}
.discussion-team {
  @apply p-3 rounded shadow-sm border hover:bg-neutral-100 cursor-pointer font-semibold uppercase;
}
#discussions-container .discussion-active {
  @apply bg-primary text-white;
}
</style>