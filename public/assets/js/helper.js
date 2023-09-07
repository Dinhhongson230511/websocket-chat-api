const formatPrice = (number) => {
  if (typeof number === "number") return number.toLocaleString("en-US");
  else return 0;
}
