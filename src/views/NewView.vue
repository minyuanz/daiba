<template>
  <div class="newsWrap">
    <h1>消息資訊</h1>
    <div class="newsBanner">

      <div class="swiper">
        <!-- 輪播區塊 -->
        <div class="newsSlider swiper-wrapper">

          <div class="newsCtx swiper-slide" v-for="news in newswiper" :key="news.news_id">

            <!-- 背景模糊 -->
            <div class="newsBackpic">
              <img :src="news.news_pic1" alt="">
            </div>

            <div class="newsBox">
              <div class="newsCtxTxt">

                <router-link :to="{ name: 'newinside', params: { id: news.news_id } }">
                  <div class="toFlex">
                    <div class="newsTag title-tag gray">
                      <span>#{{ news.news_tag1 }}</span>
                    </div>
                    <div class="newsDate">
                      <span>
                        {{ news.news_date }}
                      </span>
                    </div>
                  </div>
                  <h2 class="titleh2">{{ news.news_title }}</h2>
                </router-link>
                <!-- <h3>{{ news.news_title }}</h3> -->

                <router-link :to="{ name: 'newinside', params: { id: news.news_id } }">
                  <ButtonS :HTMLInner="btninner" class="rwdbtn" />
                </router-link>
              </div>

              <div class="newsCtxPic">
                <img :src="news.news_pic1" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

    <div class="newsBtnlist">
      <button v-for="btn in btns" class="btn_s" @click="changeHandler(btn.tag)">
        {{ btn.tag }}
      </button>
    </div>

    <div class="newsList">
      <div class="newsCard" v-for="card in newsdisplay" :key="card.news_id">
        <div class="newsPic">
          <img :src="card.news_pic1" alt="">
        </div>
        <router-link :to="{ name: 'newinside', params: { id: card.news_id } }">
          <div class="newsTxt">
            <div class="toFlex">
              <div class="newsTag title-tag gray">
                <span>
                  #{{ card.news_tag1 }}
                </span>
              </div>
              <div class="newsDate">
                <span>
                  {{ card.news_date }}
                </span>
              </div>
            </div>

            <h3 class="newsTitle">
              {{ card.news_title }}
            </h3>
            <p class="newsCtx">
              {{ card.news_des1 }}
            </p>
          </div>
          <router-link :to="{ name: 'newinside', params: { id: card.news_id } }">
            <ButtonS :HTMLInner="btninner" />
          </router-link>
        </router-link>
      </div>
    </div>

  </div>
  <!-- <Page :total="40" size="small" /> -->
</template>

<script>
import Swiper from "swiper/bundle";
import news from "@/testdata/news.json";
import ButtonS from '@/components/ButtonS.vue';

export default {
  data() {
    return {
      btninner: "更多",
      publicPath: process.env.BASE_URL,
      tagtoggle: '所有消息',
      slider: [{
        tag: '活動消息',
        date: '2023-07-04',
        title: '植感生活',
        title2: '－植物郵票與押花特展',
        image: require('../../public/img/newsbackimg.jpg')
      },
      {
        tag: '活動消息2',
        date: '2023-07-04',
        title: '植感生活',
        title2: '－植物郵票與押花特展',
        image: require('../../public/img/newsbackimg2.png')
        // image: '../img/newsbackimg2.png'
      },
      {
        tag: '活動消息3',
        date: '2023-07-04',
        title: '植感生活',
        title2: '－植物郵票與押花特展',
        image: require('../../public/img/newsbackimg.jpg')
      }
      ],
      btns: [{
        tag: '所有消息'
      },
      {
        tag: '最新消息'
      },
      {
        tag: '活動消息'
      }],
      newslist: news,
      newsdisplay: [],
      newswiper: [],
    }
  },
  components: {
    ButtonS
  },
  methods: {
    changeHandler(tag) {
      // console.log(tag);
      this.tagtoggle = tag !== "最新消息" && tag !== "活動消息" ? "所有消息" : tag;
      let res = this.newslist.filter(item => {
        if (item.news_tag == this.tagtoggle) {
          return true
        } else if (item.news_tag1 == this.tagtoggle) {
          return true
        }
      })
      this.newsdisplay = res
    }
  },
  mounted() {
    this.newsdisplay = this.newslist
    this.newswiper = this.newslist.slice(0, 3)
    const swiper = new Swiper(".swiper", {
      // Optional parameters
      direction: "horizontal",
      speed: 1500,
      loop: true,
      slidesPerView: 1,
      spaceBetween: 0,
      autoplay: {
        delay: 3000
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      // scrollbar: {
      //   // dragcClass:'.swiper-scrollbar'
      //   el: '.swiper-scrollbar'
      // },
      initialSlide: 0, //第一個顯示的畫面,
      breakpoints: { //width:414px顯示一個
        414: {
          slidesPerView: 1
        }
      }
    });
  },
}
</script>
<style lang="scss">
@import "@/assets/scss/page/newView";
</style>
