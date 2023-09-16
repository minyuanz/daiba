<template>
  <nav class="homeNav">
    <ul>
      <li>
        <div class="pic">
          <img src="https://picsum.photos/1200/1000/?random=1" alt="" />
        </div>
        <router-link to="/mrt" class="mrt">
          <p>捷運推薦</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="https://picsum.photos/1200/1000/?random=1" alt="" />
        </div>
        <router-link to="/game" class="game">
          <p>捷運冒險</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="https://picsum.photos/1200/1000/?random=1" alt="" />
        </div>
        <router-link to="/contribute" class="contribute">
          <p>投稿專欄</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="https://picsum.photos/1200/1000/?random=1" alt="" />
        </div>
        <router-link to="/Login" class="login">
          <p>會員中心</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="https://picsum.photos/1200/1000/?random=1" alt="" />
        </div>
        <router-link to="/store" class="store">
          <p>精選購物</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="https://picsum.photos/1200/1000/?random=1" alt="" />
        </div>
        <router-link to="/New" class="new">
          <p>最新消息</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="https://picsum.photos/1200/1000/?random=1" alt="" />
        </div>
        <router-link to="/about" class="about">
          <p>關於我們</p>
        </router-link>
      </li>
    </ul>
  </nav>

  <div class="homeBanner">
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=1" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=1" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=1" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=2" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=2" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=2" alt="" />
        </div>
      </div>
    </div>
    <div class="logo">
      <img src="../../public/img/logo.png" alt="logo" />
    </div>
    <div class="swiper mb-none">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=1" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=1" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=1" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=2" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=2" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="https://picsum.photos/200/300/?random=2" alt="" />
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
      // Optional parameters
      direction: "horizontal",
      speed: 2000,
      loop: true,
      slidesPerView: 3,
      spaceBetween: 30,
      allowTouchMove: false,
      autoplay: {
        delay: 0,
        pauseOnMouseEnter: true,
        disableOnInteraction: false,
      },
    });
  },
};
</script>
