<template>
  <div class="flex space-x-4 items-center font-semibold">
    <div class="filter-container">
      <div class="filter-button" :class="statusColor(filterTeam)">
        <span class="bi bi-filter text-xl font-bold"></span>
        {{ filterTeam }} ({{ count }})
        <div class="filter-content">
          <div class="flex space-x-2 font-semibold">
            <div class="" v-for="status in filterTeamTab">
              <label for="" class="radio-container">
                <input
                  type="radio"
                  name="filterTask"
                  id="filterTask"
                  class="radio radio-xs radio-primary"
                  @change="emitFilterTeam(status)"
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
  props: ["count"],
  data() {
    return {
      filterTeam: "",
      filterTeamTab: ["All", "Have Lead", "No Lead"],
    };
  },
  methods: {
    emitFilterTeam(status) {
      this.filterTeam = status;
      this.$emit("filterTeam", status);
    },
    statusColor(status) {
      if (status) {
        switch (status) {
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
    this.emitFilterTeam("All");
  },
};
</script>
<style lang="postcss">
</style>