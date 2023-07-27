import Swiper, { EffectCoverflow, EffectCreative, Pagination, Navigation } from "swiper";
import HystModal from "hystmodal";

new HystModal({
  linkAttributeName: "data-hystmodal",
});

new Swiper(".nav-slider .swiper", {
  modules: [Navigation],
  speed: 500,
  spaceBetween: 6,
  loop: true,
  // grabCursor: true,
  slidesPerView: "auto",
  navigation: {
    nextEl: ".nav-slider-button-prev",
    prevEl: ".nav-slider-button-next",
  },
});

new Swiper(".masthead-news .swiper", {
  modules: [Pagination],
  speed: 500,
  spaceBetween: 12,
  loop: true,
  // grabCursor: true,
  slidesPerView: "auto",
  pagination: {
    clickable: true,
    el: ".swiper-pagination",
  },
});
