// import Swiper JS
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';
const swiper = new Swiper('.main_banner', {
    spaceBetween: 30,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".main_banner-pagination",
        clickable: true,
    },
 
});

var swiper_category = new Swiper(".main-categories_slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    breakpoints: {
      "@0.00": {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      "@0.75": {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      "@1.00": {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      "@1.50": {
        slidesPerView: 5,
        spaceBetween: 50,
      },
    },
  });

  var card_prdoucts_main = new Swiper(".card_products_main", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    breakpoints: {
      "@0.00": {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      "@0.75": {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      "@1.00": {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      "@1.50": {
        slidesPerView: 5,
        spaceBetween: 50,
      },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
  });  


  var main_blog_slider = new Swiper(".blog_main_slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    breakpoints: {
      "@0.00": {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      "@0.75": {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      "@1.00": {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      "@1.50": {
        slidesPerView: 3,
        spaceBetween: 50,
      },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
  });  

  