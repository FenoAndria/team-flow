<template>
  <div class="h-screen flex justify-center items-center">
    <div class="w-1/3">
      <div class="shadow-md rounded-lg py-12 px-6 bg-primary text-white">
        <p class="text-2xl font-semibold text-center">Login</p>
        <hr class="my-1" />
        <form @submit="handleLogin">
          <UnauthenticatedError />
          <div class="">
            <label for="email" class="font-semibold">Email</label>
            <input type="text" v-model="user.email" />
            <ValidationError column="email" />
          </div>
          <div class="">
            <label for="password" class="font-semibold">Password</label>
            <input type="password" v-model="user.password" />
            <ValidationError column="password" />
          </div>
          <div class="mt-2">
            <div class="flex justify-center" v-if="loadingAuth">
              <span class="loading loading-dots"></span>
            </div>
            <button class="bg-info w-full" v-else>Sign In</button>
          </div>
        </form>
        <router-link
          :to="{ name: 'Register' }"
          v-if="route.name !== 'Register'"
        >
          <span class="text-lg font-semibold mt-4 hover:text-neutral hover:underline"
            >Register</span
          >
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
import { reactive, toRefs } from "@vue/reactivity";
import store from "../../Stores/Index";
import { login } from "../../Services/AuthServices";
import ValidationError from "../../Components/ValidationError.vue";
import UnauthenticatedError from "../../Components/UnauthenticatedError.vue";
import { computed, onMounted } from "@vue/runtime-core";
import { useRoute } from "vue-router";
export default {
  components: { ValidationError, UnauthenticatedError },
  setup(props) {
    const state = reactive({
      user: {
        email: "gutmann.aron@example.net",
        password: "password",
      },
    });
    const route = useRoute();
    const loadingAuth = computed(() => store.getters.loadingAuth);
    const handleLogin = async (e) => {
      e.preventDefault();
      store.commit("setValidationError", "");
      await login(state.user);
    };
    onMounted(() => store.commit("setValidationError", ""));
    return {
      ...toRefs(state),
      handleLogin,
      route,
      loadingAuth,
    };
  },
};
</script>