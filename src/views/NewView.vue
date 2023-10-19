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
              <img :src=$imgUrl(news.news_pic1) alt="">
            </div>

            <div class="newsBox">
              <div class="newsCtxTxt">
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
                <!-- <h3>{{ news.news_title }}</h3> -->

                <router-link :to="{ name: 'newinside', params: { id: news.news_id } }">
                  <ButtonS :HTMLInner="btninner" class="rwdbtn" />
                </router-link>
              </div>

              <div class="newsCtxPic">
                <img :src=$imgUrl(news.news_pic1) alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

    <div class="newsBtnlist">
      <button v-for="btn in btns" class="btn_s" @click="changeHandler(btn.tag), showNewsList = !showNewsList">
        {{ btn.tag }}
      </button>
    </div>

    <transition name="fade" mode="out-in">
      <div :key="showNewsList" class="newsList">
        <div class="newsCard" v-for="card in newsdisplay" :key="card.news_id">
          <div class="newsPic">
            <img :src=$imgUrl(card.news_pic1) alt="">
          </div>
          <div class="hover-container" @mouseenter="handleHover(true)" @mouseleave="handleHover(false)">
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
    </transition>

    <!-- <div class="pagination">
      <button class="paginationmain" @click="prevPage" :disabled="currentPage === 1">
        ＜
      </button>
      <button class="paginationmain" @click="goToPage(page)" v-for="page in totalPages" :key="page"
        :class="{ 'current-page': page === currentPage }">
        {{ page }}
      </button>
      <button class="paginationmain" @click="nextPage" :disabled="currentPage === totalPages">
        ＞
      </button>
    </div> -->
  </div>
</template>

<script>
import Swiper from "swiper/bundle";
import news from "@/testdata/news.json";
import ButtonS from '@/components/ButtonS.vue';

export default {
  data() {
    return {
      // pageSize: 4, // 每頁顯示數量
      // currentPage: 1, // 當前頁數
      showNewsList: true,
      btninner: "更多",
      tagtoggle: '所有消息',
      btns: [{
        tag: '所有消息'
      },
      {
        tag: '最新消息'
      },
      {
        tag: '活動消息'
      }],
      // newslist: news,
      newsdisplay: [],//篩選用
      newswiper: [],//輪播用
      newstest: [],
      url: this.$apiUrl('getNews.php')
    }
  },
  components: {
    ButtonS,
  },
  computed: {
    // paginatedNews() {
    //   const startIndex = (this.currentPage - 1) * this.pageSize; //0
    //   const endIndex = startIndex + this.pageSize; //4
    //   return this.newstest.slice(startIndex, endIndex);
    // },
    // totalPages() {
    //   return Math.ceil(this.newstest.length / this.pageSize);
    // },
  },
  methods: {
    // prevPage() {
    //   if (this.currentPage > 1) {
    //     this.currentPage -= 1;
    //   }
    // },
    // nextPage() {
    //   if (this.currentPage < this.totalPages) {
    //     this.currentPage += 1;
    //   }
    // },
    // goToPage(page) {
    //   this.currentPage = page;
    // },
    // 
    changeHandler(tag) {
      // console.log(tag);
      this.tagtoggle = tag !== "最新消息" && tag !== "活動消息" ? "所有消息" : tag;
      let res = this.newstest.filter(item => {
        if (item.news_tag == this.tagtoggle) {
          return true
        } else if (item.news_tag1 == this.tagtoggle) {
          return true
        }
      })
      this.newsdisplay = res
    },
    handleHover(isHovered) {
      // Handle hover events here
      if (isHovered) {
        // Mouse entered
        console.log('Mouse entered');
        // Trigger any hover effect you want
      } else {
        // Mouse left
        console.log('Mouse left');
        // Undo any hover effect you applied
      }
    },
    fetchData() {
      // $apiUrl('getNews.php')
      // http://localhost/dai/public/phps/getNews.php
      // let url = this.$apiUrl('getNews.php')
      fetch(this.$apiUrl('getNews.php'))
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          console.log(data);
          this.newstest = data; //更新數據到news
          this.newsdisplay = this.newstest
          this.newswiper = this.newstest.slice(0, 3)
        })
        .catch((error) => {
          console.error('數據傳輸失敗：', error);
        });
    }
  },
  mounted() {
    // this.newsdisplay = this.newslist
    // this.newswiper = this.newslist.slice(0, 3)
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
    this.fetchData()

  },
}
</script>
<style lang="scss">
@import "@/assets/scss/page/newView";

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to

/* .fade-leave-active 在2.1.8中新增 */
  {
  opacity: 0;
}
</style>
