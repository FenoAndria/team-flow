<template>
  <div class="">
    <router-link v-for="page in this.previousPage" :to="{ name: page.name }">
      <span class="hover:underline hover:text-info">{{ page.tag }}</span> \
    </router-link>
    <span class="text-info underline">{{ this.currentPage }}</span>
  </div>
</template>
<script>
export default {
  props: ["currentPage", "previousPage"],
};
</script>