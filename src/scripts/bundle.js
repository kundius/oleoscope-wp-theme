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

function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getWidgetSiblings(el) {
  // for collecting siblings
  let siblings = [];
  // if no parent, return no sibling
  if (!el.parentNode) {
    return siblings;
  }
  // first child of the parent node
  let sibling = el.parentNode.firstChild;

  // collecting siblings
  while (sibling) {
    if (sibling.nodeType === 1 && sibling !== el) {
      siblings.push(sibling);
    }
    sibling = sibling.nextSibling;
  }
  return siblings;
};

const bannerWidgetsProcessed = []
const bannerWidgets = document.querySelectorAll('.widget_banner_widget') || []
bannerWidgets.forEach((bannerWidget) => {
  console.log('1', bannerWidgetsProcessed, bannerWidget, bannerWidgetsProcessed.includes(bannerWidget))
  if (bannerWidgetsProcessed.includes(bannerWidget)) {
    return
  }

  const siblingWidgets = [bannerWidget]

  // let idx = 0
  // let sibling = bannerWidget.nextSibling
  // while (sibling && idx < 100) {
  //   idx++
  //   console.log('2', sibling.nodeType, sibling)
  //   if (!!sibling && sibling.nodeType === 1 && !sibling.classList.includes('widget_banner_widget')) {
  //     sibling = false
  //   }
  //   else if (!!sibling && sibling.nodeType === 1 && sibling.classList.includes('widget_banner_widget')) {
  //     bannerWidgetsProcessed.push(sibling)
  //     siblingWidgets.push(sibling)
  //     sibling = sibling.nextSibling
  //   }
  //   else {
  //     sibling = sibling.nextSibling
  //   }
  // }
  console.log('3', siblingWidgets)

  const selected = siblingWidgets[getRandomInt(0, siblingWidgets.length - 1)]
  if (selected) {
    selected.classList.add('widget_banner_widget_show')
  }
})
