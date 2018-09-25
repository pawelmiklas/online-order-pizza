import { CountUpIngridients } from './js/countUpIngridients.js';
import { NavbarChanging } from './js/navbarChanging.js';
document.addEventListener("DOMContentLoaded", function () {
	const PizzaModule = (function () {
	// 	//navbar
	// 	let NavbarChanging = function () {
	// 		let navbar_list = document.getElementById('navbar--list');
	// 		let navbar_toggle = document.getElementById('navbar--toggle');
	// 		navbar_toggle.addEventListener('click', function () {
	// 			if (this.classList.contains('active')) {
	// 				navbar_list.style.display = "none";
	// 				this.classList.remove('active');
	// 			} else {
	// 				navbar_list.style.display = "flex";
	// 				this.classList.add('active');
	// 			}
	// 		})
	// 	}

	// 	const CountUpIngridientsXD = function () {
	// 		let paused = false;
	// 		let heightX = 0;
	// 		window.addEventListener("scroll", function () {
	// 			let el = document.querySelector(".ingridients").getBoundingClientRect();
	// 			heightX= el.top-500;
	// 			if (heightX<0) {
	// 				const tab = [7, 15, 6, 20, 9, 11];
	// 				let easingFn = function (t, b, c, d) {
	// 					let ts = (t /= d) * t;
	// 					let tc = ts * t;
	// 					return b + c * (tc + -3 * ts + 3 * t);
	// 				}
	// 				let options = {
	// 					useEasing: true,
	// 					easingFn: easingFn,
	// 					useGrouping: true,
	// 					separator: ',',
	// 					decimal: '.',
	// 				};
	// 				let elementToCountUp = document.querySelectorAll(".element-to-countup");
	// 				if (!paused) {
	// 					for (let i = 0; i < elementToCountUp.length; i++) {
	// 						let x = new CountUp(elementToCountUp[i], 1, tab[i], 0, 3, options);
	// 						x.start();
	// 						paused = true;

	// 					}
	// 				}
	// 			}
	// 		})
	// 	}


	// 	//dropdown list
	// 	const DropdownList = function () {
	// 		let all_plus = document.querySelectorAll(".list--up__btn");
	// 		let all_lists = document.querySelectorAll(".ingridients--list__down");
	// 		let all_svg = document.querySelectorAll(".fa-angle");
	// 		for (let i = 0; i < all_plus.length; i++) {
	// 			all_plus[i].addEventListener("click", function () {
	// 				if (this.classList.contains("activex")) {
	// 					all_lists[i].style.marginBottom = "30px";
	// 					all_lists[i].style.opacity = "1";
	// 					all_lists[i].style.height = "auto";
	// 					this.classList.remove('activex');
	// 					all_svg[i].classList.remove("fa-angle-down");
	// 					all_svg[i].classList.add("fa-angle-up");
	// 				} else {
	// 					this.classList.add('activex');
	// 					all_lists[i].style.marginBottom = "0";
	// 					all_lists[i].style.opacity = "0";
	// 					all_lists[i].style.height = "0";
	// 					all_svg[i].classList.remove("fa-angle-up");
	// 					all_svg[i].classList.add("fa-angle-down");
	// 				}
	// 			})
	// 		}
	// 	}
	// 	//selection size of crust

	// 	const SizeOfCrust = function () {
	// 		let all_sizes_element = document.querySelectorAll(".down--sizes__element");
	// 		let element = document.querySelectorAll(".element");
	// 		let element_par = document.querySelectorAll(".element>p");
	// 		let par = document.querySelectorAll(".down--sizes__element>p");
	// 		let x = 0;
	// 		for (let i = 0; i < all_sizes_element.length; i++) {
	// 			all_sizes_element[i].addEventListener("click", function () {
	// 				if (this.classList.contains("color-active") && x == i) {
	// 					element[i].style.border = '3px solid rgba(212, 92, 21, 1)';
	// 					par[i].style.color = "rgba(212, 92, 21, 1)";
	// 					element_par[i].style.color = "rgba(212, 92, 21, 1)";
	// 					this.classList.remove("color-active");
	// 					element[x].style.border = '3px solid white';
	// 					par[x].style.color = "white";
	// 					element_par[x].style.color = "white";
	// 					x = i;
	// 				} else {
	// 					element[x].style.border = '3px solid white';
	// 					par[x].style.color = "white";
	// 					element_par[x].style.color = "white";
	// 					this.classList.add("color-active");
	// 					element[i].style.border = '3px solid rgba(212, 92, 21, 1)';
	// 					par[i].style.color = "rgba(212, 92, 21, 1)";
	// 					element_par[i].style.color = "rgba(212, 92, 21, 1)";
	// 					x = i;
	// 				}
	// 			})
	// 		}
	// 	}


	// 	//showing check circle above ingridient
	// 	const CheckCircle = function () {
	// 		let block_to_checked = document.querySelectorAll(".down--ingridients__sauce");
	// 		let all_check_circle = document.querySelectorAll(".fa-check-circle");
	// 		for (let i = 0; i < block_to_checked.length; i++) {
	// 			block_to_checked[i].addEventListener("click", function () {
	// 				if (this.classList.contains("without")) {
	// 					this.classList.remove("without");
	// 					all_check_circle[i].style.display = "flex";
	// 				} else {
	// 					this.classList.add("without");
	// 					all_check_circle[i].style.display = "none";
	// 				}
	// 			})
	// 		}
	// 	}



	// 	//checking pizza at pizza menu
	// 	const CheckPizzaAtMenu = function () {
	// 		let empty_element = document.querySelectorAll(".item--size-to-order__hide");
	// 		let select_pizza_element = document.querySelectorAll(".item--size-to-order");
	// 		let border_element = document.querySelectorAll(".pizza-menu--list__item");
	// 		for (let i = 0; i < border_element.length; i++) {
	// 			border_element[i].addEventListener("click", function () {
	// 				if (this.classList.contains("pizza-menu--active")) {
	// 					border_element[i].style.border = "";
	// 					empty_element[i].style.display = "block";
	// 					select_pizza_element[i].style.display = "none";
	// 					this.classList.remove("pizza-menu--active");
	// 				} else {
	// 					border_element[i].style.border = "3px solid rgba(233, 179, 0, 1)";
	// 					empty_element[i].style.display = "none";
	// 					select_pizza_element[i].style.display = "flex";
	// 					this.classList.add("pizza-menu--active");
	// 				}
	// 			})
	// 			select_pizza_element[i].addEventListener("click", function (e) {
	// 				e.stopPropagation();
	// 			})
	// 		}
	// 	}

	// 	// functions with suitables functions for individual page
		const HomePage = function () {
			CountUpIngridients();
			NavbarChanging();
			// DropdownList();
		}

		const PizzaBuilder = function () {
			NavbarChanging();
			// SizeOfCrust();
		}
	// 	const PizzaMenu = function () {
	// 		NavbarChanging();
	// 		CheckCircle();
	// 		CheckPizzaAtMenu();
	// 	}


	// 	// Initializing a function for individual page
		return {
			InitHomePage: HomePage(),
			InitPizzaBuilder: PizzaBuilder()
			// InitPizzaMenu: PizzaMenu(),
		}

	})();
})