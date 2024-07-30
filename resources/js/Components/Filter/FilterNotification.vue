<template>
  <div class="flex space-x-4 items-center font-semibold">
    <div class="filter-container">
      <div class="filter-button" :class="statusColor(filterNotification)">
        <span class="bi bi-filter text-xl font-bold"></span>
        {{ filterNotification }} ({{ count }})
        <div class="filter-content">
          <div class="flex space-x-2 font-semibold">
            <div class="" v-for="type in filterNotificationTab">
              <label for="" class="radio-container">
                <input
                  type="radio"
                  name="filterTask"
                  id="filterTask"
                  class="radio radio-xs radio-primary"
                  @change="emitFilterNotification(type)"
                  :checked="type === 'All'"
                />
                <span>{{ type }}</span>
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
  props: ["count"],
  data() {
    return {
      filterNotification: "",
      filterNotificationTab: [
        "All",
        "Lead invitation accepted",
        "Task completed",
        "Task beginning",
      ],
    };
  },
  methods: {
    emitFilterNotification(type) {
      this.filterNotification = type;
      this.$emit("filterNotification", type);
    },
    statusColor(type) {
      if (type) {
        switch (type) {
          case "Lead invitation accepted":
            return "bg-accent";
          case "Task completed":
            return "bg-info";
          case "Task beginning":
            return "bg-info";
          default:
            return "bg-secondary";
        }
      }
    },
  },
  mounted() {
    this.emitFilterNotification("All");
  },
};
</script>
<style lang="postcss">
</style>