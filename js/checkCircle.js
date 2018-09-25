const CheckCircle = (function () {
    let block_to_checked = document.querySelectorAll(".down--ingridients__sauce");
    let all_check_circle = document.querySelectorAll(".fa-check-circle");
    for (let i = 0; i < block_to_checked.length; i++) {
        block_to_checked[i].addEventListener("click", function () {
            if (this.classList.contains("without")) {
                this.classList.remove("without");
                all_check_circle[i].style.display = "flex";
            } else {
                this.classList.add("without");
                all_check_circle[i].style.display = "none";
            }
        })
    }
})();
export {CheckCircle};