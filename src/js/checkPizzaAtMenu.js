export let checkoutPizza = [];
const CheckPizzaAtMenu = (() => {
	let listOfPizzas = document.querySelector('#list-of-pizzas');
	let totalPrice = document.querySelector('#total-price');
	const addToCard = document.querySelector('#add-to-card');
	let formPizza = document.querySelectorAll(".form-pizza");
	formPizza.forEach((form) => {
		let amountPizzaInput = form.querySelector("#amount-pizza-input");
		let amountMinus = form.querySelector("#minus");
		let amountPlus = form.querySelector("#plus");
		let submit = form.querySelector(".submit-to-add");
		let name = form.getAttribute('data-name');
		let countMoney = () => {
			const totalMoney = checkoutPizza.reduce((acc, item) => acc + item.price, 0);
			totalPrice.innerHTML = `$${totalMoney.toFixed(2)}`;
		};
		amountPlus.addEventListener("click", () => {
			let amount = amountPizzaInput.value;
			if (amount == 99) {
				return
			} else {
				amount = +amount;
				amount += 1;
				amountPizzaInput.value = amount;
			}
		})
		amountMinus.addEventListener("click", () => {
			let amount = amountPizzaInput.value;
			if (amount == 99 || amount == 1) {
				return
			} else {
				amount = +amount;
				amount -= 1;
				amountPizzaInput.value = amount;
			}
		})
		submit.addEventListener("click", () => {
			let selectValue = form.querySelector(`#${name}`);
			let selectValuePrice = selectValue.getAttribute("data-price");
			let selectValueSizeName = selectValue.options[selectValue.selectedIndex].getAttribute("data-sizename");
			selectValuePrice = +selectValuePrice;
			let thisValue = parseFloat(selectValue.value);
			let amountPizzas = amountPizzaInput.value;
			let finalPriceForPizza = (selectValuePrice + thisValue).toFixed(2);
			for (let i = 1; i <= Number(amountPizzas); i++) {
				let schema = `
				<div class="order--products-list__item">
					<div class="item--item-with-amount">
						<p>${name} &nbsp;</p>
						<p>x1</p>
						<p>&nbsp; ${selectValueSizeName}</p>
					</div>
					<p>${finalPriceForPizza}</p>
				</div>
				`;
				listOfPizzas.innerHTML += schema;
				checkoutPizza.push({
					name: name,
					price: parseFloat(finalPriceForPizza),
					size: selectValueSizeName,
					amount: 1
				});
				countMoney();
				selectValue.selectedIndex = 0;
				amountPizzaInput.value = 1;
			}

		})
	})

	addToCard.addEventListener('click', function () {
		console.log(checkoutPizza.length);
		if (checkoutPizza.length > 0) {
			let popUp = document.querySelector('.pop-up');
			popUp.classList.toggle("added-to-card");
			setTimeout(() => {
				popUp.classList.toggle("added-to-card");
			}, 3000);
			setTimeout(() => {
				window.location.href = 'pizza-menu.php';
			}, 3000);
			if (localStorage.getItem('pizzaMenu')) {
				let clientsArr = JSON.parse(localStorage.getItem('pizzaMenu'));
				localStorage.setItem('pizzaMenu', JSON.stringify([...checkoutPizza, ...clientsArr]));
			} else {
				localStorage.setItem('pizzaMenu', JSON.stringify(checkoutPizza));
			}
		} else {
			alert('Pick some pizzas!');
		}
	});
})();
export {
	CheckPizzaAtMenu
};