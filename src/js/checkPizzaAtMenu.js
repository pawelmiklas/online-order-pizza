const CheckPizzaAtMenu = (function() {
  let empty_element = document.querySelectorAll(".item--size-to-order__hide");
  let select_pizza_element = document.querySelectorAll(".item--size-to-order");
  let border_element = document.querySelectorAll(".pizza-menu--list__item");

  // let listOfPizzas= = document.querySelector("#list-of-pizzas");
  // let AddPizzaBtn = document.querySelectorAll(".add-pizza-btn");
  for (let i = 0; i < border_element.length; i++) {
    border_element[i].addEventListener("click", function() {
      if (this.classList.contains("pizza-menu--active")) {
        border_element[i].style.border = "";
        empty_element[i].style.display = "block";
        select_pizza_element[i].style.display = "none";
        this.classList.remove("pizza-menu--active");
      } else {
        border_element[i].style.border = "3px solid rgba(233, 179, 0, 1)";
        empty_element[i].style.display = "none";
        select_pizza_element[i].style.display = "flex";
        this.classList.add("pizza-menu--active");
      }
    });
    select_pizza_element[i].addEventListener("click", function(e) {
      e.stopPropagation();
    });
  }
})();
export { CheckPizzaAtMenu };
