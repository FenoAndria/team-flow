<template>
  <div>
    <Navbar role="Admin"/>
    <slot></slot>
  </div>
</template>
<script>
import Navbar from "../Layouts/Navbar.vue";
export default {
  components: { Navbar },
};
</script>