<template>
  <header :class="{ '--closeHeader': shouldclose }">
    <div class="header">
      <div class="line"></div>
      <router-link to="/home">
        <img src="../../public/img/logo.png" alt="" />
      </router-link>
      <div class="line"></div>

      <div class="header-container">
        <div class="header-menu" @click="toggleNav" :class="{ hbclose: hbclose }">
          <div class="hambergerIcon" :class="{ open: open }"></div>
        </div>

        <div class="homeNav" @click="toggleNav" :class="{ showHomeNav: showHomeNav }">
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
        </div>
      </div>

      <template v-if="weather.condition">
        <div class="weather">
          <p>台北</p>
          <p>{{ weather.condition.text }}</p>
          <img :src="weather.condition.icon" alt="" />
          <p class="celsius" :class="{ hot: hot }">{{ weather.temp_c }}°</p>
        </div>
      </template>
    </div>
    <nav class="navbar">
      <router-link to="/mrt" class="mrt">捷運推薦</router-link>
      <router-link to="/game" class="game">捷運冒險</router-link>
      <router-link to="/contribute" class="contribute">投稿專欄</router-link>
      <router-link to="/store" class="store">精選購物</router-link>
      <router-link to="/New" class="new">消息資訊</router-link>
      <router-link to="/about" class="about">關於我們</router-link>
      <router-link to="/Login" class="login">會員中心</router-link>
      <router-link to="/cart" class="cart">購物車({{ this.$store.getters.cartItemCount }})</router-link>
      <router-link to="/MrtContributeInPage" class="test">排版用之後刪掉</router-link>
    </nav>
  </header>
</template>

<script>
import gsap from "gsap";
export default {
  data() {
    return {
      // showNav: false,
      open: false,
      weather: {},
      hot: false,
      showHomeNav: false,
    };
  },
  computed: {
    shouldclose() {
      return this.$route.path === "/home";
    },
    hbclose() {
      return this.$route.path === "/home";
    },
  },

  methods: {
    toggleNav() {
      this.open = !this.open;
      this.showHomeNav = !this.showHomeNav;
    },
  },

  mounted() {
    fetch(
      "https://api.weatherapi.com/v1/current.json?q=Taipei&lang=zh_tw&key=831993a5339d4b7cadc74621231609"
    )
      .then((res) => res.json())
      .then((json) => {
        this.weather = json.current;
        if (this.weather.condition.text === "局部多雲") {
          this.weather.condition.icon = require("@/assets/images/test.gif");
        } else if (this.weather.condition.text === "晴天") {
          this.weather.condition.icon = require("@/assets/images/sun.gif");
        }
        if (this.weather.temp_c >= 30) {
          this.hot = true;
        }
        // console.log(this.weather)
      });

    // gsap.fromTo(
    //   ".showHomeNav ul li:nth-child(1)",
    //   {
    //     x: "-120%",
    //   },
    //   {
    //     x: "0",
    //     duration: 1,
    //     delay: 0,
    //   }
    // );

    // gsap.fromTo(
    //   ".success ",
    //   {
    //     x: "150%",
    //   },
    //   {
    //     x: "-150%",
    //     duration: 1,
    //     delay: 0.2,
    //   }
    // );

    // gsap.fromTo(
    //   ".danger",
    //   {
    //     x: "150%",
    //   },
    //   {
    //     x: "-150%",
    //     duration: 1,
    //     delay: 0.4,
    //   }
    // );
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/layout/header";
</style>
