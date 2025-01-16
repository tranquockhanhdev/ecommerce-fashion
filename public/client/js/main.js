/*

Table Contents
==============================
    1. Countdown timer
    2. Stirct Mode
    3. BVSelect Plugin
    4. Loader
    5. Newsletter Modal
    6. Menu
    7. Shopping Cart 
    8. Product Image Change
    9. Cart Quantity
    10. Products Filter
    11. Range Slider
    12. Lightbox Plugin
    13. Swiper Slider
    14. Filter
        14.1    Filter Sidebar
        14.2    Blog Sidebar Filter
        14.3    Shop Sidebar Filter 
    15. Password Show/Hide
    16. Slider
        16.1    Banner Slider
        16.2    Categories Slider
        16.3    Products Slider
        16.4    Gallery Slider
        16.5    Deals Slider
        16.6    Featured Sliders
        16.7    News Slider
        16.8    Testimonial Slider
        16.9    Instagram Slider
        16.10   Brands Slider
        16.11   Member Slider
        16.12   Blog Post Slider

 */

/* 
    1. Countdown timer
======================== */
if (document.getElementById("countdownTwo")) {
    $("#countdownTwo").syotimer({
        year: 2025,
        month: 1,
        day: 30,
        hour: 20,
        minute: 30,
    });
}

if (document.getElementById("countdown")) {
    $("#countdown").syotimer({
        year: 2025,
        month: 1,
        day: 20,
        hour: 20,
        minute: 30,
    });
}

/* 
    2. Stirct Mode
======================== */
("use strict");

/* 
    3. BVSelect Plugin
======================== */
if (document.getElementById("selectbox1")) {
    var demo1 = new BVSelect({
        selector: "#selectbox1",
        searchbox: false,
        offset: false,
        placeholder: "Eng",
    });
}

if (document.getElementById("selectbox2")) {
    var demo2 = new BVSelect({
        selector: "#selectbox2",
        searchbox: false,
        offset: false,
        placeholder: "VNĐ",
    });
}

if (document.getElementById("sort")) {
    var demo3 = new BVSelect({
        selector: "#sort",
        searchbox: false,
        offset: false,
        placeholder: "Latest",
    });
}

if (document.getElementById("country")) {
    var country = new BVSelect({
        selector: "#country",
        searchbox: false,
        offset: false,
        placeholder: "Select",
    });
}

if (document.getElementById("states")) {
    var states = new BVSelect({
        selector: "#states",
        searchbox: false,
        offset: false,
        placeholder: "Selects",
    });
}

if (document.getElementById("zip")) {
    var zip = new BVSelect({
        selector: "#zip",
        searchbox: false,
        offset: false,
        placeholder: "Zip Code",
    });
}

if (document.getElementById("category")) {
    var category = new BVSelect({
        selector: "#category",
        searchbox: false,
        offset: false,
        placeholder: "Select Catecory",
    });
}

if (document.getElementById("price")) {
    var price = new BVSelect({
        selector: "#price",
        searchbox: false,
        offset: false,
        placeholder: "Select Price ",
    });
}

if (document.getElementById("rating")) {
    var ratings = new BVSelect({
        selector: "#rating",
        searchbox: false,
        offset: false,
        placeholder: "Select Rating",
    });
}

if (document.getElementById("sort-by")) {
    var sort = new BVSelect({
        selector: "#sort-by",
        searchbox: false,
        offset: false,
        placeholder: "Sort by: Latest",
    });
}

if (document.getElementById("number")) {
    var number = new BVSelect({
        selector: "#number",
        searchbox: false,
        offset: false,
        placeholder: "Show: 16",
    });
}

/* 
    4. Loader 
======================== */
const preloader = document.querySelector(".loader");

window.addEventListener("load", (event) => {
    preloader.style.display = "none";
});

/* 
    5. Newsletter Modal
======================== */
// Do not show newsletter
let doNotShowNewsletter = document.getElementById("doNotShowNewsletter");

