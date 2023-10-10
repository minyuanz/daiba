<template>
    <div class="bSliderAC">
        <div class="pic">
            <img src="../../../public/img/logo.png" />
        </div>
        <h3>{{ $store.state.loggedInUser }}</h3>
        <!-- <router-link to="/Back/BackLogin" > -->
        <button @click="logout">登出</button>
        <!-- </router-link> -->
        <nav>
            <ul>
                <li :class="{ 'is-active': $route.path === '/Back/BackMember' }"><router-link to="/Back/BackMember" :class="{ 'is-active': $route.path === '/Back/BackMember' }">會員管理</router-link></li>
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
        logout() {
      //清除vuex狀態
      this.$store.commit('setLoggedInUser', null);

      // 清除loco狀態
      localStorage.removeItem('BackloginContent');

      // 然後導向登入頁面
      this.$router.push('/Back/BackLogin');
    },
    },
    computed: {

    },
}
</script>
<style lang="scss">
.is-active {
  background-color:  #7d7d7d !important;
  a{
    color: #fff;
  }
}
.router-link-exact-acitve{
    background-color: #f00;
}

</style>