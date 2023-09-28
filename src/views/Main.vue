<template>
  <div class="animateLineGroup main">
    <div class="left">
      <div class="thick"></div>
      <div class="dark1 slim"></div>
      <div class="dark2 slim"></div>
      <div class="dark3 slim"></div>
      <div class="dark4 slim"></div>
      <div class="dark5 slim"></div>
      <div class="dark6 slim"></div>
      <div class="dark7 slim"></div>
      <div class="dark8 slim"></div>
      <div class="dark9 slim"></div>
    </div>
    <div class="right">
      <div class="dark9 slim"></div>
      <div class="dark8 slim"></div>
      <div class="dark7 slim"></div>
      <div class="dark6 slim"></div>
      <div class="dark5 slim"></div>
      <div class="dark4 slim"></div>
      <div class="dark3 slim"></div>
      <div class="dark2 slim"></div>
      <div class="dark1 slim"></div>
      <div class="thick"></div>
    </div>
  </div>
  <div class="mainWrapper">
    <div class="front router">
      <div class="title">
        <router-link to="/home" class="store">
          <img src="../../public/img/frontforward.png" alt="" />
        </router-link>
        <!-- <router-link to="/Back/BackLogin" class="store">後台首頁</router-link> -->
      </div>
      <div class="swiper" id="mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for=" in 80">
            <img src="../../public/img/mainArrow.png" alt="" />
          </div>
        </div>
      </div>
    </div>

    <div class="centerline">
      <div class="animateLineGroup">
        <div class="left">
          <div class="thick"></div>
          <div class="dark1 slim"></div>
          <div class="dark2 slim"></div>
          <div class="dark3 slim"></div>
          <div class="dark4 slim"></div>
          <div class="dark5 slim"></div>
          <div class="dark6 slim"></div>
          <div class="dark7 slim"></div>
          <div class="dark8 slim"></div>
          <div class="dark9 slim"></div>
        </div>
        <div class="right">
          <div class="dark9 slim"></div>
          <div class="dark8 slim"></div>
          <div class="dark7 slim"></div>
          <div class="dark6 slim"></div>
          <div class="dark5 slim"></div>
          <div class="dark4 slim"></div>
          <div class="dark3 slim"></div>
          <div class="dark2 slim"></div>
          <div class="dark1 slim"></div>
          <div class="thick"></div>
        </div>
      </div>
      <div class="logo">
        <img src="../../public/img/logo.png" alt="logo" />
      </div>
    </div>
    <div class="logo">
      <img src="../../public/img/logo.png" alt="logo" />
    </div>

    <div class="back router">
      <div class="title">
        <router-link to="/Back/BackLogin" class="store">
          <img src="../../public/img/backforward.png" alt="" />
        </router-link>
      </div>
      <div class="swiper" id="mySwiper2">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for=" in 80">
            <img src="../../public/img/mainArrow2.png" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Swiper from "swiper/bundle";
export default {
  mounted() {
    const swiper = new Swiper(".swiper", {
      direction: "vertical",
      speed: 3000,
      loop: true,
      loopedSlides: 1,
      autoHeight: true,
      slidesPerView: "auto",
      spaceBetween: 0,
      autoplay: {
        delay: -1000,
        pauseOnMouseEnter: false,
        disableOnInteraction: false,
      },
    });
  },
};
</script>

<style lang="scss">
@import "../assets/scss/page/main.scss";
</style>
