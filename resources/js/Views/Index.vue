<template>
  <div v-if="!UserData">
    <div class="h-screen flex justify-center items-center">
      <div class="w-1/3">
        <div class="shadow-md rounded-lg py-12 px-6 bg-primary text-white">
          <p class="text-center text-3xl">Welcome !</p>
          <hr class="my-2" />
          <div class="text-lg space-y-2">
            <div class="">
              <router-link :to="{ name: 'Login' }">
                <button class="w-full bg-info">Login</button>
              </router-link>
            </div>
            <div class="">
              <router-link :to="{ name: 'Register' }">
                <button class="w-full bg-success">Register</button>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else>HOME</div>
</template>
<script>
import { useRoute } from "vue-router";
import UserData from "../Services/UserData";
export default {
  setup(props) {
    const route = useRoute();
    return { route, UserData };
  },
};
</script>