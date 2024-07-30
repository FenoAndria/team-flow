<template>
  <div class="flex space-x-4 items-center font-semibold">
    <div class="filter-container">
      <div class="filter-button" :class="statusColor(filterStatus.tag)">
        <span class="bi bi-filter text-xl font-bold"></span>
        {{ filterStatus.tag }} ({{ count }})
        <div class="filter-content">
          <div class="flex space-x-2 font-semibold">
            <div class="" v-for="item in filterTab">
              <label for="" class="radio-container">
                <input
                  type="radio"
                  name="filterTask"
                  id="filterTask"
                  class="radio radio-xs radio-primary"
                  @change="emitFilter(item)"
                  :checked="item.name === 'All'"
                />
                <span>{{ item.tag }}</span>
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
  props: ["count", "type", "filterTab"],
  data() {
    return {
      filterStatus: "",
    };
  },
  methods: {
    emitFilter(item) {
      this.filterStatus = item;
      this.$emit("filterItem", item);
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
          case "Have Lead":
            return "bg-accent";
          case "No Lead":
            return "bg-info";
          default:
            return "bg-secondary";
        }
      }
    },
  },
  mounted() {
    this.emitFilter({
      name: "All",
      tag: "All",
    });
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