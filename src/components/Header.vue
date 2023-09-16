<template>
    <header :class="{ '--closeHeader': shouldclose }">
        <div class="header">
            <div class="line"></div>
            <router-link to="/">
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
            <!-- <router-link to="/MemberPagesBgc" class="cart">排版用之後刪掉</router-link> -->
        </nav>
    </header>
</template>




<script>
export default {
    computed: {
        shouldclose() {
            // 根據路由的 meta.useAppLayout 屬性來決定是否使用 App.vue 佈局
            return this.$route.path === "/";
        },
    },
};
</script>