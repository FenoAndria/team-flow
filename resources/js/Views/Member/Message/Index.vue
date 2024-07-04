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
                :id="'discussion-team-' + team.team.id"
              >
                {{ team.team.name }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-3/4">
        <div class="p-4 bg-white rounded shadow border">
          <div class="message-container" ref="messageContainer">
            <div class="" v-for="message in discussion">
              <div class="flex">
                <div
                  :class="{ 'w-1/2': message.sender.id == UserData.id }"
                ></div>
                <div
                  class="message-body"
                  :class="{
                    'message-owner-you': message.sender.id == UserData.id,
                  }"
                >
                  <p class="message-sender">{{ message.sender.name }}</p>
                  <p class="message-content">{{ message.content }}</p>
                  <p class="message-sended-at">
                    {{
                      $dayjs(message.created_at).format("DD-MM-YYYY HH:mm:ss")
                    }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <form @submit="sendTeamMessage" class="message-send-input">
              <input type="text" v-model="message" />
              <button><span class="bi bi-send"></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </UserLayout>
</template>
<script>
import { mapGetters } from "vuex";
import UserLayout from "../../../Components/Layouts/UserLayout.vue";
import { getMemberTeams } from "../../../Services/Member/MemberTeamService";
import { getTeamMessages } from "../../../Services/Member/MemberMessageService";
import UserData from "../../../Services/UserData";
import store from "../../../Stores/Index";
export default {
  components: { UserLayout },
  data() {
    return {
      discussion: "",
      message:
        "Qui velit est consequat dolor magna deserunt eiusmod elit enim elit deserunt elit anim eu.",
      UserData,
      currentTeam: "",
    };
  },
  computed: {
    ...mapGetters(["memberTeams", "loadingMemberTeams", "teamMessages"]),
  },
  methods: {
    async changeDiscussion(team) {
      let discussionTeam = document.getElementsByClassName("discussion-team");
      for (const iterator of discussionTeam) {
        iterator.classList.remove("discussion-active");
      }
      document
        .getElementById("discussion-team-" + team.team.id)
        .classList.add("discussion-active");
      await getTeamMessages(team);
      this.discussion = this.teamMessages;
      this.currentTeam = team;
    },
    async sendTeamMessage(e) {
      e.preventDefault();
      await store.dispatch("sendTeamMessage", {
        team_id: this.currentTeam.team.id,
        content: this.message,
      });
    },
    poll() {
      store
        .dispatch("startPolling")
        .then(async (result) => {
          if (result.data.updated) {
            console.log(result.data.updated);
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
    scrollToEnd() {
      const container = this.$refs.messageContainer;
      container.scrollTop = container.scrollHeight;
    },
  },
  async mounted() {
    await getMemberTeams();
    this.changeDiscussion(this.memberTeams[0]);
    this.startPolling();
  },
  watch: {
    discussion() {
      this.$nextTick(() => {
        this.scrollToEnd();
      });
    },
  },
};
</script>
<style lang="postcss">
#discussions-container {
  height: calc(100vh - 130px);
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