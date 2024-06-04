<template>
  <div class="">
    <router-view></router-view>
  </div>
</template>
<script>
import { useRoute } from "vue-router";
import UserData from "./Services/UserData";
import Badge from "./Components/Badge.vue";

export default {
  components: { Badge },
  setup(props) {
    const route = useRoute();
    const logout = () => {
      localStorage.setItem("vuex", "");
      location.reload();
    };
    return { UserData, route, logout };
  },
};
</script>