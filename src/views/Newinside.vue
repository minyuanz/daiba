<template>
  <div class="newsinWrap">
    <span class="newsinTag title-tag gray">#{{ foundObject.news_tag }}</span>
    <span class="newsindate"> 發佈日期：{{ foundObject.news_date }}</span>
    <h1>{{ foundObject.news_title }}</h1>

    <div class="swiper">
      <div class="newsinpic swiper-wrapper">
        <img :src="foundObject.news_pic1" alt="" class="swiper-slide" />
        <img :src="foundObject.news_pic1" alt="" class="swiper-slide" />
      </div>
      <div class="swiper-pagination"></div>
    </div>

    <div class="newsintxt">
      <p>{{ foundObject.news_des1 }}</p>
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
      newsqaq: ""
      // news: {
      //   tag: "活動消息",
      //   date: "2023-07-07",
      //   title: "植感生活－植物郵票與押花特展",
      //   image: require("../../public/img/newsbackimg.jpg"),
      //   image1: require("../../public/img/news4.png"),
      //   contents:
      //     "綠色植物的生命力，讓人感到快樂與朝氣。為鼓勵大眾親近植物，本館特規劃「植感生活－植物郵票與押花特展」，期透過展出郵票與手作押花作品，使民眾認識植物，推廣香草植物的多元應用與花藝美學，讓生活增添綠意與愜意。",
      // },

    };
  },
  components: {
    ButtonS
  },
  methods: {
    fetchData() {
      fetch(`http://localhost/dai/public/phps/getNews.php`)
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          this.newstest = data; // 更新數據到news
          console.log(this.newstest);
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
    const idToFind = this.$route.params.id;
    console.log(idToFind);
    this.foundObject = news.find(item => item.news_id === idToFind);
    console.log(this.foundObject);
    this.fetchData()
    // console.log(this.newstest);
    // this.newsqaq = this.newstest.find(item => item.news_id === idToFind)

  }
}
</script>

<style lang="scss">
@import "@/assets/scss/page/newsinside";
</style>
