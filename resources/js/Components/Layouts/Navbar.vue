<template>
  <div class="flex justify-between">
    <div class="flex space-x-4" v-if="role == 'User'">
      <router-link :to="{ name: 'AppIndex' }">
        <span class="">Home</span>
      </router-link>
      <router-link :to="{ name: 'TodoIndex' }">
        <span class="">Todo</span>
        <Badge />
      </router-link>
      <router-link :to="{ name: 'UserIndex' }">
        <span class="">Profile</span>
      </router-link>
    </div>
    <div v-else>
      <router-link :to="{ name: 'AppIndex' }">
        <span class="">Home</span>
      </router-link>
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
  props: ["role"],
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