// import { checkoutPizza } from "./checkoutPizza.js";
export let checkoutPizza = [];
const CheckPizzaAtMenu = (() => {
	let listOfPizzas = document.querySelector('#list-of-pizzas'); // tam gdzie dodaje pizze
	let totalPrice = document.querySelector('#total-price'); // cena w orderze na stronie
	const addToCard = document.querySelector('#add-to-card'); // do koszyka
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
			console.log(checkoutPizza);
			let selectValue = form.querySelector(`#${name}`);
			let selectValuePrice = selectValue.getAttribute("data-price");
			let selectValueSizeName = selectValue.options[selectValue.selectedIndex].getAttribute("data-sizename");
			selectValuePrice = +selectValuePrice;
			let thisValue = parseFloat(selectValue.value);
			let amountPizzas = amountPizzaInput.value;
			let finalPriceForPizza = (selectValuePrice + thisValue).toFixed(2);
			// let flag = true;
			// if (checkoutPizza.length > 0) {
			// 	console.log("wieksza od zera");
			// 	checkoutPizza.forEach((e) => {
			// 		if (e.name == name && e.size == selectValueSizeName) {
			// 			e.price += parseFloat(finalPriceForPizza);
			// 			e.amount += 1;
			// 			flag = !flag;
			// 			countMoney();
			// 		}
			// 	})
			// }
			// if (flag) {
			// dodać id do schema żeby po if u góry można było zmieniać wartości
			// amount i price. Ewentualnie wartosci w schema dodawać z tablicy
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
				console.log(checkoutPizza);
			}

		})
	})

	addToCard.addEventListener('click', function () {
		if (localStorage.getItem('pizzaMenu')) {
			let clientsArr = JSON.parse(localStorage.getItem('pizzaMenu'));
			// console.log(`a: ${clientsArr}`);
			// console.log(clientsArr);
			// console.log(checkoutPizza);
			// let found = clientsArr.forEach(({
			// 	name
			// }) => {
			// 	checkoutPizza.forEach((element) => {
			// 		if (element.name === name) {
			// 			console.log(`Pokrywa się: ${name}`);
			// 		}
			// 	});
			// });
			// const xdddd = clientsArr.find((item) => item.name == checkoutPizza.name);
			// console.log(found);
			// console.log(name);
			localStorage.setItem('pizzaMenu', JSON.stringify([...checkoutPizza, ...clientsArr]));
		} else {
			localStorage.setItem('pizzaMenu', JSON.stringify(checkoutPizza));
		}
	});
})();
export {
	CheckPizzaAtMenu
};


// // import { checkoutPizza } from "./checkoutPizza.js";
// export let checkoutPizza = [];
// const CheckPizzaAtMenu = (() => {
// 	let selectPizzaElement = document.querySelectorAll('.item--size-to-order');
// 	let borderElement = document.querySelectorAll('.pizza-menu--list__item');
// 	let listOfPizzas = document.querySelector('#list-of-pizzas');
// 	let totalPrice = document.querySelector('#total-price');
// 	const addToCard = document.querySelector('#add-to-card');
// 	let i = 0;
// 	borderElement.forEach((element) => {
// 		element.addEventListener('click', () => {
// 			let name = element.getAttribute('data-name');
// 			let price = element.getAttribute('data-price');
// 			let amount = element.getAttribute('data-amount');
// 			let selectValue = document.querySelector(`.${name}`);
// 			let countMoney = () => {
// 				const totalMoney = checkoutPizza.reduce((acc, item) => acc + item.price * item.amount, 0);
// 				totalPrice.innerHTML = `$${totalMoney.toFixed(2)}`;
// 			};

