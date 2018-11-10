import {
  checkout
} from "./checkout.js";
const CheckCircle = (() => {
  let blockToChecked = document.querySelectorAll(".down--ingridients__sauce");
  let productListOrder = document.querySelector("#product-list-order");
  let orderTotalPrice = document.querySelector("#order-total-price");
  blockToChecked.forEach(block => {
    block.addEventListener("click", () => {
      let AllCheckCircle = block.querySelector(".fa-check-circle");
      let name = block.getAttribute("value");
      let price = block.getAttribute("data-price");
      if (block.classList.contains("without")) {
        block.classList.remove("without");
        AllCheckCircle.style.display = "flex";
        let schema = `
          <div class="order--products-list__item" id="${name}1">
            <div class="item--item-with-amount">
            <p>${name} &nbsp;</p>
              <p> x1</p>
            </div>
            <p>${price}</p>
          </div>
          `;
        price = +price;
        checkout.totalPrice += price;
        checkout.ingridients.push(name);
        productListOrder.innerHTML += schema;
      } else {
        checkout.ingridients.forEach(() => {
          let index = checkout.ingridients.indexOf(name);
          if (index > -1) {
            checkout.ingridients.splice(index, 1);
          }
        });
        document.getElementById(`${name}1`).remove();
        price = +price;
        checkout.totalPrice -= price;
        block.classList.add("without");
        AllCheckCircle.style.display = "none";
      }
      orderTotalPrice.innerHTML = `$${checkout.totalPrice.toFixed(2)}`;
    });
  });
})();
export {
  CheckCircle
};