import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();
import './navbarChanging';
import { DropdownList } from './dropdownList';
import { GenerateCheckout } from './generateCheckout';
import { CheckPizzaAtMenu } from './checkPizzaAtMenu';
import { CheckCircle } from './checkCircle';
document.addEventListener('DOMContentLoaded', () => {
	if (location.pathname === '/online-order-pizza/dist/pizza-menu.html') {
		CheckPizzaAtMenu();
	} else if (location.pathname === '/online-order-pizza/dist/pizza-builder.html') {
		CheckCircle();
	} else if (location.pathname === '/online-order-pizza/dist/checkout.html') {
		GenerateCheckout();
	} else if (location.pathname === '/' || '/index.html') {
		DropdownList();
	}
});