<template>
  <div class="">
    <div>
      <div v-if="!UserData ">
        <router-link :to="{ name: 'Login' }" v-if="route.name !== 'Login'">
          <button class="btn bg-blue-200">Login</button>
        </router-link>
        <router-link
          :to="{ name: 'Register' }"
          v-if="route.name !== 'Register'"
        >
          <button class="btn bg-blue-200">Register</button>
        </router-link>
      </div>
    </div>
      <router-view></router-view>
  </div>
</template>
<script>
import { useRoute } from "vue-router";
import UserData from "./Services/UserData";
import Badge from "./Components/Badge.vue";

export default {
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