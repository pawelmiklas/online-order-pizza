import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();
import './navbarChanging';
import { DropdownList } from './dropdownList';
import { GenerateCheckout } from './generateCheckout';
import { CheckPizzaAtMenu } from './checkPizzaAtMenu';
import { CheckCircle } from './checkCircle';
if (location.pathname === '/' || '/index.html') {
	DropdownList();
}
if (location.pathname === '/pizza-menu.html') {
	CheckPizzaAtMenu();
}
if (location.pathname === '/pizza-builder.html') {
	CheckCircle();
}
if (location.pathname === '/checkout.html') {
	GenerateCheckout();
}