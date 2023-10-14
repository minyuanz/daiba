<template>
  <!-- 背景色塊 -->
  <!-- <template v-if="$route.name === '/User'"> -->
  <div class="col">
    <div id="col1"></div>
    <div id="col2"></div>
    <div id="col3"></div>
  </div>
  <div class="row">
    <div id="row1"></div>
    <div id="row2"></div>
    <div id="row3"></div>
  </div>
  <!-- <div id="circle"></div> -->
  <!-- </template> -->

  <!-- <div id="circle"></div> -->
  <div class="userWrap">
    <!-- Rwd返回鍵 -->
    <div class="userHam" @click="sliderAC">
      <span>會員自訂</span>
    </div>
    <!-- 左邊選單 -->
    <SliderAC class="userSlider" @title-change="titleUpdate" />
    <!-- 右邊選單 -->
    <!-- 會員資料 -->
    <UserInfo v-if="'會員資料' == title" />
    <!-- 我的投稿 -->
    <ArticleInfo id="ArticleInfo" v-else-if="'我的投稿' == title" />
    <!-- 投稿收藏 -->
    <ArticleCollect v-else-if="'投稿收藏' == title" />
    <!-- 商品收藏 -->
    <ProdCollect v-else-if="'商品收藏' == title" />
    <!-- 訂單查詢 -->
    <orders v-else-if="'訂單查詢' == title" />
  </div>
</template>

<script>
import SliderAC from "@/components/SliderAC.vue";
import UserInfo from "@/components/user/UserInfo.vue";
import ArticleInfo from "@/components/user/ArticleInfo.vue";
import ArticleCollect from "@/components/user/ArticleCollect.vue";
import ProdCollect from "@/components/user/ProdCollect.vue";
import orders from "@/components/user/orders.vue";

export default {
  components: {
    SliderAC,
    UserInfo,
    ArticleInfo,
    ArticleCollect,
    ProdCollect,
    orders
  },
  data() {
    return {
      title: "會員資料",
      memberlist: "",
      member: ""
    };
  },
  computed: {},
  methods: {
    sliderAC() {
      document.querySelector(".userSlider").style.left = "0";
    },
    titleUpdate(title) {
      console.log(title);
      this.title = title;
    },
    fetchMember() {
      // let idToFind = this.$route.params.id;
      let user = localStorage.getItem('user')
      let idToFind = JSON.parse(user).mem_id
      console.log(JSON.parse(user).mem_id);

      // this.$apiUrl('getMember.php')
      fetch(this.$apiUrl('getMember.php'))
        .then(res => res.json())
        .then((res) => {
          this.memberlist = res
          this.member = this.memberlist.find(item => item.mem_id === idToFind)
          this.$store.commit("getInfo", this.member)
        })
        .catch((error) => {
          console.error('傳輸失敗', error)
        })
    }
  },

  mounted() {
    let app = document.getElementById("app");
    // alert(app.clientHeight)
    // // console.log(app.clientHeight)
    let col1 = document.getElementById("col1");
    let col2 = document.getElementById("col2");
    let col3 = document.getElementById("col3");
    let row1 = document.getElementById("row1");
    let row2 = document.getElementById("row2");
    let row3 = document.getElementById("row3");
    col1.style.height = `${app.clientHeight}px`;
    col2.style.height = `${app.clientHeight}px`;
    col3.style.height = `${app.clientHeight}px`;
    row1.style.width = `${app.clientWidth}px`;
    row2.style.width = `${app.clientWidth}px`;
    row3.style.width = `${app.clientWidth}px`;
    // window.addEventListener('resize', () => {
    // })
    this.fetchMember();
  },
};
</script>

<style lang="scss">
@import "@/assets/scss/page/user";
</style>
