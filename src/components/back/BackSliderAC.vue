<template>
    <div class="SliderAC">
        <div class="pic">
            <img src="https://steam.oxxostudio.tw/webp/gimp/example/simple-keyer-mask-16.webp" />
        </div>
        <h3>NAME</h3>
        <button>登出</button>
        <nav>
            <ul>
                <li :class="{ 'is-active': $route.path === '/Back/BackMember' }"><router-link to="/Back/BackMember">會員管理</router-link></li>
                <li :class="{ 'is-active': $route.path === '/Back/BackMrt' }"><router-link to="/Back/BackMrt">捷運站管理</router-link></li>
                <li :class="{ 'is-active': $route.path === '/Back/BackFeature' }"><router-link to="/Back/BackFeature">推薦管理</router-link></li>
                <li :class="{ 'is-active': $route.path === '/Back/BackPro' }"><router-link to="/Back/BackPro">商品管理</router-link></li>
                <li :class="{ 'is-active': $route.path === '/Back/BackOrder' }"><router-link to="/Back/BackOrder">訂單管理</router-link></li>
                <li :class="{ 'is-active': $route.path === '/Back/BackNews' }"><router-link to="/Back/BackNews">消息管理</router-link></li>
                <li :class="{ 'is-active': $route.path === '/Back/BackContri' }"><router-link to="/Back/BackContri">投稿管理</router-link></li>
                <li :class="{ 'is-active': $route.path === '/Back/BackPermission' }"><router-link to="/Back/BackPermission">權限管理</router-link></li>
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
.is-active {
  background-color:  #7d7d7d !important;
}
</style>