if (doNotShowNewsletter) {
    doNotShowNewsletter.addEventListener("change", (event) => {
        if (event.currentTarget.checked) {
            localStorage.setItem("hide-newsletter", true);
        }
    });
}

// Show Newsletter Modal
newsletterModal = document.getElementById("newsletter");
if (newsletterModal) {
    let newsletter = JSON.parse(localStorage.getItem("hide-newsletter"));

    if (newsletter == false || !newsletter) {
        var newsletterModal = new bootstrap.Modal(newsletterModal);
        newsletterModal.show();
    }
}

/* 
    6. Menu 
======================== */

//  Header navigation Sidebar
let closeBar = document.querySelector(".header__cross");
let mobileSidebar = document.querySelector(".header__sidebar");
let menuBtn = document.querySelector(".header__sidebar-btn");
const body = document.querySelector("body");

// Open
if (menuBtn) {
    menuBtn.addEventListener("click", function () {
        mobileSidebar.classList.add("active");
        body.classList.add("overlay-menu");
    });
}

// close
closeBar.addEventListener("click", function () {
    mobileSidebar.classList.remove("active");
    body.classList.remove("overlay-menu");
});

var navMenu = [].slice.call(
    document.querySelectorAll(".header__mobile-menu-item")
);

for (var y = 0; y < navMenu.length; y++) {
    navMenu[y].addEventListener("click", function () {
        menuClick(this);
    });
}

function menuClick(current) {
    const active = current.classList.contains("active");
    navMenu.forEach((el) => el.classList.remove("active"));
    if (active) {
        current.classList.remove("active");
    } else {
        current.classList.add("active");
    }
}

/* 
    7. Shopping Cart 
======================== */
let cartBtn = document.querySelector("#cart-bag");
let closeBtn = document.querySelector(".shopping-cart .close");
const shoppingCart = document.querySelector(".shopping-cart");

// Shopping Cart Overlay
cartBtn.addEventListener("click", function () {
    body.classList.add("overlay-cart");
    shoppingCart.classList.add("active");
});

closeBtn.addEventListener("click", function () {
    body.classList.remove("overlay-cart");
    shoppingCart.classList.remove("active");
});

// 8. Product Image Change
$galleryItem = $(".gallery-item");
$galleryItem.on("click", function () {
    $(".gallery-item.active").removeClass("active");
    $(this).addClass("active");
    let element = $(this).find("img");
    if (element) {
        let imgSource = element.attr("src");

        $(".product-main-image").attr("src", imgSource);
    }
});

/* 
    9. Cart Quantity
======================== */
function increment() {
    document.getElementById("counter-btn-counter").stepUp();
}

function decrement() {
    document.getElementById("counter-btn-counter").stepDown();
}

/* 
    10. Products Filter
======================== */
const filterToggle = document.querySelector("#filter");
if (filterToggle) {
    filterToggle.addEventListener("click", function () {
        const sidebar = document.querySelector(".shop-content .col-lg-3");
        const productGallery = document.querySelector(
            ".shop-content .col-lg-9"
        );
        const column = document.querySelectorAll(".custom-col");
        const productContent = document.querySelectorAll(
            ".shop__product-items .col-md-6"
        );

        sidebar.classList.toggle("d-none");
        productGallery.classList.toggle("col-lg-12");
        console.log(column);
        column.forEach((item) => {
            if (item.classList.contains("col-xl-6")) {
                item.classList.remove("col-xl-6");
                item.classList.add("col-xl-4");
            } else if (item.classList.contains("col-xl-4")) {
                item.classList.remove("col-xl-4");
                item.classList.add("col-xl-6");
            }
        });

        // it's will be on 4 column
        productContent.forEach((item) => {
            if (item.classList.contains("col-xl-4")) {
                item.classList.add("col-xl-3");
                item.classList.remove("col-xl-4");
            } else if (item.classList.contains("col-xl-3")) {
                item.classList.add("col-xl-4");
                item.classList.remove("col-xl-3");
            }
        });
    });
}

