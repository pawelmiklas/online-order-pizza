const DropdownList = ( function() {
    let all_plus = document.querySelectorAll(".list--up__btn");
    let all_lists = document.querySelectorAll(".ingridients--list__down");
    let all_svg = document.querySelectorAll(".fa-angle");
    for (let i = 0; i < all_plus.length; i++) {
        all_plus[i].addEventListener("click",  function() {
            if (this.classList.contains("activex")) {
                all_lists[i].style.marginBottom = "30px";
                all_lists[i].style.opacity = "1";
                all_lists[i].style.height = "auto";
                this.classList.remove('activex');
                all_svg[i].classList.remove("fa-angle-down");
                all_svg[i].classList.add("fa-angle-up");
            } else {
                this.classList.add('activex');
                all_lists[i].style.marginBottom = "0";
                all_lists[i].style.opacity = "0";
                all_lists[i].style.height = "0";
                all_svg[i].classList.remove("fa-angle-up");
                all_svg[i].classList.add("fa-angle-down");
            }
        })
    }
})();
export{DropdownList};