<template>
  <div>
    Login
    <form @submit="handleLogin">
      <div class="">
        <label for="email">Email</label>
        <input type="text" v-model="user.email" />
      </div>
      <div class="">
        <label for="password">Password</label>
        <input type="text" v-model="user.password" />
      </div>
      <div class=""><button class="btn bg-primary">Login</button></div>
    </form>
  </div>
</template>
<script>
import { reactive, toRefs } from "@vue/reactivity";
import store from "../../Stores/Index";
export default {
  setup(props) {
    const state = reactive({
      user: {
        email: "gutmann.aron@example.net",
        password: "password",
      },
    });
    const handleLogin = (e) => {
      e.preventDefault();
      store
        .dispatch("LOGIN", state.user)
        .then((result) => {
          store.commit("SET_USER_DATA", result.data.token);
          location.reload()
        })
        .catch((err) => {
          console.log(err);
        });
    };
    return {
      ...toRefs(state),
      handleLogin,
    };
  },
};
</script>