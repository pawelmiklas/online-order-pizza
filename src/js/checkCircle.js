import { checkout } from "./checkout.js";
const CheckCircle = (function() {
  let blockToChecked = document.querySelectorAll(".down--ingridients__sauce");
  let blockToCheckedPrice = document.querySelectorAll(
    ".down--ingridients__sauce .price"
  );
  let AllCheckCircle = document.querySelectorAll(".fa-check-circle");
  let productListOrder = document.querySelector("#product-list-order");
  let orderTotalPrice = document.querySelector("#order-total-price");
  for (let i = 0; i < blockToChecked.length; i++) {
    blockToChecked[i].addEventListener("click", function() {
      let name = blockToChecked[i].getAttribute("value");
      let price = blockToCheckedPrice[i].getAttribute("value");
      if (this.classList.contains("without")) {
        this.classList.remove("without");
        AllCheckCircle[i].style.display = "flex";
        //===========
        let schema = `
          <div class="order--products-list__item" id="${i}">
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
        // =========
      } else {
        checkout.ingridients.forEach(() => {
          let index = checkout.ingridients.indexOf(name);
          if (index > -1) {
            checkout.ingridients.splice(index, 1);
          }
        });
        document.getElementById(`${i}`).remove();
        price = +price;
        checkout.totalPrice -= price;
        this.classList.add("without");
        AllCheckCircle[i].style.display = "none";
      }
      orderTotalPrice.innerHTML = `$${checkout.totalPrice.toFixed(2)}`;
      console.log(checkout);
    });
  }
})();
export { CheckCircle };
