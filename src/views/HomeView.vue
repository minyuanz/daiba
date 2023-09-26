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
      <div class="swiper left">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="(path, index) in buildingPaths" :key="index">
            <img :src="path" alt="Image">
          </div>
        </div>
      </div>
      
      <div class="logo">
        <router-link to="/" class="home">
          <img src="../../public/img/logo.png" alt="logo" />
        </router-link>
      </div>
      
      <div class="swiper mb-none right">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="(path, index) in buildingPaths" :key="index">
            <img :src="path" alt="Image">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="animate">
    <div class="circle">
      <svg
        ref="svgElement"
        xmlns="http://www.w3.org/2000/svg"
        width="100%"
        height="100%"
        viewBox="0 0 107 190"
        enable-background="new 0 0 107 190"
      >
        <circle
          fill="none"
          id="circle"
          stroke-dasharray="0 610 610 0"
          class="stat-outline-circle"
          stroke="#fff04b"
          stroke-width="8"
          stroke-miterlimit="10"
          cx="53.5"
          cy="95"
          r="30%"
        ></circle>

        <animate
          attributeType="XML"
          xlink:href="#circle"
          id="circleanimate"
          attributeName="stroke-dashoffset"
          from="0"
          to="610"
          dur="3s"
          begin=".2s"
          fill="freeze"
        />
        <!-- <animate
          attributeType="XML"
          xlink:href="#circle"
          id="circleanimate2"
          attributeName="stroke-dashoffset"
          from="610"
          to="0"
          dur="1s"
          begin="1.5s"
          fill="freeze"
        />   -->
      </svg>
    </div>
    <div class="displaycenter">
      <div class="logo">
        <img src="../../public/img/logo.png" alt="logo" />
      </div>
    </div>

    <div class="animateLine">
      <div class="row-line">
        <div class="r-line chocolate"></div>
        <div class="r-line success"></div>
        <div class="r-line danger"></div>
      </div>

      <div class="col-line">
        <div class="c-line info"></div>
        <div class="c-line tangerine"></div>
        <div class="c-line grap"></div>
      </div>
    </div>
  </div>
</template>

<script>
import gsap from "gsap";
import Swiper from "swiper/bundle";
export default {

  data () {
      return {
        buildingPaths: [],  
      }
  },
  created() {
    this.importImages();
  },
  methods: {
    importImages() {
      const buildings = require.context('@/assets/images/building', false, /\.(png|jpe?g|gif|svg)$/);

      this.buildingPaths = buildings.keys().map(key => buildings(key));
    }
  },
  mounted() {
    const swiper = new Swiper(".swiper", {
      // Optional parameters
      direction: "horizontal",
      speed: 2000,
      loop: true,
      slidesPerView: 3,
      spaceBetween: 10,
      allowTouchMove: false,
      autoplay: {
        delay: 0,
        pauseOnMouseEnter: true,
        disableOnInteraction: false,
      },
    });
    setTimeout(() => {
      const circleElement = document.querySelector(".animate");
      if (circleElement) {
        circleElement.style.display = "none";
      }
    }, 4800);

    setTimeout(() => {
      const animateElement = document.querySelector(".animate");
      if (animateElement) {
        animateElement.classList.add("fadeOut");
      }
    }, 3000);

    gsap.fromTo(
      ".chocolate",
      {
        x: "150%",
      },
      {
        x: "-150%",
        duration: 1,
        delay: 0,
      }
    );

    gsap.fromTo(
      ".success ",
      {
        x: "150%",
      },
      {
        x: "-150%",
        duration: 1,
        delay: 0.2,
      }
    );

    gsap.fromTo(
      ".danger",
      {
        x: "150%",
      },
      {
        x: "-150%",
        duration: 1,
        delay: 0.4,
      }
    );

    gsap.fromTo(
      ".info ",
      {
        y: "150%",
      },
      {
        y: "-160%",
        duration: 1,
        delay: 0.6,
      }
    );

    gsap.fromTo(
      ".tangerine  ",
      {
        y: "150%",
      },
      {
        y: "-160%",
        duration: 1,
        delay: 0.8,
      }
    );

    gsap.fromTo(
      ".grap   ",
      {
        y: "150%",
      },
      {
        y: "-160%",
        duration: 1,
        delay: 1,
      }
    );
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/page/index";
</style>

<!-- <script>
import gsap from "gsap"; // 确保正确引入GSAP库

export default {
  mounted() {
    // 在组件挂载后初始化GSAP动画
    gsap.set(".box2", { transformOrigin: "50% 50%" });

    // 创建一个无限循环的动画
    function bounceImage() {
      gsap.to(".box2", {
        x: () => gsap.utils.random(0, 1000, 60), // 随机水平位移
        y: () => gsap.utils.random(0, 200, 5), // 随机垂直位移
        rotation: () => gsap.utils.random(-45, 45), // 随机旋转角度
        duration: 2, // 持续时间
        ease: "power2.inOut",
        onComplete: bounceImage, // 完成后再次调用此函数
      });
    }

    bounceImage(); // 开始动画
  },
};
</script> -->
