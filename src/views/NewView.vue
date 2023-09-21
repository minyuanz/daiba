<template>
  <div class="newsWrap">
    <h1>消息資訊</h1>
    <div class="newsBanner">

      <div class="swiper">
        <!-- 輪播區塊 -->
        <div class="newsSlider swiper-wrapper">

          <div class="newsCtx swiper-slide" v-for="news in slider">

            <!-- 背景模糊 -->
            <div class="newsBackpic">
              <img :src="news.image" alt="">
            </div>
            
            <a href="/Newinside" class="newsBox">
              <div class="newsCtxTxt">
                <div class="newsTag title-tag gray">
                  <span>#{{ news.tag }}</span>
                </div>
                <div class="newsDate">
                  <span>
                    {{ news.date }}
                  </span>
                </div>
                <h2>{{ news.title }}</h2>
                <h3>{{ news.title2 }}</h3>
                <a href="/Newinside" class="btn_s">更多</a>
              </div>

              <div class="newsCtxPic">
                <img :src="news.image" alt="">
              </div>

            </a>
          </div>

        </div>
        <div class="swiper-scrollbar"></div>

      </div>

    </div>

    <div class="newsBtnlist">
      <button v-for="btn in btns" class="btn_s" @click="changeHandler(btn.tag)">
        {{ btn.tag }}
      </button>
    </div>

    <div class="newsList">
      <a href="/Newinside" class="newsCard" v-for="card in newsdisplay">

        <div class="newsPic">
          <img :src="card.image" alt="">
        </div>
        <div class="newsTxt">
          <!-- <div class="newsTag title-tag gray">
            <span>
              #{{ card.tag }}
            </span>
          </div> -->
          <div class="newsTag title-tag gray">
            <span>
              #{{ card.tag1 }}
            </span>
          </div>
          <div class="newsDate">
            <span>
              {{ card.date }}
            </span>
          </div>
          <h3 class="newsTitle">
            {{ card.title }}
          </h3>
          <p class="newsCtx">
            {{ card.contents }}
          </p>
          <a href="/Newinside" class="btn_s">
            更多
          </a>
        </div>
      </a>


    </div>

  </div>
  <!-- <Page :total="40" size="small" /> -->
</template>

<script>
import Swiper from "swiper/bundle";

export default {
  data() {
    return {
      tagtoggle: '所有消息',
      slider: [{
        tag: '活動消息',
        date: '2023-07-04',
        title: '植感生活',
        title2: '－植物郵票與押花特展',
        image: '../img/newsbackimg.png'
      },
      {
        tag: '活動消息2',
        date: '2023-07-04',
        title: '植感生活',
        title2: '－植物郵票與押花特展',
        image: '../img/newsbackimg2.png'
      },
      {
        tag: '活動消息3',
        date: '2023-07-04',
        title: '植感生活',
        title2: '－植物郵票與押花特展',
        image: '../img/newsbackimg.png'
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
      news: [{
        tag: '所有消息',
        tag1: '活動消息',
        date: '2023-09-09',
        title: '止觀-堉泉個展',
        contents: '久⽯讓在《感動，如此創造》書中開篇提到：「創作者依循個⼈的信念、價值觀，去追求⾃我滿意的作品。但⽤此態度創作出的作品，也許讓⼈無法理解，也可能會花上漫長的時間才能完成⼀部作品。因此，秉持這種態度創作時，必然不會考慮付出成本及產量多寡的問題。所謂的藝術家，指的就是朝此⽅向前進的⼈。」',
        image: '../img/news1.png'
      },
      {
        tag: '所有消息',
        tag1: '最新消息',
        date: '2023-09-04',
        title: '歐亞水獺雙姝剛滿月，新手媽媽「金萌」超級忙',
        contents: '2019年11月13日透過林務局野生動物救傷收容計畫，被安置到臺北市立動物園保育研究中心的金門歐亞水獺寶寶「金萌」，今2023年7月28日傍晚六點左右，在巢箱中生了第一隻小寶寶，時隔六個小時後，在半夜12點又產下了第二隻，兩隻歐亞水獺寶寶為姊妹，目前活力充沛穩定成長中。',
        image: '../img/news2.png'
      },
      {
        tag: '所有消息',
        tag1: '活動消息',
        date: '2023-08-17',
        title: '比喻之光：逐光追影及它義 ',
        contents: '攝影沒有光就無法成影，唯有借助光才能產生影像、、影子，光是影的源頭，影則是光的見證。然而，沒有攝影者經由暗箱或是照相機（當今攝影機具眾多，連手機皆可拍照）捕捉這些光，就無法形成影像，凝固這一道道的光，絕非僅是出自意外或偶然。',
        image: '../img/news3.png'
      }],
      newsdisplay: []
    }
  },
  methods: {
    changeHandler(tag) {
      // console.log(tag);
      this.tagtoggle = tag !== "最新消息" && tag !== "活動消息" ? "所有消息" : tag;
      //v-show="card.tag1 == tagtoggle"
      // console.log(this.tagtoggle);

      let res = this.news.filter(item => {
        if (item.tag == this.tagtoggle) {
          return true
        } else if (item.tag1 == this.tagtoggle) {
          return true
        }
      })
      this.newsdisplay = res
      // console.log(res)
    }
  },
  mounted() {
    this.newsdisplay = this.news
    const swiper = new Swiper(".swiper", {
      // Optional parameters
      direction: "horizontal",
      speed: 1500,
      loop: true,
      slidesPerView: 1,
      spaceBetween: 0,
      scrollbar: {
        // dragcClass:'.swiper-scrollbar'
        el: '.swiper-scrollbar'
      },
      initialSlide: 0, //第一個顯示的畫面,
      // grabCursor: true,
      breakpoints: { //width:414px顯示一個
        414: {
          slidesPerView: 1
        }
      }
      //改變游標
      // autoplay: {
      //   delay: 0,
      //   pauseOnMouseEnter: true,
      //   disableOnInteraction: false,
      // },
    });
  },
}
</script>
<style></style>
