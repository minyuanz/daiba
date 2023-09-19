<template>
    <div class="SliderAC">
        <div class="pic">
            <img src="https://steam.oxxostudio.tw/webp/gimp/example/simple-keyer-mask-16.webp" />
        </div>
        <h3>NAME</h3>
        <button>登出</button>
        <nav>
            <ul>
                <li :class="{ 'is-acitve': false }" ><router-link to="/Back/BackMember">會員管理</router-link></li>
                <li :class="{ 'is-acitve': false }" ><router-link to="/Back/BackMrt">捷運站管理</router-link></li>
                <li :class="{ 'is-acitve': false }" ><router-link to="/Back/BackFeature">推薦管理</router-link></li>
                <li><router-link to="">商品管理</router-link></li>
                <li><router-link to="">訂單管理</router-link></li>
                <li><router-link to="">消息管理</router-link></li>
                <li><router-link to="">投稿管理</router-link></li>
                <li><router-link to="">權限管理</router-link></li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
        }
    },
    methods: {

    },
    computed: {

    },
}
</script>
<style lang="scss">
.is-acitve {
    background-color: #f00;
}
</style>