<template>
  <div id="sidebar">
    <div id="sidebar-brand">
      <p>Team <span class="text-secondary">flow</span></p>
    </div>
    <div id="sidebar-link-container">
      <div v-for="link in sidebarLinks">
        <router-link :to="{ name: link.name }">
          <div class="sidebar-link" :class="{ active: isLinkActive(link) }">
            <span class="sidebar-link-icon" :class="link.icon"></span>
            <span>{{ link.tag }}</span>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["sidebarLinks"],
  methods: {
    isLinkActive(routeLink) {
      if (routeLink) {
        return routeLink.activeClass.find((item) => item == this.$route.name);
      }
    },
  },
};
</script>
<style lang="postcss">
#sidebar {
  width: 225px;
  z-index: 2;
  @apply h-screen bg-primary text-white fixed shadow border-r-2 border-gray-300;
}
#sidebar-brand {
  height: 60px;
  @apply text-2xl uppercase font-semibold flex items-center justify-center;
}
#sidebar-link-container {
  height: calc(100% - 60px);
  @apply px-4 w-full space-y-2 mt-8;
}
.sidebar-link {
  @apply flex  items-center space-x-1 text-white rounded py-2 px-4  font-semibold transition-all delay-75 cursor-pointer;
}
.sidebar-link.active,
.sidebar-link:hover {
  @apply bg-white text-secondary pl-6 ;
}
.sidebar-link:hover .sidebar-link-icon, .sidebar-link.active .sidebar-link-icon{
  @apply text-base
}
.sidebar-link-icon{
  @apply text-sm 
}
</style>