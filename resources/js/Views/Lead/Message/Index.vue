<template>
  <LeadLayout>
    <div class="flex space-x-2">
      <div class="w-2/3">
        <div class="p-4 bg-white rounded shadow border">
          <div class="message-container" ref="messageContainer">
            <div class="" v-for="message in leadMessages">
              <div class="flex">
                <div
                  :class="{ 'w-1/2': message.sender.name == UserData.name }"
                ></div>
                <div
                  class="message-body"
                  :class="{
                    'message-owner-you': message.sender.name == UserData.name,
                  }"
                >
                  <p class="message-sender">{{ message.sender.name }}</p>
                  <p class="message-content">{{ message.content }}</p>
                  <p class="message-sended-at">
                    {{ $dayjs(message.created_at).format("DD-MM-YYYY H:m") }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <form @submit="sendMessage" class="message-send-input">
              <input type="text" v-model="message" />
              <button><span class="bi bi-send"></span></button>
            </form>
          </div>
        </div>
      </div>
      <div class="w-1/3">
        <div class="list-content">
          <p>Team member</p>
          <div v-if="loadingLeadMessages">Loading...</div>
          <div v-else>
            {{ leadMessages.length }}
          </div>
        </div>
      </div>
    </div>
  </LeadLayout>
</template>
<script>
import { mapGetters } from "vuex";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { getLeadMessages } from "../../../Services/Lead/LeadMessageService";
import store from "../../../Stores/Index";
import UserData from "../../../Services/UserData";
export default {
  components: { LeadLayout },
  data() {
    return {
      message:
        "Qui velit est consequat dolor magna deserunt eiusmod elit enim elit deserunt elit anim eu.",
      messagesTab: [],
      getLeadMessages: [
        {
          content: "Qui pariatur id nisi elit aliquip.",
          sender: "Others",
          created_at: "2024-06-28T07:23:09.000000Z",
        },
        {
          content:
            "Laboris aliqua nostrud voluptate nulla incididunt cillum dolor dolor dolore reprehenderit anim cupidatat.",
          sender: "You",
          created_at: "2024-06-28T07:23:09.000000Z",
        },
        {
          content:
            "Qui pariatur id nisi elit aliquip.Do excepteur commodo elit proident enim ea. Eiusmod labore anim fugiat tempor amet cupidatat est cupidatat qui laborum non. Sit sunt nisi adipisicing tempor aute do consequat ea deserunt. ",
          sender: "Others",
          created_at: "2024-06-28T07:23:09.000000Z",
        },
        {
          content:
            "Ut sint consequat ex excepteur occaecat mollit in ullamco. Ut magna labore labore excepteur non aliqua qui minim id excepteur id esse eu consequat. Nulla cupidatat culpa nostrud veniam Lorem aute amet proident.",
          sender: "Others",
          created_at: "2024-06-28T07:23:09.000000Z",
        },
        {
          content:
            "Excepteur sunt voluptate pariatur nostrud amet quis in amet occaecat et ex cupidatat.Excepteur veniam cupidatat adipisicing cupidatat labore.",
          sender: "You",
          created_at: "2024-06-28T07:23:09.000000Z",
        },
      ],
      timeoutId: "",
      UserData,
    };
  },
  computed: {
    ...mapGetters(["loadingLeadMessages", "leadMessages"]),
  },
  mounted() {
    getLeadMessages();
    this.startPolling();
    this.scrollToEnd();
  },
  beforeUnmount() {
    if (this.timeoutId) {
      clearInterval(this.timeoutId);
    }
  },
  methods: {
    poll() {
      store
        .dispatch("startPolling")
        .then((result) => {
          this.messagesTab = result.data;
          if (result.data.updated) {
            getLeadMessages();
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
    sendMessage(e) {
      e.preventDefault();
      store.dispatch("sendMessage", { team_id: 1, content: this.message });
    },
    scrollToEnd() {
      const container = this.$refs.messageContainer;
      container.scrollTop = container.scrollHeight;
    },
  },
  watch: {
    leadMessages() {
      this.$nextTick(() => {
        this.scrollToEnd();
      });
    },
  },
};
</script>
<style lang="postcss">
.message-container {
  height: calc(100vh - 150px);
  scrollbar-color: #3f51b5 #f1f1f1;
  scrollbar-width: thin;
  @apply space-y-2 overflow-y-auto pr-1;
}
.message-body {
  @apply w-1/2 p-2 rounded-lg border shadow;
}
.message-sender {
  @apply text-sm text-neutral font-semibold;
}
.message-sended-at {
  @apply message-sender;
}
.message-owner-you {
  @apply bg-neutral-200;
}
.message-send-input {
  @apply mt-2 flex space-x-1;
}
.message-send-input input {
  @apply shadow;
}
.message-send-input button {
  @apply bg-primary;
}
</style>