const filterBtn = document.querySelector("button.filter");
if (filterBtn) {
    filterBtn.addEventListener("click", () => {
        let shopSidebar = document.querySelector(".shop__sidebar");
        let body = document.querySelector("body");
        shopSidebar.classList.toggle("active");
        body.classList.toggle("overlay");
    });
}

/* 
    11. Range Slider
======================== */
var range = document.getElementById("priceRangeSlider");

if (range) {
    noUiSlider.create(range, {
        start: [20, 80],
        connect: true,
        range: {
            min: 0,
            max: 1500,
        },
        tooltips: true,
    });
}

/* 
    12. Lightbox Plugin
======================== */
if (document.getElementsByClassName("venobox")[0]) {
    $(".venobox").venobox({
        spinner: "cube-grid",
    });
}

/* 
    13. Swiper Slider
======================== */
var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
});

var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    direction: "vertical",
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});

/* 
    14. Filter 
======================== */
// 14.1    Filter Sidebar
const orderHisotryFilter = document.querySelector(".filter-icon");

if (orderHisotryFilter) {
    orderHisotryFilter.addEventListener("click", () => {
        let sidebarNav = document.querySelector(".dashboard__nav");
        let body = document.querySelector("body");
        sidebarNav.classList.toggle("active");
        body.classList.toggle("overlay");
    });
}

var overlay = document.querySelector(".overlay");
if (overlay) {
    var overlayAfter = window.getComputedStyle(overlay, "::after");
    console.log(overlayAfter);
}

// overlayAfter.addEventListener('click', () => {
//   let sidebarNav = document.querySelector(".dashboard__nav");
//   let body = document.querySelector("body");
//   sidebarNav.classList.toggle("active");
//   body.classList.toggle("overlay");
// })

// 14.2    Blog Sidebar Filter
const blogListFilter = document.querySelector("button.filter");
if (blogListFilter) {
    blogListFilter.addEventListener("click", () => {
        let blogSidebar = document.querySelector(".sidebar");
        let body = document.querySelector("body");
        blogSidebar.classList.toggle("active");
        body.classList.toggle("overlay");
    });
}

// 14.3    Shop Sidebar Filter
const filterSidebarButton = document.querySelector("button.filter");
if (filterSidebarButton) {
    filterSidebarButton.addEventListener("click", () => {
        let filterSidebar = document.querySelector(".filter__sidebar");
        let body = document.querySelector("body");
        filterSidebar.classList.toggle("active");
        body.classList.toggle("overlay");
    });
}

/* 
    15. Password Show/Hide
======================== */
function showPassword(id, el) {
    let x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
        el.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg> ';
    } else {
        x.type = "password";
        el.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
    }
}

/* 
    16. Slider
======================== */
// 16.1    Banner Slider
var bannerOne = new Swiper(".banner-slider--one", {
    spaceBetween: 15,
    loop: true,
    loopFillGroupWithBlank: true,
    effect: "fade",
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

var bannerTwo = new Swiper(".banner-slider--02", {
    spaceBetween: 15,
    loop: true,
    loopFillGroupWithBlank: true,
    effect: "fade",
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

var bannerThree = new Swiper(".banner-slider--03", {
    spaceBetween: 15,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

var bannerFour = new Swiper(".banner-slider--04", {
    spaceBetween: 15,
    loop: true,
    loopFillGroupWithBlank: true,
    effect: "fade",
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: " .swiper-button--next",
        prevEl: " .swiper-button--prev",
    },
});

var bannerFive = new Swiper(".banner-slider--05", {
    spaceBetween: 15,
    loop: true,
    loopFillGroupWithBlank: true,
    effect: "fade",
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: " .swiper-button--next",
        prevEl: " .swiper-button--prev",
    },
});

// 16.2    Categories Slider
var categories = new Swiper(".popular-categories--slider", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    loopFillGroupWithBlank: true,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        575: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
    },
});

var categoryTwo = new Swiper(".category--top-slider--two", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
    },
    navigation: {
        nextEl: " .swiper-button--next",
        prevEl: " .swiper-button--prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        575: {
            slidesPerView: 2,
        },
        767: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
        },
        1200: {
            slidesPerView: 6,
            spaceBetween: 24,
        },
    },
});

