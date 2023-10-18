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
              <router-link to="/mrt" class="mrt">
                <p>捷運推薦</p>
              </router-link>
            </li>
            <li>
              <router-link to="/game" class="game">
                <p>捷運冒險</p>
              </router-link>
            </li>
            <li>
              <router-link to="/contribute" class="contribute">
                <p>投稿專欄</p>
              </router-link>
            </li>
            <li>
              <router-link to="/Login" class="login">
                <p>會員中心</p>
              </router-link>
            </li>
            <li>
              <router-link to="/store" class="store">
                <p>精選購物</p>
              </router-link>
            </li>
            <li>
              <router-link to="/New" class="new">
                <p>最新消息</p>
              </router-link>
            </li>
            <li>
              <router-link to="/about" class="about">
                <p>關於我們</p>
              </router-link>
            </li>
            <li>
              <router-link to="/cart" class="cart">
                <p>購物車({{ this.$store.getters.cartItemCount }})</p>
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

      <div class="user" v-if="islogin">
        <p id="userName">{{ userData.mem_name }}</p>
        <p id="signOut" @click="signOut">登出</p>
      </div>



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
    userData() {
      return this.$store.state.memInfo
    },
    islogin() {
      return !!this.userData.mem_name
    }
  },

  methods: {
    toggleNav() {
      this.open = !this.open;
      this.showHomeNav = !this.showHomeNav;
    },
    signOut() {
      localStorage.removeItem('user')
      alert('您已登出')
      this.$store.dispatch('setInfo', {})
      if (this.$router.currentRoute.value.path === '/user') {
        alert('您已登出')
        this.$router.push('/home');
      }

    }
  },

  mounted() {
    const userStorage = localStorage.getItem('user')
    if (userStorage) {
      this.$store.dispatch('setInfo', JSON.parse(userStorage))
      console.log(JSON.parse(userStorage))
    }
    fetch(
      "https://api.weatherapi.com/v1/current.json?q=Taipei&lang=zh_tw&key=6270d6c5f0ba491196f45945231810"
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
