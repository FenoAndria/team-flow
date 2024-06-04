<template>
  <div class="h-screen flex justify-center items-center">
    <div class="w-1/3">
      <div class="shadow-md rounded-lg py-12 px-6 bg-primary text-white">
        <p class="text-2xl font-semibold text-center">Register</p>
        <hr class="my-1" />
        <form @submit="handleRegister">
          <div class="">
            <label for="name" class="font-semibold">Name</label>
            <input type="text" v-model="user.name" />
            <ValidationError column="name" />
          </div>
          <div class="">
            <label for="email" class="font-semibold">Email</label>
            <input type="text" v-model="user.email" />
            <ValidationError column="email" />
          </div>
          <div class="">
            <label for="password" class="font-semibold">Password</label>
            <input type="text" v-model="user.password" />
            <ValidationError column="password" />
          </div>
          <div class="mt-2">
            <button class="bg-info w-full">Sign Up</button>
          </div>
        </form>
        <router-link :to="{ name: 'Login' }" v-if="route.name !== 'Login'">
          <span class="font-semibold mt-4 hover:text-neutral hover:underline"
            >Login</span
          >
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
import { reactive, toRefs } from "@vue/reactivity";
import store from "../../Stores/Index";
import { register } from "../../Services/AuthServices";
import ValidationError from "../../Components/ValidationError.vue";
import { onMounted } from "@vue/runtime-core";
import { useRoute } from 'vue-router';
export default {
  components: { ValidationError },
  setup(props) {
    const state = reactive({
      user: {
        name: "",
        email: "",
        password: "",
      },
    });
    const route = useRoute();
    const handleRegister = async (e) => {
      e.preventDefault();
      register(state.user);
    };
    onMounted(() => store.commit("setValidationError", ""));
    return {
      ...toRefs(state),
      handleRegister,
      route
    };
  },
};
</script>