// 16.3    Products Slider
var products = new Swiper(".popular-products--slider", {
    slidesPerView: "auto",
    autoHeight: true,
    spaceBetween: 15,
    loop: true,
    loopFillGroupWithBlank: true,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        575: {
            slidesPerView: 2,
        },
    },
});

var productsTwo = new Swiper(".newest-products-slider--one", {
    spaceBetween: 22,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        480: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 5,
        },
    },
});

var productsContent = new Swiper(".our-products__content-slider", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        575: {
            slidesPerView: 2,
        },
    },
});

var productsContentOne = new Swiper(".our-products__content-slider-one", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        575: {
            slidesPerView: 2,
        },
    },
});

var productsContentTwo = new Swiper(".our-products__content-slider-two", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        575: {
            slidesPerView: 2,
        },
    },
});

var productsContentThree = new Swiper(".our-products__content-slider-three", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        575: {
            slidesPerView: 2,
        },
    },
});

var productsContentFour = new Swiper(".our-products__content-slider-four", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        575: {
            slidesPerView: 2,
        },
    },
});

// 16.4    Gallery Slider
var productViewThumbs = new Swiper(".gallery-items-slider", {
    centeredSlides: true,
    slidesPerView: 4,
    loop: true,
    autoHeight: false,
    direction: "vertical",
    spaceBetween: 24,
    navigation: {
        nextEl: ".gallery-next-item",
        prevEl: ".gallery-prev-item",
    },
    breakpoints: {
        0: {
            slidesPerView: 2,
            centeredSlides: false,
            direction: "horizontal",
            spaceBetween: 10,
        },
        570: {
            slidesPerView: 4,
            centeredSlides: false,
            direction: "horizontal",
            spaceBetween: 24,
        },
        992: {
            slidesPerView: 4,
            centeredSlides: false,
            direction: "vertical",
            spaceBetween: 24,
        },
    },
});

var galleryThumbs = new Swiper(".gallery-thumbs", {
    centeredSlides: true,
    centeredSlidesBounds: true,
    slidesPerView: 4,
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    direction: "vertical",
    breakpoints: {
        0: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 4,
        },
    },
});

var galleryMain = new Swiper(".gallery-main", {
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    preventInteractionOnTransition: true,
    navigation: {
        nextEl: ".swiper-button-next-item",
        prevEl: ".swiper-button-prev-item",
    },
    effect: "fade",
    fadeEffect: {
        crossFade: true,
    },
    thumbs: {
        swiper: galleryThumbs,
    },
});

var productViewThumbs = new Swiper(".gallery-thumbs-slider", {
    centeredSlides: true,
    centeredSlidesBounds: true,
    slidesPerView: 4,
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    direction: "vertical",
    breakpoints: {
        0: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
        },
    },
});

var productViewGallery = new Swiper(".gallery-main-slider", {
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    preventInteractionOnTransition: true,
    navigation: {
        nextEl: ".swiper-button-next-item",
        prevEl: ".swiper-button-prev-item",
    },
    effect: "fade",
    fadeEffect: {
        crossFade: true,
    },
    thumbs: {
        swiper: productViewThumbs,
    },
});

// 16.5    Deals Slider
var deals = new Swiper(".deals-products--slider", {
    slidesPerView: "auto",
    autoHeight: true,
    // centeredSlides: true,
    spaceBetween: 15,
    loop: true,
    loopFillGroupWithBlank: true,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
    },
});

