<template>
  <div
    class="font-semibold rounded px-2 text-white"
    :class="statusColor(status)"
  >
    {{ status }}
  </div>
</template>
<script>
export default {
  props: ["status"],
  setup(props) {
    const statusColor = function (status) {
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
        }
      }
    };
    return { statusColor };
  },
};
</script>