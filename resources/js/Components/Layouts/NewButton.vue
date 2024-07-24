<template>
  <label id="new-button-container" :for="forLabel">
    <span class="bi bi-plus-circle"></span>
    <span>{{ tagLabel }}</span>
  </label>
</template>
<script>
export default {
  props: ["forLabel", "tagLabel"],
};
</script>
<style lang="postcss">
#new-button-container {
  @apply fixed bottom-4 right-4 text-xl space-x-1 rounded-lg bg-secondary py-2 px-4 cursor-pointer shadow hover:bg-primary transition-all text-white delay-100;
}
</style>