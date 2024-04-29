<template>
  <div class="">
    <div>
      <div v-if="UserToken == ''">
        <router-link :to="{ name: 'Login' }" v-if="route.name !== 'Login'">
          <button class="btn bg-blue-200">Login</button>
        </router-link>
        <router-link :to="{ name: 'Register' }" v-if="route.name !== 'Register'">
          <button class="btn bg-blue-200">Register</button>
        </router-link>
      </div>
      <div v-else>
        <button class="btn bg-red-200" @click="logout">Logout</button>
      </div>
    </div>
    <router-view></router-view>
  </div>
</template>
<script>
import { useRoute } from "vue-router";
import UserToken from "./Services/UserToken";
export default {
  setup(props) {
    const route = useRoute();
    const logout = () => {
      localStorage.setItem("vuex", "");
      location.reload();
    };
    return { UserToken, route, logout };
  },
};
</script>