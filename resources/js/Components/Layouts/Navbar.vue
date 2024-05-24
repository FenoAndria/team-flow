<template>
  <div class="flex justify-between">
    <div class="flex space-x-4">
      <div v-for="link in links">
        <router-link :to="{ name: link.name }">
          <span class="">{{ link.tag }}</span>
        </router-link>
      </div>
    </div>
    <div class="">
      <span>{{ UserData.name }}</span>
      <button class="btn bg-red-200" @click="logout">Logout</button>
    </div>
  </div>
</template>
<script>
import { useRoute } from "vue-router";
import UserData from "../../Services/UserData";
import Badge from "../Badge.vue";
export default {
  props: ["links"],
  components: { Badge },
  setup(props) {
    const route = useRoute();
    const logout = () => {
      localStorage.setItem("vuex", "");
      location.reload();
    };
    return { UserData, route, logout };
  },
};
</script>