let CountUpIngridients = ( function() {
    let paused = false;
    let heightX = 0;
    window.addEventListener("scroll",  ()=> {
        let el = document.querySelector(".ingridients").getBoundingClientRect();
        heightX = el.top - 500;
        if (heightX < 0) {
            const tab = [7, 15, 6, 20, 9, 11];
            let easingFn = function (t, b, c, d) {
                let ts = (t /= d) * t;
                let tc = ts * t;
                return b + c * (tc + -3 * ts + 3 * t);
            }
            let options = {
                useEasing: true,
                easingFn: easingFn,
                useGrouping: true,
                separator: ',',
                decimal: '.',
            };
            let elementToCountUp = document.querySelectorAll(".element-to-countup");
            if (!paused) {
                for (let i = 0; i < elementToCountUp.length; i++) {
                    let x = new CountUp(elementToCountUp[i], 1, tab[i], 0, 3, options);
                    x.start();
                    paused = true;

                }
            }
        }
    })
})();
export {
    CountUpIngridients
};