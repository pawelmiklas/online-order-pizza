const DropdownList = (function () {
	let listButton = document.querySelectorAll('.list--up__btn');
	let listCollapse = document.querySelectorAll('.ingridients--list__down');
	let svg = document.querySelectorAll('.fa-angle');
	for (let i = 0; i < listButton.length; i++) {
		listButton[i].addEventListener('click', function () {
			if (this.classList.contains('activex')) {
				listCollapse[i].classList.add('collapse-on');
				this.classList.remove('activex');
				svg[i].classList.remove('fa-angle-down');
				svg[i].classList.add('fa-angle-up');
			} else {
				this.classList.add('activex');
				listCollapse[i].classList.remove('collapse-on');
				svg[i].classList.remove('fa-angle-up');
				svg[i].classList.add('fa-angle-down');
			}
		});
	}
});
export { DropdownList };