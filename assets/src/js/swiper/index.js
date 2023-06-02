// import Swiper bundle with all modules installed
import Swiper from "swiper/bundle";

var review = new Swiper(".myReviews", {
  pauseOnMouseEnter: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  pagination: {
    el: ".swiper-pagination",
    type: "fraction",
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

var fourcolNoAnim = new Swiper(".fourcolNoAnim", {
  slidesPerView: 4,
  spaceBetween: 20,
  slidesPerGroup: 1,
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1400: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
  },
});

var related = new Swiper(".related-products", {
  slidesPerView: 4,
  spaceBetween: 20,
  loop: false,
  centerSlide: false,
  slidesPerGroupSkip: 1,
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1400: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
  },
  scrollbar: {
    el: ".swiper-scrollbar",
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const colFour = new Swiper(".col-four", {
  slidesPerView: 4,
  // centeredSlides: true,
  loop: false,
  spaceBetween: 15,
  slidesPerGroup: 1,
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1.4,
      spaceBetween: 15,
    },
    768: {
      slidesPerView: 2.4,
      spaceBetween: 15,
    },
    992: {
      slidesPerView: 3.4,
      spaceBetween: 15,
    },
    1200: {
      slidesPerView: 4,
      spaceBetween: 15,
    },
  },
});

var safari = new Swiper(".safari", {
  slidesPerView: 2,
  spaceBetween: 20,
  slidesPerGroup: 1,
  loop: true,
  loopFillGroupWithBlank: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  pagination: {
    el: ".swiper-pagination",
    // clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".safari-button-next",
    prevEl: ".safari-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    992: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
  },
});

var postSlider = new Swiper(".post-slider", {
  slidesPerView: 3,
  spaceBetween: 20,
  slidesPerGroup: 1,
  loop: true,
  loopFillGroupWithBlank: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
  },
});
