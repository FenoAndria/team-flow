<template>
  <div class="flex space-x-4 items-center font-semibold">
    <div class="filter-container">
      <div class="filter-button" :class="statusColor(filterStatus)">
        <span class="bi bi-filter text-xl font-bold"></span>
        {{ filterStatus }} ({{ count }})
        <div class="filter-content">
          <div class="flex space-x-2 font-semibold">
            <div class="" v-for="status in filterStatusTab">
              <label for="" class="radio-container">
                <input
                  type="radio"
                  name="filterTask"
                  id="filterTask"
                  class="radio radio-xs radio-primary"
                  @change="emitFilterByStatus(status)"
                  :checked="status === 'All'"
                />
                <span>{{ status }}</span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["count", "type"],
  data() {
    return {
      filterStatus: "",
      filterStatusTab:
        this.type == "invitation"
          ? ["All", "Pending", "Accepted", "Declined", "Expired"]
          : ["All", "Todo", "In Progress", "Completed", "Cancelled"],
    };
  },
  methods: {
    emitFilterByStatus(status) {
      this.filterStatus = status;
      this.$emit("filterByStatus", status);
    },
    statusColor(status) {
      if (status) {
        switch (status) {
          case "Todo":
            return "bg-blue-500";
          case "In Progress":
            return "bg-orange-500";
          case "Completed":
            return "bg-green-500";
          case "Cancelled":
            return "bg-red-500";
          case "Pending":
            return "bg-blue-500";
          case "Accepted":
            return "bg-green-500";
          case "Declined":
            return "bg-red-500";
          case "Expired":
            return "bg-neutral-600";
          default:
            return "bg-secondary";
        }
      }
    },
  },
  mounted() {
    this.emitFilterByStatus("All");
  },
};
</script>
<style lang="postcss">
.radio-container {
  @apply flex items-center space-x-2 cursor-pointer;
}
.filter-content {
  @apply hidden transition-all delay-100;
}
.filter-container {
  @apply fixed bottom-4  transition-all delay-100;
}
.filter-button {
  @apply rounded text-lg  text-white px-4 py-2 font-semibold  cursor-pointer transition-all delay-100;
}
.filter-container:hover .filter-content {
  display: inline;
}
</style>