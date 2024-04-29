<template>
  <div>
    Register
    <form @submit="handleRegister">
      <div class="">
        <label for="name">Name</label>
        <input type="text" v-model="user.name" />
      </div>
      <div class="">
        <label for="email">Email</label>
        <input type="text" v-model="user.email" />
      </div>
      <div class="">
        <label for="password">Password</label>
        <input type="text" v-model="user.password" />
      </div>
      <div class=""><button class="btn bg-primary">Sign Up</button></div>
    </form>
  </div>
</template>
<script>
import { reactive, toRefs } from "@vue/reactivity";
import store from "../../Stores/Index";
import { useRouter } from "vue-router";
export default {
  setup(props) {
    const state = reactive({
      user: {
        name: "",
        email: "",
        password: "",
      },
    });
    const router = useRouter();
    const handleRegister = async (e) => {
      e.preventDefault();
      await store
        .dispatch("REGISTER", state.user)
        .then((result) => {
          router.push({ name: "Login" });
          // store.commit("SET_USER_DATA", result.data.token);
          // location.reload()
        })
        .catch((err) => {
          console.log(err);
        });
    };
    return {
      ...toRefs(state),
      handleRegister,
    };
  },
};
</script>