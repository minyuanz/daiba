<template>
  <div class="newsinWrap">
    <span class="newsinTag title-tag gray">#{{ newsqaq.news_tag1 }}</span>
    <span class="newsindate"> 發佈日期：{{ newsqaq.news_date }}</span>
    <h1>{{ newsqaq.news_title }}</h1>

    <div class="swiper">
      <div class="newsinpic swiper-wrapper">
        <img :src="newsqaq.news_pic1" alt="" class="swiper-slide" />
        <img :src="newsqaq.news_pic1" alt="" class="swiper-slide" />
      </div>
      <div class="swiper-pagination"></div>
    </div>

    <div class="newsintxt">
      <p>{{ newsqaq.news_des1 }}</p>
    </div>

    <div class="newsinBtn">
      <!-- <button class="btn_s"> -->
      <router-link to="/home">
        <ButtonS :HTMLInner="btninner" />
      </router-link>
      <!-- </button> -->
      <router-link to="/new">
        <button class="btn_s">
          消息一覽
        </button>
      </router-link>
    </div>
  </div>
</template>

<script>
import Swiper from "swiper/bundle";
import news from "@/testdata/news.json";
import ButtonS from '@/components/ButtonS.vue';
export default {
  data() {
    return {
      btninner: "官方網站",
      publicPath: process.env.BASE_URL,
      foundObject: "",
      newstest: "",
      newsqaq: "",
    };
  },
  components: {
    ButtonS
  },
  methods: {
    fetchData() {
      // 獲得newsinside/id的id值
      let idToFind = this.$route.params.id;
      // 獲得資料庫的消息列表
      fetch(`http://localhost/dai/public/phps/getNews.php`)
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          // 更新數據到newstest
          this.newstest = data;
          // 提出newstest資料中news_id等於idToFind的那筆放進newsqaq
          this.newsqaq = this.newstest.find(item => item.news_id === idToFind)
          // this.foundObject = this.newstest.find(item => item.news_id === idToFind);

        })
        .catch((error) => {
          console.error('數據傳輸失敗：', error);
        })
    },
  },
  mounted() {
    const swiper = new Swiper(".swiper", {
      direction: "horizontal",
      speed: 1500,
      loop: true,
      autoplay: {
        delay: 3000,
      },
      slidesPerView: 1,
      spaceBetween: 0,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    })
    // console.log(this.newstest);
    let idToFind = this.$route.params.id;
    console.log(idToFind);
    // this.fetchData()
    this.foundObject = news.find(item => item.news_id === idToFind);
    // console.log(this.foundObject);
    this.fetchData()
  }
  , created() {
    // console.log(this.newstest);

  },
}
</script>

<style lang="scss">
@import "@/assets/scss/page/newsinside";
</style>
