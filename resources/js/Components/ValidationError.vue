<template>
  <div v-if="validationError">
    <div
      v-for="(err, errorsIndex) in validationError.errors"
      :key="errorsIndex"
    >
      <div class="" v-if="errorsIndex == column">
        <div v-for="(e, errIndex) in err" :key="errIndex">
          <div class="py-1 text-danger">
            <span class="bi bi-exclamation-circle"></span> {{ e }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "ValidationError",
  props: ["column"],
  computed: {
    ...mapGetters(["validationError"]),
  },
};
</script>