// 16.6    Featured Sliders
var featured = new Swiper(".featured-slider--one", {
    spaceBetween: 0,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        480: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 5,
        },
    },
});

var featuredFive = new Swiper(".featured-slider--five", {
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        480: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1201: {
            slidesPerView: 4,
            spaceBetween: 24,
        },
    },
});

var featured = new Swiper(".related-slider--one", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        480: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 4,
        },
    },
});

var featured = new Swiper(".our-feature--slider", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    // centeredSlides: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 24,
        },
    },
});

// 16.7    News Slider
var news = new Swiper(".news-slider--one", {
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    // autoplay: {
    // 	delay: 4000,
    // 	disableOnInteraction: false,
    // },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 12,
        },
        768: {
            slidesPerView: 2,
        },
        1200: {
            slidesPerView: 3,
        },
    },
});

// 16.8    Testimonial Slider
var testimonialOne = new Swiper(".testimonial-slider--one", {
    loop: true,
    loopFillGroupWithBlank: true,
    autoHeight: true,
    slidesPerView: 1,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: " .swiper-button--next",
        prevEl: " .swiper-button--prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 12,
            centeredSlides: false,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 12,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 24,
            centeredSlides: true,
        },
    },
});

var testimonialThree = new Swiper(".testimonial-slider--three", {
    loop: true,
    loopFillGroupWithBlank: true,
    autoHeight: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: " .swiper-button--next",
        prevEl: " .swiper-button--prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 12,
        },
        768: {
            slidesPerView: 2,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 24,
        },
    },
});

// 16.9    Instagram Slider
var insta = new Swiper(".instagram-slider--one", {
    slidesPerView: 6,
    loop: true,
    loopFillGroupWithBlank: true,
    autoHeight: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 12,
        },
        575: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
        },
        1201: {
            slidesPerView: 6,
            spaceBetween: 24,
        },
    },
});

// 16.10   Brands Slider
var brandsName = new Swiper(".brand-name-slide--one", {
    loop: true,
    loopFillGroupWithBlank: true,
    autoHeight: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 12,
        },
        420: {
            slidesPerView: 3,
            spaceBetween: 12,
        },

        768: {
            slidesPerView: 4,
        },
        1200: {
            slidesPerView: 6,
            spaceBetween: 24,
        },
    },
});

// 16.11   Member Slider
var memebers = new Swiper(".members-slider--one", {
    loop: true,
    loopFillGroupWithBlank: true,
    slidesPerView: 4,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: " .arrows__btn-next ",
        prevEl: " .arrows__btn-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        768: {
            slidesPerView: 2,
        },
        1201: {
            slidesPerView: 4,
            spaceBetween: 24,
        },
    },
});

// 16.12   Blog Post Slider
var blogs = new Swiper(".blog-list--slider", {
    spaceBetween: 15,
    loop: true,
    loopFillGroupWithBlank: true,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
});

// upload image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#imagePreview").css(
                "background-image",
                "url(" + e.target.result + ")"
            );
            $("#imagePreview").hide();
            $("#imagePreview").fadeIn(650);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});

function openChat() {
    // Hiển thị chat box và lớp phủ
    document.getElementById("chatBox").style.display = "block";
    document.querySelector(".overlay").style.display = "block";
    document.getElementById("chatBox").style.animation =
        "slideIn 0.3s ease-in-out";

    // Ẩn nút "Purchase Now"
    document.querySelector(".templatecookie-btn").classList.add("hide-btn");
}

function closeChat() {
    // Ẩn chat box và lớp phủ
    document.getElementById("chatBox").style.display = "none";
    document.querySelector(".overlay").style.display = "none";

    // Hiển thị lại nút "Purchase Now"
    document.querySelector(".templatecookie-btn").classList.remove("hide-btn");
}

