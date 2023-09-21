<template>
  <header :class="{ '--closeHeader': shouldclose }">
    <div class="header">
      <div class="line"></div>
      <router-link to="/home">
        <img src="../../public/img/logo.png" alt="" />
      </router-link>
      <div class="line"></div>
      <input type="checkbox" name="navbar" id="navbar" />
      <div class="header-nav">
        <label for="navbar" class="checkBox">
          <span></span>
          <span></span>
          <span></span>
        </label>
        <label class="homeNav" for="navbar">
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
        </label>
      </div>

      <!-- <label class="navbar-img" for="navbar" id="navbar-btn">
        <div class="navbar-btn">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </label> -->

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
      <router-link to="/Login" class="login">會員中心</router-link>
      <router-link to="/store" class="store">精選購物</router-link>
      <router-link to="/New" class="new">最新消息</router-link>
      <router-link to="/about" class="about">關於我們</router-link>
      <router-link to="/cart" class="cart">購物車</router-link>
      <router-link to="/mrtContributeInPage" class="cart">排版用之後刪掉</router-link>
    </nav>
  </header>
</template>

<script>
export default {
  data() {
    return {
      weather: {},
      hot: false,
    };
  },
  computed: {
    shouldclose() {
      return this.$route.path === "/home";
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
  },
};
</script>
