<template>
    <header :class="{ '--closeHeader': shouldclose, '--closeHeader2': mainClose }">
        <div class="header">
            <div class="line"></div>
            <router-link to="/home">
                <img src="../../public/img/logo.png" alt="" />
            </router-link>
            <div class="line"></div>
            <div class="hb">
                <label for="menu-check">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
            <template v-if="weather.condition">
                <div class="weather">
                    <p>台北</p>
                    <p>{{ weather.condition.text }}</p>
                    <img :src="weather.condition.icon" alt="">
                    <p class="celsius" :class="{ 'hot': hot }">{{ weather.temp_c }}°</p>
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
        }
    },
    computed: {
        shouldclose() {
            // 根據路由的 meta.useAppLayout 屬性來決定是否使用 App.vue 佈局
            return this.$route.path === "/home"
        },
        mainClose() {
            // 根據路由的 meta.useAppLayout 屬性來決定是否使用 App.vue 佈局
            return this.$route.path === "/"
        },
    },
    mounted() {
        fetch('https://api.weatherapi.com/v1/current.json?q=Taipei&lang=zh_tw&key=831993a5339d4b7cadc74621231609')
            .then(res => res.json())
            .then(json => {
                this.weather = json.current
                if (this.weather.condition.text === '局部多雲') {
                    this.weather.condition.icon = require("@/assets/images/test.gif")
                } else if (this.weather.condition.text === '晴天') {
                    this.weather.condition.icon = require("@/assets/images/sun.gif")
                }
                if (this.weather.temp_c >= 30) {
                    this.hot = true

                }
            })

    },
};


</script>