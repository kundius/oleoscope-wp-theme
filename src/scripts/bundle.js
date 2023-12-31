import Swiper, { Autoplay, EffectCoverflow, EffectCreative, Pagination, Navigation } from "swiper";
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
    nextEl: ".nav-slider-button-next",
    prevEl: ".nav-slider-button-prev",
  },
});

new Swiper(".masthead-primary .swiper", {
  modules: [Pagination, Autoplay],
  speed: 500,
  spaceBetween: 12,
  loop: true,
  autoplay: {
    disableOnInteraction: false,
    delay: 6000
  },
  // grabCursor: true,
  slidesPerView: "auto",
  pagination: {
    clickable: true,
    el: ".swiper-pagination",
  },
});

const drawer = document.querySelector('.drawer')
const drawerToggle = document.querySelector('.header-main__menu')
if (drawerToggle && drawer) {
  let opened = false
  drawerToggle.addEventListener('click', () => {
    if (opened) {
      opened = false
      drawerToggle.classList.remove('active')
      drawer.classList.remove('active')
    } else {
      opened = true
      drawerToggle.classList.add('active')
      drawer.classList.add('active')
    }
  })
}
