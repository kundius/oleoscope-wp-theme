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

function randomNumber(min, max){
  const r = Math.random()*(max-min) + min
  return Math.floor(r)
}

const bannerSidebars = document.querySelectorAll('.banner-sidebar') || []
bannerSidebars.forEach((bannerSidebar) => {
  if (bannerSidebar.children.length > 0) {
    bannerSidebar.classList.add('banner-sidebar_show')
    const child = bannerSidebar.children[randomNumber(0, bannerSidebar.children.length-1)]
    if (child) {
      child.classList.add('banner-sidebar__widget_show')
    }
  }
})
