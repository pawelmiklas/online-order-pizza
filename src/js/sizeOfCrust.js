import {
  checkout
} from "./checkout.js";
const SizeOfCrust = (function () {
  let allSizesElement = document.querySelectorAll(".down--sizes__element");
  let sizeCrust = document.querySelector("#size-crust-pizza");
  let priceCrust = document.querySelector("#price-crust-pizza");
  let orderTotalPrice = document.querySelector("#order-total-price");
  let i = 0;
  allSizesElement.forEach(item => {
    item.addEventListener("click", () => {
      if (item.classList.contains("checked-size")) {
        return;
      }
      allSizesElement.forEach(item => {
        item.classList.remove("checked-size");
      });
      checkout.totalPrice -= i;
      item.classList.add("checked-size");
      i = parseFloat(item.getAttribute("data-price"));
      checkout.totalPrice += parseFloat(item.getAttribute("data-price"));
      checkout.pizzaSize = item.getAttribute("data-value");
      sizeCrust.innerHTML = item.getAttribute("data-value");
      priceCrust.innerHTML = item.getAttribute("data-price");
      orderTotalPrice.innerHTML = `$${checkout.totalPrice.toFixed(2)}`;
    });
  });
})();
export {
  SizeOfCrust
};