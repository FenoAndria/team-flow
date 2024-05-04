<template>
  <div>
    Register
    <form @submit="handleRegister">
      <div class="">
        <label for="name">Name</label>
        <input type="text" v-model="user.name" />
        <ValidationError column="name" />
      </div>
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
      <div class=""><button class="btn bg-primary">Sign Up</button></div>
    </form>
  </div>
</template>
<script>
import { reactive, toRefs } from "@vue/reactivity";
import store from "../../Stores/Index";
import { register } from '../../Services/AuthServices';
import ValidationError from "../../Components/ValidationError.vue";
import { onMounted } from '@vue/runtime-core';
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
    const handleRegister = async (e) => {
      e.preventDefault();
      register(state.user)
    };
    onMounted(() => store.commit("setValidationError", ""));
    return {
      ...toRefs(state),
      handleRegister,
    };
  },
};
</script>