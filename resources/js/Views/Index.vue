<template>
  <div v-if="!UserData">
    <div class="h-screen flex justify-center items-center">
      <div class="w-1/3">
        <div class="shadow-md rounded-lg py-12 px-6 bg-primary text-white">
          <p class="text-center text-4xl font-semibold">
            TEAM <span class="text-secondary">FLOW</span>
          </p>
          <p class="text-center text-2xl">Welcome !</p>
          <hr class="my-2" />
          <div class="text-xl flex space-x-2">
            <div class="w-1/2">
              <router-link :to="{ name: 'Login' }">
                <button
                  class="
                    w-full
                    bg-secondary
                    text-white
                    hover:bg-opacity-95
                    py-2
                  "
                >
                  Login
                </button>
              </router-link>
            </div>
            <div class="w-1/2">
              <router-link :to="{ name: 'Register' }">
                <button
                  class="
                    w-full
                    bg-white
                    text-secondary
                    hover:bg-opacity-95
                    py-2
                  "
                >
                  Register
                </button>
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