<template>
  <div>
    User Profile 
    <div class="" v-if="loadingUser"><span>LOADING...</span></div>
    <div v-else>
      <div v-if="user && user.profil">
        <p>Name : {{ user.profil.name }}</p>
        <p>Email : {{ user.email }}</p>
        <p>Birth date : {{ user.profil.birth_date }}</p>
        <p>Gender : {{ user.profil.gender }}</p>
        <p>Bio : {{ user.profil.bio }}</p>
        <hr>
        <router-link :to="{name:'UserEdit'}">Edit</router-link>
      </div>
    </div>
  </div>
</template>
<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import { getUser } from "../../Services/UserServices";
export default {
  setup(props) {
    const store = useStore();
    const loadingUser = computed(() => store.getters.loadingUser);
    const user = computed(() => store.getters.user);
    onMounted(async () => {
      await getUser();
    });
    return {
      loadingUser,
      user,
    };
  },
};
</script>