import Swiper, { EffectCoverflow, Navigation } from "swiper";
import HystModal from "hystmodal";

const rulesModal = new HystModal({
  linkAttributeName: "data-hystmodal",
});

const swiper = new Swiper(".mySwiper", {
  modules: [EffectCoverflow, Navigation],
  effect: "coverflow",
  speed: 500,
  loop: true,
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 0,
    stretch: 180,
    depth: 290,
    modifier: 1,
    slideShadows: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
