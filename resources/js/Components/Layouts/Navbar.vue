<template>
  <div
    class="flex justify-between items-center px-4 py-2 shadow-md"
    id="navbar"
  >
    <div class=""></div>
    <div class="flex items-center space-x-12">
      <div class="flex space-x-2">
        <div v-for="link in navbarLinks">
          <router-link :to="{ name: link.name }">
            <div class="navlink" :class="{ active: isLinkActive(link) }">
              <span :class="link.tag"></span>
            </div>
          </router-link>
        </div>
      </div>
      <div class="flex items-center">
        <div class="flex items-center space-x-1">
          <img
            src="./../../../../public/assets/Avatar.png"
            class="avatar-navbar"
          />
          <span class="font-bold text-primary pr-2">{{ UserData.name }} </span>
        </div>
        <div class="">
          <button class="bg-neutral" @click="logout">
            <i class="bi bi-power"></i> Logout
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { useRoute } from "vue-router";
import UserData from "../../Services/UserData";
export default {
  props: ["navbarLinks"],
  setup(props) {
    const route = useRoute();
    const logout = () => {
      localStorage.setItem("vuex", "");
      location.reload();
    };
    const isLinkActive = (routeLink) => {
      if (routeLink) {
        return routeLink.activeClass.find((item) => item == route.name); // Verify current URL match to route.name
      }
    };
    return { UserData, route, logout, isLinkActive };
  },
};
</script>
<style lang="postcss">
#navbar {
  padding-left: 240px;
  height: 60px;
  @apply w-full fixed bg-white;
}
</style>