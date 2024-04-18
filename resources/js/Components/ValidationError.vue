<template>
  <div v-if="validationError">
    <div
      v-for="(err, errorsIndex) in validationError.errors"
      :key="errorsIndex"
    >
      <div class="" v-if="errorsIndex == column">
        <div v-for="(e, errIndex) in err" :key="errIndex">
          <div class="bg-danger-600 rounded px-2 py-1 font-semibold text-white">
            {{ e }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { computed } from "@vue/runtime-core";
import { useStore } from "vuex";
export default {
  name: "ValidationError",
  props: ["column"],
  setup(props) {
    const store = useStore();
    const validationError = computed(() => store.getters.validationError);
    return {
      validationError,
    };
  },
};
</script>