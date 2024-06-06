<template>
  <input type="checkbox" :id="modalId" class="modal-toggle" />
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
export default {
  props: ["modalId", "content"],
};
</script>