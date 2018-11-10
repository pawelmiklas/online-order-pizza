const GenerateCheckout = (() => {
	let sessionCheckout = JSON.parse(localStorage.getItem('pizzaMenu'));
	let totalPriceCheckout = document.querySelector('#checkout-order-total-price');
	let productList = document.querySelector('.order--products-list');
	// console.log(checkoutPizza);
	console.log(sessionCheckout);
	sessionCheckout.forEach(({ name, price }) => {
		let backbone = `<div class="order--products-list__item">
            <div class="item--item-with-amount">
                <p>${name} &nbsp;</p>
                <p> x1</p>
            </div>
            <p>${price.toFixed(2)}</p>
        </div>`;
		let totalPrice = sessionCheckout.reduce((acc, { price }) => (acc += price), 0);
		productList.innerHTML += backbone;
		totalPriceCheckout.innerHTML = `$${totalPrice.toFixed(2)}`;
	});
	// console.log(sessionCheckout[0]);
})();
export { GenerateCheckout };
