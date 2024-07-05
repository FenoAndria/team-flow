<template>
  <LeadLayout>
    <div class="flex space-x-2 justify-center">
      <div class="w-3/4">
        <Message
          :discussion="leadMessages"
          @sendMessage="sendMessage"
          v-if="leadMessages.length"
        />
      </div>
    </div>
  </LeadLayout>
</template>
<script>
import { mapGetters } from "vuex";
import LeadLayout from "../../../Components/Layouts/LeadLayout.vue";
import { getLeadMessages } from "../../../Services/Lead/LeadMessageService";
import store from "../../../Stores/Index";
import Message from "../../../Components/Layouts/Message/Message.vue";
export default {
  components: { LeadLayout, Message },
  data() {
    return {
      timeoutId: "",
    };
  },
  computed: {
    ...mapGetters(["loadingLeadMessages", "leadMessages"]),
  },
  async mounted() {
    await getLeadMessages();
    this.startPolling();
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
    sendMessage(content) {
      store.dispatch("sendLeadMessage", { content });
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