// Đảm bảo DOM đã sẵn sàng trước khi chạy mã JavaScript
document.addEventListener("DOMContentLoaded", function () {
    // Gán sự kiện onclick cho phần tử đăng nhập
    const loginLink = document.querySelector('a[href="#"]');
    if (loginLink) {
        loginLink.addEventListener("click", openLoginPopup);
    }

    // Nếu bạn muốn thêm chức năng đóng cho popup (khi click vào nút đóng)
    const closeButton = document.querySelector(".login-popup__content a");
    if (closeButton) {
        closeButton.addEventListener("click", closeLoginPopup);
    }
});

// Hàm mở popup đăng nhập
function openLoginPopup(event) {
    if (event) {
        event.preventDefault(); // Ngăn không cho chuyển trang khi click vào liên kết
    }

    const popup = document.getElementById("loginPopup");
    if (popup) {
        popup.classList.add("active"); // Hiển thị popup
    }
}

// Hàm đóng popup đăng nhập
function closeLoginPopup() {
    const popup = document.getElementById("loginPopup");
    if (popup) {
        popup.classList.remove("active"); // Ẩn popup
    }
}

function togglePassword() {
    var passwordInput = document.getElementById("password");
    var icon = document.querySelector(".icon-eye svg");

    // Kiểm tra loại input (password hoặc text)
    if (passwordInput.type === "password") {
        passwordInput.type = "text"; // Đổi thành text để hiển thị mật khẩu
        icon.innerHTML = `
      <path
        d="M1.66663 10.5003C1.66663 10.5003 4.69663 4.66699 9.99996 4.66699C15.3033 4.66699 18.3333 10.5003 18.3333 10.5003C18.3333 10.5003 15.3033 16.3337 9.99996 16.3337C4.69663 16.3337 1.66663 10.5003 1.66663 10.5003Z"
        stroke="currentColor"
        stroke-width="1.5"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
      <path
        d="M10 13C10.663 13 11.2989 12.7366 11.7678 12.2678C12.2366 11.7989 12.5 11.163 12.5 10.5C12.5 9.83696 12.2366 9.20107 11.7678 8.73223C11.2989 8.26339 10.663 8 10 8C9.33696 8 8.70107 8.26339 8.23223 8.73223C7.76339 9.20107 7.5 9.83696 7.5 10.5C7.5 11.163 7.76339 11.7989 8.23223 12.2678C8.70107 12.7366 9.33696 13 10 13V13Z"
        stroke="currentColor"
        stroke-width="1.5"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
    `;
    } else {
        passwordInput.type = "password"; // Đổi lại thành password để ẩn mật khẩu
        icon.innerHTML = `
      <path
        d="M1.66663 10.5003C1.66663 10.5003 4.69663 4.66699 9.99996 4.66699C15.3033 4.66699 18.3333 10.5003 18.3333 10.5003C18.3333 10.5003 15.3033 16.3337 9.99996 16.3337C4.69663 16.3337 1.66663 10.5003 1.66663 10.5003Z"
        stroke="currentColor"
        stroke-width="1.5"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
      <path
        d="M10 13C10.663 13 11.2989 12.7366 11.7678 12.2678C12.2366 11.7989 12.5 11.163 12.5 10.5C12.5 9.83696 12.2366 9.20107 11.7678 8.73223C11.2989 8.26339 10.663 8 10 8C9.33696 8 8.70107 8.26339 8.23223 8.73223C7.76339 9.20107 7.5 9.83696 7.5 10.5C7.5 11.163 7.76339 11.7989 8.23223 12.2678C8.70107 12.7366 9.33696 13 10 13V13Z"
        stroke="currentColor"
        stroke-width="1.5"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
    `;
    }
}
document.addEventListener("DOMContentLoaded", function () {
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (window.isLoggedIn) {
        // Nếu đã đăng nhập, gọi hàm lấy dữ liệu giỏ hàng
        fetchCartData();
    } else {
        console.log("Vui lòng đăng nhập để xem giỏ hàng.");
        // Hoặc bạn có thể hiển thị thông báo cho người dùng chưa đăng nhập
    }

    // Hàm lấy dữ liệu giỏ hàng từ API
    function fetchCartData() {
        fetch("/cart/cart-data")
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    const cartItems = data.cartItems;
                    const total = data.total;
                    const cartCount = cartItems.length;

                    // Kiểm tra sự tồn tại của phần tử trước khi thao tác
                    const cartItemCountElem = document.querySelector(
                        ".header__cart-item .item-number"
                    );
                    if (cartItemCountElem) {
                        cartItemCountElem.innerText = cartCount;
                    }

                    const shoppingCartCountElem = document.querySelector(
                        ".shopping-cart .count"
                    );
                    if (shoppingCartCountElem) {
                        shoppingCartCountElem.innerText = cartCount;
                    }

                    const cartPriceElem = document.querySelector(
                        ".header__cart-item-content-info .price"
                    );
                    if (cartPriceElem) {
                        cartPriceElem.innerText = `${Number(
                            total
                        ).toLocaleString("vi-VN")}đ`;
                    }

                    const cartProductList = document.querySelector(
                        ".shopping-cart__product-content-popup"
                    );
                    if (cartProductList) {
                        cartProductList.innerHTML = ""; // Xóa các sản phẩm cũ

                        cartItems.forEach((item) => {
                            const productName =
                                item.product.name.length > 25
                                    ? item.product.name.slice(0, 25) + "..."
                                    : item.product.name;
                            const formattedPrice = Number(
                                item.product.price
                            ).toLocaleString("vi-VN");

                            const productHTML = `
                            <div class="shopping-cart__product-content">
                                <div class="shopping-cart__product-content-item">
                                    <div class="img-wrapper">
                                        <img src="${item.product.images[0]?.url}" alt="product" style="width: 80px; height: auto;" />
                                    </div>
                                    <div class="text-content">
                                        <h5 class="font-body--md-400">${productName}</h5>
                                        <p class="font-body--md-400">${item.quantity} x <span class="font-body--md-500">${formattedPrice} VNĐ</span></p>
                                    </div>
                                    <button class="delete-item" data-id="${item.id}">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10" />
                                            <path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        `;
                            cartProductList.innerHTML += productHTML;
                        });
                    }

                    const formattedTotal =
                        Number(total).toLocaleString("vi-VN");
                    const cartProductInfoCountElem = document.querySelector(
                        ".shopping-cart-product-info .product-count"
                    );
                    if (cartProductInfoCountElem) {
                        cartProductInfoCountElem.innerText = `${cartCount} Sản Phẩm`;
                    }

                    const cartProductInfoPriceElem = document.querySelector(
                        ".shopping-cart-product-info .product-price"
                    );
                    if (cartProductInfoPriceElem) {
                        cartProductInfoPriceElem.innerText = `₫${formattedTotal}`;
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => console.error("Lỗi khi lấy giỏ hàng:", error));
    }

    // Hàm xóa sản phẩm khỏi giỏ hàng
    function deleteCartItem(cartItemId) {
        fetch(`/cart/cart/remove/${cartItemId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Xóa sản phẩm khỏi giao diện
                    const itemToRemove = document.querySelector(
                        `.delete-item[data-id="${cartItemId}"]`
                    );
                    if (itemToRemove) {
                        itemToRemove
                            .closest(".shopping-cart__product-content")
                            .remove();
                    }

                    // Cập nhật lại số lượng và tổng tiền trong giỏ hàng
                    fetchCartData();
                    console.log(data.message);
                } else {
                    console.error("Lỗi:", data.message);
                }
            })
            .catch((error) => console.error("Có lỗi xảy ra:", error));
    }

    // Lắng nghe sự kiện click vào nút xóa
    document.addEventListener("click", function (event) {
        if (event.target.closest(".delete-item")) {
            const cartItemId = event.target
                .closest(".delete-item")
                .getAttribute("data-id");
            deleteCartItem(cartItemId); // Gọi hàm xóa sản phẩm
        }
    });
});
