<template>
  <div>
    Login
    <form @submit="handleLogin">
      <UnauthenticatedError />
      <div class="">
        <label for="email">Email</label>
        <input type="text" v-model="user.email" />
        <ValidationError column="email" />
      </div>
      <div class="">
        <label for="password">Password</label>
        <input type="text" v-model="user.password" />
        <ValidationError column="password" />
      </div>
      <div class="">
        <button class="btn bg-primary">Login</button>
      </div>
    </form>
  </div>
</template>
<script>
import { reactive, toRefs } from "@vue/reactivity";
import store from "../../Stores/Index";
import { login } from "../../Services/AuthServices";
import ValidationError from "../../Components/ValidationError.vue";
import UnauthenticatedError from "../../Components/UnauthenticatedError.vue";
import { onMounted } from "@vue/runtime-core";
export default {
  components: { ValidationError, UnauthenticatedError },
  setup(props) {
    const state = reactive({
      user: {
        email: "gutmann.aron@example.net",
        password: "password",
      },
    });
    const handleLogin = (e) => {
      e.preventDefault();
      store.commit("setValidationError", "");
      login(state.user);
    };
    onMounted(() => store.commit("setValidationError", ""));
    return {
      ...toRefs(state),
      handleLogin,
    };
  },
};
</script>