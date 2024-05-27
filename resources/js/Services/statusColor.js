export default (status) => {
  switch (status) {
    case "Todo":
      return "text-blue-500";
      break;
    case "In Progress":
      return "text-orange-500";
      break;
    case "Completed":
      return "text-green-500";
      break;
    case "Cancelled":
      return "text-red-500";
      break;
    default:
      break;
  }
}; 