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
  <div id="circle"></div>
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
    <!--會員資料 -->
    <UserInfo v-if="'會員資料' == title" />
    <!-- 投稿文章 -->
    <ArticleInfo id="ArticleInfo" v-else-if="'投稿文章' == title" />
    <!-- 文章收藏 -->
  </div>
</template>

<script>
import SliderAC from "@/components/SliderAC.vue";
import UserInfo from "@/components/UserInfo.vue";
import ArticleInfo from "@/components/ArticleInfo.vue";

export default {
  components: {
    SliderAC,
    UserInfo,
    ArticleInfo,
  },
  data() {
    return {
      title: "會員資料",
    };
  },
  computed: {},
  methods: {
    sliderAC() {
      // console.log(111)
      document.querySelector(".userSlider").style.left = "0";
    },
    titleUpdate(title) {
      console.log(title);
      this.title = title;
    },
  },
  mounted() {
    let app = document.getElementById("app");
    // // alert(window.innerWidth)
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
  },
};
</script>

<style lang="scss">
@media screen and (max-width: 414px) {
  #col1,
  #col2,
  #col3,
  #row1,
  #row2,
  #row3,
  #circle {
    display: none;
  }

  .userWrap {
    width: 100%;
    position: relative;

    .userHam {
      /* border: 1px solid red; */
      display: block;
      writing-mode: vertical-lr;
      position: absolute;
      top: 30px;
      left: 10px;
      height: 100px;
      text-align: center;

      &::before {
        content: "";
        position: absolute;
        top: -30px;
        left: -10px;
        width: 15px;
        height: 150%;
        background-image: linear-gradient(
          #a87b52 5%,
          #dd4d54 10%,
          #ffbb33 30%,
          #fff04b 45%,
          #4bc887 70%,
          #32c8e1 85%,
          #9164cd
        );
        /* border: 1px solid red; */
      }
    }

    .userSlider {
      /* display: none; */
      width: 100%;
      position: absolute;
      top: -20px;
      left: -100%;
      transition: 1s;
      z-index: 999;
      height: calc(100vh - 125px);
    }
  }
}
</style>
