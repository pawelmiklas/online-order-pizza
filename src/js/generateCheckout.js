const GenerateCheckout = (() => {
	let sessionCheckout = JSON.parse(localStorage.getItem('pizzaMenu'));
	let sessionCheckoutBuilder = JSON.parse(localStorage.getItem('pizzaMenuBuilder'));
	let totalPriceCheckout = document.querySelector('#checkout-order-total-price');
	let productList = document.querySelector('.order--products-list');
	let inputRadio = document.querySelectorAll(".input-radio");
	let firstForm = document.querySelector("#form-with-personal-data");
	let secondForm = document.querySelector("#login-form-checkout");
	let totalPrice = 0;
	inputRadio.forEach(input => {
		input.addEventListener("change", () => {
			if (input.checked && input.getAttribute('data-value') == 'yes') {
				firstForm.style.display = "none";
				secondForm.style.display = "flex";
			} else {
				firstForm.style.display = "block";
				secondForm.style.display = "none";
			}
		})
	})
	if (sessionCheckout) {
		sessionCheckout.forEach(({
			name,
			price,
			size
		}) => {
			let backbone = `<div class="order--products-list__item">
		<div class="item--item-with-amount">
			<p>${name} &nbsp;</p>
			<p>x1</p>
			<p>&nbsp; ${size}</p>
	        </div>
	        <p>${price.toFixed(2)}</p>
			</div>`;
			productList.innerHTML += backbone;
		});
		totalPrice += sessionCheckout.reduce((acc, {
			price
		}) => (acc += price), 0);
	}
	if (sessionCheckoutBuilder) {
		sessionCheckoutBuilder.forEach(({
			name,
			price,
			size
		}) => {
			let backbone = `<div class="order--products-list__item">
			<div class="item--item-with-amount">
			<p>${name} &nbsp;</p>
		<p>x1</p>
		<p>&nbsp; ${size}</p>
		</div>
		<p>${price.toFixed(2)}</p>
        </div>`;
			productList.innerHTML += backbone;
		});
		totalPrice += sessionCheckoutBuilder.reduce((acc, {
			price
		}) => (acc += price), 0);
	}


	totalPriceCheckout.innerHTML = `$${totalPrice.toFixed(2)}`;
})();
export {
	GenerateCheckout
};