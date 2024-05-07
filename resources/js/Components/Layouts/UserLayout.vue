<template>
  <div>
    <Navbar role="User"/>
    <slot></slot>
  </div>
</template>
<script>
import Navbar from "../Layouts/Navbar.vue";
export default {
  components: { Navbar },
};
</script>