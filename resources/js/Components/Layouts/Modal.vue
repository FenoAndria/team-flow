<template>
  <input
    type="checkbox"
    :id="modalId"
    class="modal-toggle"
    @change="unsetValidationError"
  />
  <div class="modal">
    <div class="modal-box">
      <slot></slot>
      <div class="modal-action">
        <label
          :for="modalId"
          class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
        >
          ✕
        </label>
      </div>
    </div>
  </div>
</template>
<script>
import store from "../../Stores/Index";
export default {
  props: ["modalId", "content"],
  methods: {
    unsetValidationError() {
      // reinitialize validationError state after closing modal
      if (!document.querySelector("#" + this.modalId).checked) {
        store.commit("setValidationError", ""); 
      }
    },
  },
};
</script>