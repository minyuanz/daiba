<template>
    <div class="SliderAC">
        <div class="pic">
            <img src="https://steam.oxxostudio.tw/webp/gimp/example/simple-keyer-mask-16.webp" />
        </div>
        <h3>NAME</h3>
        <button>
            <router-link to="/home" class="logout">登出</router-link>
        </button>
        <nav>
            <ul>
                <li @click="To"><router-link to="">會員資料</router-link></li>
                <li @click="To"><router-link to="">投稿文章</router-link></li>
                <li @click="To"><router-link to="">文章收藏</router-link></li>
                <li @click="To"><router-link to="">商品收藏</router-link></li>
                <li @click="To"><router-link to="">訂單查詢</router-link></li>
            </ul>
        </nav>
        <!-- RWD用鍵 -->
        <div class="userback" @click="backAC">
            <span>返回</span>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // toggle:''
        }
    },
    methods: {
        backAC() {
            document.querySelector('.SliderAC').style.left = '-100%'
        },
        To(e) {
            let title = e.target.innerText
            this.$emit('title-change', title)
            // document.querySelector('.SliderAC').style.left = '-100%'
        }
    }
}
</script>
<style lang="scss">
@import "@/assets/scss/component/slider";
</style>