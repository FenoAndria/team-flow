<template>
  <div class="p-4 bg-white rounded shadow border">
    <div class="message-container" ref="messageContainer" v-if="discussion">
      <div class="" v-for="message in discussion">
        <div class="flex">
          <div :class="{ 'w-1/2': message.sender.id == UserData.id }"></div>
          <div
            class="message-body"
            :class="{
              'message-owner-you': message.sender.id == UserData.id,
            }"
          >
            <p class="message-sender">{{ message.sender.name }}</p>
            <p class="message-content">{{ message.content }}</p>
            <p class="message-sended-at">
              {{ $dayjs(message.created_at).format("DD-MM-YYYY HH:mm:ss") }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div>
      <form @submit="handleSendMessage" class="message-send-input">
        <input type="text" v-model="message" />
        <button><span class="bi bi-send"></span></button>
      </form>
    </div>
  </div>
</template>
<script>
import UserData from "../../../Services/UserData";
export default {
  props: ["discussion"],
  data() {
    return {
      message: "Fugiat dolore laboris ut ex magna irure culpa velit duis adipisicing aliquip Lorem ex aliquip.",
      UserData,
    };
  },
  methods: {
    handleSendMessage(e) {
      e.preventDefault();
      if (this.message.trim()) {
        this.$emit("sendMessage", this.message);
      }
    },
    scrollToEnd() {
      const container = this.$refs.messageContainer;
      container.scrollTop = container.scrollHeight;
    },
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