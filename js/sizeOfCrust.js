const SizeOfCrust = (function() {
    let all_sizes_element = document.querySelectorAll(".down--sizes__element");
    let element = document.querySelectorAll(".element");
    let element_par = document.querySelectorAll(".element>p");
    let par = document.querySelectorAll(".down--sizes__element>p");
    let x = 0;
    for (let i = 0; i < all_sizes_element.length; i++) {
        all_sizes_element[i].addEventListener("click", function() {
            if (this.classList.contains("color-active") && x == i) {
                element[i].style.border = '3px solid rgba(212, 92, 21, 1)';
                par[i].style.color = "rgba(212, 92, 21, 1)";
                element_par[i].style.color = "rgba(212, 92, 21, 1)";
                this.classList.remove("color-active");
                element[x].style.border = '3px solid white';
                par[x].style.color = "white";
                element_par[x].style.color = "white";
                x = i;
            } else {
                element[x].style.border = '3px solid white';
                par[x].style.color = "white";
                element_par[x].style.color = "white";
                this.classList.add("color-active");
                element[i].style.border = '3px solid rgba(212, 92, 21, 1)';
                par[i].style.color = "rgba(212, 92, 21, 1)";
                element_par[i].style.color = "rgba(212, 92, 21, 1)";
                x = i;
            }
        })
    }
})();
export {SizeOfCrust};