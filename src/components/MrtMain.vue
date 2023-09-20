<template>
  <!-- 虛線 -->
  <div class="dottedLineBox">
    <div class="dottedLine"></div>
  </div>
  <!-- 站點板塊 -->
  <div class="mrtWrappo">
    <div class="mrtWrap" v-for="item in mrt">
      <div class="mrtSta">
        <!-- 站點文字介紹 -->
        <div class="mrtStaTxt">
          <h2>{{ item.title }}</h2>
          <p>
            {{ item.txt }}
          </p>
        </div>
        <!-- 站點圖跟捷運圖 -->
        <div class="mrtStaBox" @click="item.isShow = !item.isShow">
          <div class="mrtStaMaruBox">
            <img
              class="mrtStaMaru"
              src="../../public/img/mrt_maru.png"
              alt="mrt_maru"
            />
          </div>
          <div class="mrtStaPicBox">
            <img class="mrtStaPic" :src="item.url" alt="" />
          </div>
        </div>
      </div>
      <!------------------------美食住宿景點卡片 ------------------------------------->

      <div class="swiperMRTCard" v-show="item.isShow">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="itemFood in item.foodCard">
            <div class="mrtCardWrap">
              <!-- 卡片 -->
              <div class="card-h border-r">
                <div class="img">
                  <img :src="itemFood.url" alt="" />
                </div>
                <div class="text">
                  <div class="title">
                    <h3>{{ itemFood.title }}</h3>
                    <div class="tag">
                      <span class="title-tag gray">#景點推薦</span>
                      <span class="title-tag blue">#板南線</span>
                    </div>
                  </div>
                  <div class="txt">{{ itemFood.txt }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-button-prev swiper-btn"></div>
        <div class="swiper-button-next swiper-btn"></div>
      </div>
    </div>
  </div>
</template>

<script>
import Swiper from "swiper/bundle";
export default {
  data() {
    return {
      // 站點迴圈
      mrt: [
        {
          title: "信義安和站",
          txt: "有世界最高建築物的美名長達五年的台北 101 大樓南山廣場、威秀影城、信義微風、誠品百貨、新光三越高檔餐廳、時尚酒吧與夜店等等，大量的建築群拔地而起疊構出最具未來感、新穎的「都心」風貌。",
          url: require("../../public/img/mrt_101.jpg"),
          isShow: false,
          foodCard: [
            {
              title: "雲鼎阿二麻辣食堂",
              txt: "阿二麻辣食堂使用多種中藥食材，精心熬煮麻辣湯頭，有別於一般麻辣火鍋店，招牌麻辣系列分為「麻辣煲」與「麻辣鍋」，也有「藥膳」與「紅燒」系列可以選擇，所有鍋底均可以選擇辣度，主食單點區中的滷肉飯、拌麵，也是雲鼎阿二麻辣食堂中相當具有人氣的品項。",

              url: require("../../src/assets/images/mrtFoodCard/atwo.jpg"),
            },
            {
              title: "烤師傅",
              txt: "有世界最高建築物的美名長達五年的台北101大樓南山廣場、威秀影城、信義微風、誠品百貨、新光三越高檔餐廳、時尚酒吧與夜店等等，大量的建築群拔地而起疊構出最具未來感、新穎的「都心」風貌。",
              url: require("../../src/assets/images/mrtFoodCard/firemaster.jpg"),
            },
            {
              title: "一蘭拉麵",
              txt: "有世界最高建築物的美名長達五年的台北101大樓南山廣場、威秀影城、信義微風、誠品百貨、新光三越高檔餐廳、時尚酒吧與夜店等等，大量的建築群拔地而起疊構出最具未來感、新穎的「都心」風貌。",
              url: require("../../src/assets/images/mrtFoodCard/ichiran.jpg"),
            },
            {
              title: "站著吃韓式烤肉",
              txt: "有世界最高建築物的美名長達五年的台北101大樓南山廣場、威秀影城、信義微風、誠品百貨、新光三越高檔餐廳、時尚酒吧與夜店等等，大量的建築群拔地而起疊構出最具未來感、新穎的「都心」風貌。",
              url: require("../../src/assets/images/mrtFoodCard/standfire.jpg"),
            },
          ],
        },
        {
          title: "中山站",
          txt: "曾經是美國人聚集的美式生活圈，後來又成為日本人匯聚的熱鬧街區，裡面散布著一些風格別具的創意小店，內斂卻多元兼蓄，非常適合徒步於巷弄之中，感受難得的悠閒，探索新舊趣味。",
          url: require("../../public/img/mrt_zhongshan.jpg"),
          isShow: false,
        },
        {
          title: "劍潭站",
          txt: "有台北最大的士林夜市來逛夜市的人大都以美食與購物為主，這裡有各式各樣新奇好玩的商品與美食，吸引大批的人潮。這樣特殊的夜市文化，是臺北夜生活不可缺少的一部份。",
          url: require("../../public/img/mrt_Jiantan.jpg"),
          isShow: false,
        },
      ],
    };
  },
  mounted() {
    const swiperMRTCard = new Swiper(".swiperMRTCard", {
      direction: "horizontal",

      // spaceBetween: -60,
      speed: 500,

      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        375: {
          slidesPerView: 1,
          slidesPerGroup: 1,
          spaceBetween: -130,
        },
        415: {
          slidesPerView: 1,
          slidesPerGroup: 1,
          spaceBetween: 50,
        },
        577: {
          slidesPerView: 2,
          slidesPerGroup: 2,
        },
        769: {
          slidesPerView: 3,
        },
        1281: {
          slidesPerView: 4,
          slidesPerGroup: 4,
        },
      },
    });
  },
};
</script>
