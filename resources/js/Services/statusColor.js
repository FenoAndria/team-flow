export default function (status) {
  if (status) {
    switch (status) {
      case "Todo":
        return "text-blue-500";
      case "In Progress":
        return "text-orange-500";
      case "Completed":
        return "text-green-500";
      case "Cancelled":
        return "text-red-500";
    }

  }
}; 