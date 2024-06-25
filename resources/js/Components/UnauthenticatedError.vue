<template>
  <div v-if="validationError && validationError.error">
    <div class="py-1 text-danger">
      <span class="bi bi-exclamation-circle"></span> {{ validationError.error }}
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(['validationError'])
  },
  
};
</script>