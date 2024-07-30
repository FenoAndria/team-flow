<template>
  <div class="flex space-x-4 items-center font-semibold">
    <div class="filter-container">
      <div class="filter-button" :class="statusColor(filterMember)">
        <span class="bi bi-filter text-xl font-bold"></span>
        {{ filterMember }} ({{ count }})
        <div class="filter-content">
          <div class="flex space-x-2 font-semibold">
            <div class="" v-for="status in filterMemberTab">
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
      filterMember: "",
      filterMemberTab: ["All", "Team Lead", "Team Member", "Others"],
    };
  },
  methods: {
    emitFilterTeam(status) {
      this.filterMember = status;
      this.$emit("filterMember", status);
    },
    statusColor(status) {
      if (status) {
        switch (status) {
          case "Team Lead":
            return "bg-accent";
          case "Team Member":
            return "bg-info";
          case "Others":
            return "bg-success";
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