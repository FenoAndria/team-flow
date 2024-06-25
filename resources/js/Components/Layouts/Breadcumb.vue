<template>
  <div class="text-info">
    <router-link v-for="page in this.previousPage" :to="{ name: page.name }">
      <span class="hover:underline hover:text-info">{{ page.tag }}</span> \
    </router-link>
    <span class="font-semibold underline">{{ this.currentPage }}</span>
  </div>
</template>
<script>
export default {
  props: ["currentPage", "previousPage"],
};
</script>