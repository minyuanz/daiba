<template>
  <div class="bSliderAC">
    <div class="pic">
      <img src="../../../public/img/logo.png" />
    </div>
    <h3>{{ loggedInUser }}</h3>
    <!-- <router-link to="/Back/BackLogin" > -->
    <button @click="logout">登出</button>
    <!-- </router-link> -->
    <nav>
      <ul>
        <router-link
          to="/Back/BackMember"
          :class="{ 'is-active': $route.path === '/Back/BackMember' }"
        >
          <li>會員管理</li>
        </router-link>

        <router-link
          to="/Back/BackMrt"
          :class="{ 'is-active': $route.path === '/Back/BackMrt' }"
        >
          <li>捷運站管理</li>
        </router-link>

        <router-link
          to="/Back/BackFeature"
          :class="{ 'is-active': $route.path === '/Back/BackFeature' }"
        >
          <li>推薦管理</li>
        </router-link>

        <router-link
          to="/Back/BackPro"
          :class="{ 'is-active': $route.path === '/Back/BackPro' }"
        >
          <li>商品管理</li>
        </router-link>

        <router-link
          to="/Back/BackOrder"
          :class="{ 'is-active': $route.path === '/Back/BackOrder' }"
        >
          <li>訂單管理</li>
        </router-link>

        <router-link
          to="/Back/BackNews"
          :class="{ 'is-active': $route.path === '/Back/BackNews' }"
        >
          <li>消息管理</li>
        </router-link>

        <router-link
          to="/Back/BackContri"
          :class="{ 'is-active': $route.path === '/Back/BackContri' }"
        >
          <li>投稿管理</li>
        </router-link>

        <router-link
          to="/Back/BackPermission"
          :class="{ 'is-active': $route.path === '/Back/BackPermission' }"
        >
          <li>權限管理</li>
        </router-link>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    logout() {
      //清除vuex狀態
      this.$store.commit("setLoggedInUser", null);

      // 清除loco狀態
      localStorage.removeItem("BackloginContent");

      // 然後導向登入頁面
      this.$router.push("/Back/BackLogin");
    },
  },
  computed: {
    loggedInUser() {
      // 從loco獲取數據 帶入名字
      const storedUser = localStorage.getItem("BackloginContent");
      return storedUser ? JSON.parse(storedUser).acc : "";
    },
  },
  created() {
    // 在網頁渲染前，檢查loco是否有登入訊息
    const storedUser = localStorage.getItem("BackloginContent");
    if (storedUser) {
      const user = JSON.parse(storedUser).acc;
      // 將訊息設置到 Vuex 中
      this.$store.commit("setLoggedInUser", user);
    }
  },
};
</script>
<style lang="scss">
.is-active {
  background-color: #7d7d7d !important;
  color: white;
}

// .router-link-exact-acitve {
//   background-color: #f00;
// }
</style>
