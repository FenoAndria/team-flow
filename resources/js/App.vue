<template>
  <div class="">
    <div>
      <div v-if="UserToken == ''">
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
      <div class="flex justify-between" v-else>
        <div class="flex space-x-4">
          <router-link :to="{ name: 'AppIndex' }">
            <span class="">Home</span>
          </router-link>
          <router-link :to="{ name: 'TodoIndex' }">
            <span class="">Todo</span>
          </router-link>
          <router-link :to="{ name: 'UserIndex' }">
            <span class="">Profile</span>
          </router-link>
        </div>
        <div class="">
          <span>{{ username }}</span>
          <button class="btn bg-red-200" @click="logout">Logout</button>
        </div>
      </div>
    </div>
    <router-view></router-view>
  </div>
</template>
<script>
import { useRoute } from "vue-router";
import UserToken from "./Services/UserToken";
import store from "./Stores/Index";
export default {
  setup(props) {
    const route = useRoute();
    const username = store.getters.USERNAME;
    const logout = () => {
      localStorage.setItem("vuex", "");
      location.reload();
    };
    return { UserToken, username, route, logout };
  },
};
</script>