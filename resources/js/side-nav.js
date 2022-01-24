import tippy, { roundArrow } from "tippy.js";
(function (cash) {
    const sideNav = document.querySelector(".side-nav");
    const sideMenuCollapseBtn = document.getElementById("sidemenu-collapse");
    const sideMenuExpandBtn = document.getElementById("sidemenu-expand");
    const companyName = document.querySelector(".company-name-link");

    sideMenuCollapseBtn.onclick = function() {   
        sideNav.classList.add("side-nav-collapse");
        cash(".side-menu").each(function () {
            this._tippy = undefined;
        });

        initTooltips();
        sideMenuExpandBtn.classList.remove('hidden');
        companyName.classList.add('hidden');
    }

    sideMenuExpandBtn.onclick = function () {
        sideNav.classList.remove("side-nav-collapse");
        sideMenuExpandBtn.classList.add('hidden');
        companyName.classList.remove('hidden');
    }

    function initTooltips() {
        cash(".side-menu").each(function () {
            if (this._tippy == undefined) {
                let content = cash(this)
                    .find(".side-menu__title")
                    .html()
                    .replace(/<[^>]*>?/gm, "")
                    .trim();
                tippy(this, {
                    content: content,
                    arrow: roundArrow,
                    animation: "shift-away",
                    placement: "right",
                });
            }

            this._tippy.enable();
        });
    }
})(cash);