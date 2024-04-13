<template>
  <div
    class="
      h-screen
      bg-primary
      flex flex-col
      space-y-4
      items-center
      justify-center
    "
  >
    <h1 class="text-4xl text-secondary">Oups! NOT FOUND</h1>
    <router-link :to="{ name: 'AppIndex' }">
      <button class=" bg-white"
        >Go back</button
      ></router-link
    >
  </div>
</template>
<script>
export default {
  name: "NotFound",
  
};
</script>