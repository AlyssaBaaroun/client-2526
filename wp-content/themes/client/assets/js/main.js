import {settings} from "./settings";

const anim = {

    mobileMenu() {
        document.addEventListener('DOMContentLoaded', () => {
            const burgerBtn = document.querySelector(settings.burgerBtn);
            const navList = document.querySelector(settings.navList);

            const toggleMobileMenu = () => {
                burgerBtn.classList.toggle(settings.burgerAnim);

                if (navList.classList.contains(settings.checkIsOpen)) {
                    navList.classList.add(settings.checkIsClosed);
                    setTimeout(() => {
                        navList.classList.remove(settings.checkIsOpen);
                        navList.classList.remove(settings.checkIsClosed);
                    }, settings.setTimeOut)

                } else {
                    navList.classList.add(settings.checkIsOpen);
                }
            };
            if (burgerBtn) {
                burgerBtn.addEventListener('click', toggleMobileMenu);
            }
        });
    },

    animation() {
        {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add(settings.showUp);
                    }
                });
            });
            document.querySelectorAll(settings.toAnimate).forEach(element => {
                element.classList.add(settings.hidden);
                observer.observe(element);
            });
        }
    },

    init() {
        this.mobileMenu();
        this.animation();
    }


}
anim.init();
