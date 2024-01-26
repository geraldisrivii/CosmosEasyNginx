let buttonGamburger = document.querySelector(".gamburger"), redirectStatus = (buttonGamburger.addEventListener("click", () => { document.querySelector(".invisible-site-nav-background").classList.toggle("invisible-site-nav-background_active"), document.querySelector(".invisible-site-nav").classList.toggle("invisible-site-nav_active"), document.querySelector("html").classList.toggle("overflow-hidden") }), getCookie("status")); "ok" == redirectStatus && Swal.fire({ icon: "success", title: "Данные были отправлены", text: "Ожидайте. В течении 10 минут с вами свяжется наш оператор" }), "error" == redirectStatus && Swal.fire({ icon: "error", title: "Вы ввели некорректные данные", text: "Или произошла ошибка на сервере. Попробуйте позже" }), deleteCookie("status");
const invisibleSiteNav = document.querySelector(".invisible-site-nav");
for (const child of invisibleSiteNav.children) {
    child.addEventListener("click", () => {
        document.querySelector(".invisible-site-nav-background").classList.remove("invisible-site-nav-background_active");
        document.querySelector(".invisible-site-nav").classList.remove("invisible-site-nav_active");
        document.querySelector("html").classList.remove("overflow-hidden");
    })
}