// 			if (element.classList.contains('pizza-menu--active')) {
// 				element.classList.remove('pizza-menu--list__item-checked');
// 				element.classList.remove('pizza-menu--active');
// 				checkoutPizza = checkoutPizza.filter((pizza) => pizza.name != name);
// 				document.getElementById(`${name}`).remove();
// 				document.querySelector(`.${name}`).selectedIndex = 0;
// 				console.log(checkoutPizza);
// 			} else {
// 				let amountPizzaInput = element.querySelector("#amount-pizza-input");
// 				let amountMinus = element.querySelector("#minus");
// 				let amountPlus = element.querySelector("#plus");
// 				let submit = element.querySelector("#submit-to-add");
// 				element.classList.add('pizza-menu--list__item-checked');
// 				element.classList.add('pizza-menu--active');
// 				amountPlus.addEventListener("click", () => {
// 					let amount = amountPizzaInput.value;
// 					if (amount == 99) {
// 						return
// 					} else {
// 						amount = +amount;
// 						amount += 1;
// 						amountPizzaInput.value = amount;
// 						// checkoutPizza.forEach((element) => (element.name == name ? (element.amount = amount) : ''));
// 						countMoney();
// 						// console.log(checkoutPizza);
// 					}
// 				})
// 				amountMinus.addEventListener("click", () => {
// 					let amount = amountPizzaInput.value;
// 					if (amount == 99 || amount == 1) {
// 						return
// 					} else {
// 						amount = +amount;
// 						amount -= 1;
// 						amountPizzaInput.value = amount;
// 						// checkoutPizza.forEach((element) => (element.name == name ? (element.amount = amount) : ''));
// 						countMoney();
// 						// console.log(checkoutPizza);
// 					}
// 				})
// 				submit.addEventListener("click", () => {
// 					let schema = `
// 					<div class="order--products-list__item" id='${name}'>
// 						<div class="item--item-with-amount">
// 						<p>${name} &nbsp;</p>
// 						<p id='amount'> x${amount}</p>
// 						</div>
// 						<p id='${name}${i}'>${price}</p>
// 					</div>
// 					`;
// 					listOfPizzas.innerHTML += schema;
// 					checkoutPizza.push({
// 						name: name,
// 						price: parseFloat(price),
// 						amount: 1
// 					});
// 					//1111
// 					const amountItem = amountPizzaInput.value
// 					let sth = document.getElementById(`${name}${i}`);
// 					// let amountt = sth.getElementById('amount');
// 					price = +price;
// 					let thisValue = parseFloat(selectValue.value);
// 					thisValue += price;
// 					// dodaje mi do każdej wartosci gdzie name jest taki sam
// 					// trzeba to jakoś zmienić i tworzyć wczesniej gotowy obiekt i dodawać do tablicy
// 					// albo jakos inaczej
// 					// checkoutPizza.forEach((item) => (item.name == name ? (item.price = thisValue; item.amount = amountItem) : ''));
// 					checkoutPizza.forEach((item) => {
// 						if (item.name == name) {
// 							item.price = thisValue;
// 							item.amount = amountItem;
// 						}
// 					});
// 					countMoney();
// 					console.log(thisValue);
// 					sth.innerHTML = `${thisValue.toFixed(2)}`;
// 					i++;
// 					// amount.innerHTML = i;
// 					// i++;
// 					// 11111



// 				})

// 				// let { amount } = checkoutPizza;
// 				// console.log(checkoutPizza);

// 			}

// 			countMoney();

// 			selectPizzaElement.forEach((select) => select.addEventListener('click', (e) => e.stopPropagation()));
// 		});
// 	});
// 	addToCard.addEventListener('click', function () {
// 		if (localStorage.getItem('pizzaMenu')) {
// 			let clientsArr = JSON.parse(localStorage.getItem('pizzaMenu'));
// 			// console.log(`a: ${clientsArr}`);
// 			// console.log(clientsArr);
// 			console.log(checkoutPizza);
// 			let found = clientsArr.forEach(({
// 				name
// 			}) => {
// 				checkoutPizza.forEach((element) => {
// 					if (element.name === name) {
// 						console.log(`Pokrywa się: ${name}`);
// 					}
// 				});
// 			});
// 			// const xdddd = clientsArr.find((item) => item.name == checkoutPizza.name);
// 			// console.log(found);
// 			// console.log(name);
// 			localStorage.setItem('pizzaMenu', JSON.stringify([...checkoutPizza, ...clientsArr]));
// 		} else {
// 			localStorage.setItem('pizzaMenu', JSON.stringify(checkoutPizza));
// 		}
// 	});
// })();
// export {
// 	CheckPizzaAtMenu
// };