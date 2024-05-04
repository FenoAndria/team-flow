<template>
  <div v-if="validationError && validationError.error">
    <div class="bg-danger-600 rounded px-2 py-1 font-semibold text-white">
      {{ validationError.error }}
    </div>
  </div>
</template>
<script>
import { computed } from "@vue/runtime-core";
import { useStore } from "vuex";
export default {
  setup(props) {
    const store = useStore();
    const validationError = computed(() => store.getters.validationError);
    return {
      validationError,
    };
  },
};
</script>