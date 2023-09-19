<template>
  <section class="CBWrapper">
      <h1>投稿熱門</h1>
      <div class="swiperBanner">
          <div class="swiper-wrapper">
              <div class="swiper-slide" v-for="(taipeis, taipeisIndex) in swipers" :key="taipeisIndex"
                  :class="{ even: evenPic(taipeisIndex) }">
                  <div class="pic">
                      <img :src="taipeis.image" :alt="taipeis.CTName" />
                      <div class="info">
                          <div class="tag">
                              <span v-for="(MRTline, lineIndex) in taipeis.station" :key="lineIndex"
                                  :class="getClassObject(taipeis.line, lineIndex)">{{ MRTline }}</span>
                          </div>
                          <p>{{ taipeis.CTName }}</p>
                          <p class="en">{{ taipeis.ENName }}</p>
                      </div>
                  </div>
              </div>
              <div class="swiper-slide" v-for="(taipeis, taipeisIndex) in swipers" :key="taipeisIndex"
                  :class="{ even: evenPic(taipeisIndex) }">
                  <div class="pic">
                      <img :src="taipeis.image" :alt="taipeis.CTName" />
                      <div class="info">
                          <div class="tag">
                              <span v-for="(MRTline, lineIndex) in taipeis.station" :key="lineIndex"
                                  :class="getClassObject(taipeis.line, lineIndex)">{{ MRTline }}</span>
                          </div>
                          <p>{{ taipeis.CTName }}</p>
                          <p class="en">{{ taipeis.ENName }}</p>
                      </div>
                  </div>
              </div>
              <div class="swiper-slide" v-for="(taipeis, taipeisIndex) in swipers" :key="taipeisIndex"
                  :class="{ even: evenPic(taipeisIndex) }">
                  <div class="pic">
                      <img :src="taipeis.image" :alt="taipeis.CTName" />
                      <div class="info">
                          <div class="tag">
                              <span v-for="(MRTline, lineIndex) in taipeis.station" :key="lineIndex"
                                  :class="getClassObject(taipeis.line, lineIndex)">{{ MRTline }}</span>
                          </div>
                          <p>{{ taipeis.CTName }}</p>
                          <p class="en">{{ taipeis.ENName }}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div v-show="closeTxt" class="talk">
          <p>
              還有其他推薦的捷運美食、景點與住宿嗎？<br />
              來與大家分享你私心推薦的站點吧！
          </p>
          <span @click="closeTxt = !closeTxt">✖</span>
      </div>
      <div class="toCB">
          <router-link to="/Submit" class="btn_s">我要投稿</router-link>
      </div>
  </section>

  <section class="CBArea">
      <div class="CBTitle">
          <h2>投稿專欄</h2>
          <div>
              <span v-for="(CBtag, tagindex) in CBtag" :key="tagindex" class="gray">#{{ CBtag }}</span>
          </div>
          <div>
              <span v-for="(MRTLine, MRTLineindex) in MRTLine" :key="MRTLineindex"
                  :class="getClassObject(MRTLine, MRTLineindex)">#{{ MRTLine }}</span>
          </div>
      </div>
      <div class="CBList">
          <div class="card-w" v-for=" in 8" @click="(closePost = !closePost), (lightBox = !lightBox)">
              <div class="img">
                  <img src="https://picsum.photos/200/280/?random=10" />
              </div>
              <div class="text">
                  <div class="title">
                      <h3>五分埔商圈購物</h3>
                      <p>台北成衣街｜衣服、飾品、配件、包包、帽子批發</p>
                      <div class="tag">
                          <span class="title-tag gray">#景點推薦</span>
                          <span class="title-tag blue">#板南線</span>
                      </div>
                      <span class="s_text time">2020-06-15</span>
                  </div>
                  <div class="txt">
                      　　那天逛完華山KAKAO敗家後，就心血來潮到五分埔去逛逛，真的是久違了好多年，以前學生時期過年領完紅包，一定都是最期待來到五分埔買衣服！如今後來才知道原來這裡除了一般民眾、觀光客買購物衣服的地方以外，原來也有成衣批發商圈，那天去晃晃除了衣服之外，還有包包、飾品、鞋子等等。
                  </div>
                  <img src="https://picsum.photos/80/80/?random=10" class="head" />
              </div>
          </div>
          <div class="CBPost" v-show="closePost">
              <div class="box">
                  <div class="swiperPost">
                      <div class="swiper-wrapper">
                          <div class="swiper-slide">
                              <img src="/img/ice noodle jelly.jpg" />
                          </div>
                          <div class="swiper-slide">
                              <img src="/img/ice noodle jelly.jpg" />
                          </div>
                          <div class="swiper-slide">
                              <img src="/img/ice noodle jelly.jpg" />
                          </div>
                      </div>
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-button-next"></div>
                  </div>
                  <div class="inner">
                      <div class="title">
                          <h3>萬華無名粉條冰</h3>
                          <span class="closePost" @click="(closePost = !closePost), (lightBox = !lightBox)">✖</span>
                          <h4>季節限定手工刀削冰口感特別，冰料全自製自煮！</h4>
                      </div>
                      <div class="info">
                          <p>景點：萬華無名手工粉條冰</p>
                          <p>地址：萬華興寧街上雙園市場騎樓前</p>
                          <p>電話：(02)2988-2222</p>
                          <span class="PostingDate">發布日期：2020-06-15</span>
                      </div>
                      <div class="txt">
                          <p>
                              無名手工刀削冰座落於萬華興寧街上雙園市場騎樓前，這天來訪周邊坐了不少在騎樓下納涼閒聊的老人家，不過實際上前購買的就只僅我與同事，坦白說還蠻令我意外的。
                              <br />（因為之前看媒體報導人潮都不少）<br />
                              （2023年再訪陸續都有人買生意很不錯）
                          </p>
                      </div>
                      <div class="author">
                          <div class="line"></div>
                          <span>TIM SMITH JR.</span>
                      </div>
                      <img src="https://picsum.photos/200/200/?random=10" class="head" />
                  </div>
              </div>
          </div>
      </div>
  </section>

  <div class="lightBox" v-show="lightBox"></div>

  <div class="mrtBanner">
      <div class="swiper" id="mySwiper">
          <div class="swiper-wrapper">
              <div class="swiper-slide" v-for=" in 20">
                  <img src="../../public/img/mrtArrow2.png" alt="" />
              </div>
          </div>
      </div>
  </div>

  <div class="mrtBanner">
      <div class="swiper" id="mySwiper2">
          <div class="swiper-wrapper">
              <div class="swiper-slide" v-for=" in 20">
                  <img src="../../public/img/mrtArrow2.png" alt="" />
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import { faL } from "@fortawesome/free-solid-svg-icons";
import Swiper from "swiper/bundle";
export default {
  data() {
      return {
          swipers: [
              {
                  image: "../img/Grand Hyatt Taipei.jpg",
                  station: ["BL12", "R10"],
                  line: ["板南線", "淡水信義線"],
                  tag: "住宿",
                  ENName: "Palais de Chine Hotel Taipei",
                  CTName: "君品酒店",
              },
              {
                  image: "../img/Humble Boutique Hotel.jpg",
                  station: ["G15", "O08"],
                  line: ["松山新店線", "中和新蘆線"],
                  tag: "住宿",
                  ENName: "Humble Boutique Hotel",
                  CTName: "寒居酒店",
              },
              {
                  image: "../img/Xiangshan.png",
                  station: ["R02"],
                  line: ["淡水信義線"],
                  tag: "景點",
                  ENName: "Xiangshan",
                  CTName: "象山",
              },
              {
                  image: "../img/Gui.jpg",
                  station: ["R12"],
                  line: ["淡水信義線"],
                  tag: "美食",
                  ENName: "Cheng Zong The Canned Rice Cake",
                  CTName: "正宗筒仔米糕",
              },
              {
                  image: "../img/National monument.jpg",
                  station: ["G10", "R08"],
                  line: ["松山新店線", "淡水信義線"],
                  tag: "景點",
                  ENName: "National monument",
                  CTName: "中正紀念堂",
              },
              {
                  image: "../img/Wagui.jpg",
                  station: ["G19"],
                  line: ["松山新店線"],
                  tag: "美食",
                  ENName: "Raohe St. Night Market Savory Rice Pudding",
                  CTName: "饒河碗糕關東煮",
              },
              {
                  image: "../img/Taipei Park.jpg",
                  station: ["R16"],
                  line: ["淡水信義線"],
                  tag: "景點",
                  ENName: "Taipei Children's Amusement Park",
                  CTName: "台北兒童新樂園",
              },
              {
                  image: "../img/zoo.jpg",
                  station: ["BR01"],
                  line: ["文湖線"],
                  tag: "景點",
                  ENName: "Taipei Zoo",
                  CTName: "台北市立動物園",
              },
          ],
          colorClassMap: {
              板南線: "blue",
              淡水信義線: "red",
              松山新店線: "green",
              中和新蘆線: "orange",
              文湖線: "brown",
              環狀線: "yellow",
          },
          CBtag: ["所有文章", "美食推薦", "景點推薦", "住宿推薦"],
          MRTLine: [
              "中和新蘆線",
              "淡水信義線",
              "松山新店線",
              "板南線",
              "文湖線",
              "環狀線",
          ],
          closeTxt: true,
          closePost: false,
          lightBox: false,
      };
  },
  methods: {
      evenPic(taipeisIndex) {
          return taipeisIndex % 2 === 0;
      },
      getClassObject(colors, lineIndex) {
          const color = colors[lineIndex];
          const lineColor = this.colorClassMap[color];
          const lineColorTag = this.colorClassMap[colors];
          if (Array.isArray(colors)) {
              return lineColor;
          } else {
              return lineColorTag;
          }
      },
  },

  mounted() {
      const swiperBanner = new Swiper(".swiperBanner", {
          direction: "horizontal",
          speed: 2000,
          loop: true,
          slidesPerView: "auto",
          spaceBetween: -1,
          allowTouchMove: false,
          loopedSlides: 5,
          autoplay: {
              delay: 0,
              pauseOnMouseEnter: true,
              disableOnInteraction: false,
          },
      });
      const swiperPost = new Swiper(".swiperPost", {
          effect: "cube",
          cubeEffect: {
              shadow: true,
              slideShadows: true,
              shadowOffset: 20,
              shadowScale: 0.94,
          },
          navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
          },
      });
      const swiper = new Swiper(".swiper", {
          direction: "vertical",
          speed: 2000,
          loop: true,
          loopedSlides: 10,
          // autoHeight: true,
          slidesPerView: "auto",
          spaceBetween: 0,
          autoplay: {
              delay: 0,
              pauseOnMouseEnter: false,
              disableOnInteraction: false,
          },
      });
  },
};
</script>
