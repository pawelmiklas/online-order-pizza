(function () {
	const navbarList = document.getElementById('navbar--list');
	const navbarToggle = document.getElementById('navbar--toggle');
	navbarToggle.addEventListener('click', function () {
		if (this.classList.contains('active')) {
			navbarList.style.display = 'none';
			this.classList.remove('active');
		} else {
			navbarList.style.display = 'flex';
			this.classList.add('active');
		}
	});
})();