<template>
  <div class="homeWrapper">
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
  <nav class="homeNav">
    <ul>
      <li>
        <div class="pic">
          <img src="../../public/img/home/index_home.jpg" alt="" />
        </div>
        <router-link to="/mrt" class="mrt">
          <p>捷運推薦</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="../../public/img/home/game.jpg" alt="" />
        </div>
        <router-link to="/game" class="game">
          <p>捷運冒險</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="../../public/img/home/contribute.jpg" alt="" />
        </div>
        <router-link to="/contribute" class="contribute">
          <p>投稿專欄</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="../../public/img/home/member.jpg" alt="" />
        </div>
        <router-link to="/Login" class="login">
          <p>會員中心</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="../../public/img/home/shop.jpg" alt="" />
        </div>
        <router-link to="/store" class="store">
          <p>精選購物</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="../../public/img/home/new1.jpg" alt="" />
        </div>
        <router-link to="/New" class="new">
          <p>最新消息</p>
        </router-link>
      </li>
      <li>
        <div class="pic">
          <img src="../../public/img/home/about.jpg" alt="" />
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

<style>
.homeWrapper{
  position: relative;
  max-width: 100%;
  height: 100vh;
  overflow: hidden;
}
.animateLineGroup{
    width: 100%;
    display: flex;
    justify-content: space-between;      
    position: relative;
    position: absolute;
    z-index: -1;
    /* overflow: hidden; */
    .left{
        width: 18.75%;
        display: flex;
        justify-content: space-between;
        position: absolute;
        animation: fadeInLeft 5.5s ease-out 0s ;
      }
    .right{
      width: 18.75%;
        display: flex;
        right: 0;
        justify-content: space-between;
        position: absolute;
        animation: fadeInRight 5.5s ease-out 0s ;
    }
        .thick{
          width: 20%;
          height: 100vh;
          background-color: #000;
        }
        .slim{
          width: 6%;
        }
        .dark1{
          background-color: #1A1A1A;
        }
        .dark2{
          background-color: #323232;
        }
        .dark3{
          background-color: #4C4C4C;
        }
        .dark4{
          background-color: #666666;
        }
        .dark5{
          background-color: #808080;
        }
        .dark6{
          background-color: #9A9A9A;
        }
        .dark7{
          background-color: #B4B4B4;
        }
        .dark8{
          background-color: #CCCCCC;
        }
        .dark9{
          background-color: #E6E6E6;
        }

  }
@keyframes fadeInLeft{
    0%{ left: -100%;}
  100%{ left: 0;}
}
@keyframes fadeInRight{
    0%{ right: -100%;}
  100%{ right: 0;}
}

</style>
