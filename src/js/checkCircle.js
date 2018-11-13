let checkout = [];
let j = 1;
const CheckCircle = (() => {
  let blockToChecked = document.querySelectorAll(".down--ingridients__sauce");
  let productListOrder = document.querySelector("#product-list-order");
  let orderTotalPrice = document.querySelector("#order-total-price");
  let addToCard = document.querySelector("#add-to-card");
  let createAnother = document.querySelector("#buy-btn2");
  let finalPrice = 0;
  let ingridientsArray = [];
  let sizeName = '';

  let sizeOFCrust = function () {
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
        finalPrice -= i;
        item.classList.add("checked-size");
        i = parseFloat(item.getAttribute("data-price"));
        finalPrice += parseFloat(item.getAttribute("data-price"));
        sizeName = item.getAttribute("data-value");
        sizeCrust.innerHTML = item.getAttribute("data-value");
        priceCrust.innerHTML = item.getAttribute("data-price");
        orderTotalPrice.innerHTML = `$${finalPrice.toFixed(2)}`;
      });
    });
  }
  sizeOFCrust();

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
        finalPrice += price;
        ingridientsArray.push(name);
        productListOrder.innerHTML += schema;
      } else {
        document.getElementById(`${name}1`).remove();
        price = +price;
        finalPrice -= price;
        block.classList.add("without");
        AllCheckCircle.style.display = "none";
      }

      orderTotalPrice.innerHTML = `$${finalPrice.toFixed(2)}`;
    });
  });

  let checkoutIngridients = (link, popUp) => {
    if (finalPrice === 0 || sizeName === '') {
      alert(`Choose some ingridients to your pizza bro!`);
    } else {
      if (popUp == 'yes') {
        let popUp = document.querySelector('.pop-up');
        popUp.classList.toggle("added-to-card");
        setTimeout(() => {
          popUp.classList.toggle("added-to-card");
        }, 3000);
      }
      const customPizza = `custom pizza ${j}`;
      checkout.push({
        name: customPizza,
        price: parseFloat(finalPrice),
        size: sizeName,
        ingridients: ingridientsArray
      });
      j++;
      if (localStorage.getItem('pizzaMenuBuilder')) {
        let clientsArr = JSON.parse(localStorage.getItem('pizzaMenuBuilder'));
        localStorage.setItem('pizzaMenuBuilder', JSON.stringify([...checkout, ...clientsArr]));
      } else {
        localStorage.setItem('pizzaMenuBuilder', JSON.stringify(checkout));
      }
      setTimeout(() => {
        window.location.href = `${link}`;
      }, 2000);
    }
  }

  createAnother.addEventListener('click', () => {
    checkoutIngridients('pizza-builder.php', 'yes');

  })
  addToCard.addEventListener('click', () => {
    checkoutIngridients('checkout.php', 'no');
  });
})();
export {
  CheckCircle
};