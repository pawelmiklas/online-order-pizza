// import { checkoutPizza } from "./checkoutPizza.js";
let checkoutPizza = [];
const CheckPizzaAtMenu = (function() {
  let selectPizzaElement = document.querySelectorAll(".item--size-to-order");
  let borderElement = document.querySelectorAll(".pizza-menu--list__item");
  let listOfPizzas = document.querySelector("#list-of-pizzas");
  let totalPrice = document.querySelector("#total-price");
  borderElement.forEach(element => {
    element.addEventListener("click", () => {
      let name = element.getAttribute("data-name");
      let price = element.getAttribute("data-price");
      let selectValue = document.querySelector(`.${name}`);

      let countMoney = function() {
        const totalMoney = checkoutPizza.reduce(
          (acc, item) => acc + item.price,
          0
        );
        totalPrice.innerHTML = `$${totalMoney.toFixed(2)}`;
      };

      if (element.classList.contains("pizza-menu--active")) {
        element.classList.remove("pizza-menu--list__item-checked");
        element.classList.remove("pizza-menu--active");
        checkoutPizza = checkoutPizza.filter(pizza => pizza.name != name);
        document.getElementById(`${name}`).remove();
        document.querySelector(`.${name}`).selectedIndex = 0;
      } else {
        selectValue.addEventListener("change", () => {
          price = +price;
          let thisValue = parseFloat(selectValue.value);
          thisValue += price;
          checkoutPizza.forEach(item => {
            if (item.name == name) {
              item.price = thisValue;
            }
          });
          countMoney();
        });

        checkoutPizza.push({
          name: name,
          price: parseFloat(price)
        });

        element.classList.add("pizza-menu--list__item-checked");
        element.classList.add("pizza-menu--active");
        let schema = `
          <div class="order--products-list__item" id="${name}">
            <div class="item--item-with-amount">
            <p>${name} &nbsp;</p>
              <p> x1</p>
            </div>
            <p id='${name}1'>${price}</p>
          </div>
          `;
        listOfPizzas.innerHTML += schema;
      }
      countMoney();
      selectPizzaElement.forEach(select => {
        select.addEventListener("click", e => {
          e.stopPropagation();
        });
      });
    });
  });
})();
export { CheckPizzaAtMenu };
