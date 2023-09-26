<template>
    <div class="BackNews">
        <div class="NewsSearch">
            投稿編號查詢:
            <input type="text">
            <button class ="NewsSearchBtn">查詢</button>
        </div>
        <div class="NewsTitle">
            <p>編號</p>
            <p>類別</p>
            <p>文章標題</p>
            <p>投稿者</p>
            <p>投稿日期</p>
            <p>文章內容</p>
            <p>核准狀態</p>
        </div>
        <div class="NewsInfro"  v-for="item  in item "  :key="item.pord_id">
            <p>{{ item.prod_id }}</p>
            <p>{{ item.prod_type }}</p>
            <p>{{ item.prod_name }}</p>
            <p>{{ item.prod_id }}</p>
            <p>{{ item.prod_date }}</p>
            <div>
                <button @click="showItemDetail(item)" >查閱</button>
            </div>    
            <div class="upcheck">
                <label class="ios-switch">
                <input type="checkbox" v-model="item.isChecked" />
                <span class="slider"></span>
                </label>
            </div>
        </div>
        <div class="backContri">
            <div class="CBPost" v-show="closePost">
              <div class="box">
                  <div class="swiperPost">
                      <div class="swiper-wrapper">
                          <div class="swiper-slide">
                              <img :src="selectedItem.prod_img1" />
                          </div>
                          <div class="swiper-slide">
                              <img :src="selectedItem.prod_img2" />
                          </div>
                          <div class="swiper-slide">
                              <img :src="selectedItem.prod_img3" />
                          </div>
                          <div class="swiper-slide">
                              <img :src="selectedItem.prod_img4" />
                          </div>
                      </div>
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-button-next"></div>
                  </div>
                  <div class="inner">
                      <div class="title">
                          <h3>{{ selectedItem.prod_name }}</h3>
                          <span class="closePost" @click="(closePost = !closePost), (lightBox = !lightBox)">✖</span>
                          <h4>季節限定手工刀削冰口感特別，冰料全自製自煮！</h4>
                      </div>
                      <div class="info">
                          <p>景點：萬華無名手工粉條冰</p>
                          <p>地址：萬華興寧街上雙園市場騎樓前</p>
                          <p>電話：(02)2988-2222</p>
                          <span class="PostingDate">發布日期：{{ selectedItem.prod_date }}</span>
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
    </div>
</template>

<script>
import BackProTest from "@/testdata/BackProTest.json"
import Swiper from "swiper/bundle";
export default {
    data() {
        return {
            selectedItem: {}, //用於保存資料
            closePost:false,
            item:BackProTest,
            items: BackProTest.map((item) => ({...item,isChecked: false,})), 

        }
    },
    mounted() {
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
        },
        methods: {
    showItemDetail(item) {
      this.selectedItem = { ...item }; //拷貝目標訊息
      this.closePost = true; //顯示點擊項目資料
    },
  },
}
</script>

<style lang="scss">
.BackNews {
    margin-top: 3rem;
    border: 1px solid #aaa;
    background-color: #fff;
    width: 900px;
    padding: 50px;
    .NewsSearch{
    padding: 10px; 
    .NewsSearchBtn{
    width: 80px;
    height: 28px;
    margin-left: 10px;
    }
    }
    .NewsTitle {
        display: flex;
        justify-content: space-evenly;
        background-color: #ddd;
        padding: 5px 0;

        p {
            width: 100%;
            text-align: center;
        }
    }

    .NewsInfro {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        padding: 5px 0;
        border-bottom: 1px solid #aaa;

        div,
        p {
            width: 100%;
            text-align: center;
            button{
                width: 70px;
                height: 40px;
            }
        }
        .ios-switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 30px;
  background-color: #ccc;
  border-radius: 15px;
}

.ios-switch input {
  display: none;
}

.ios-switch .slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #565656;
  border-radius: 15px;
  transition: 0.4s;
}

.ios-switch input:checked + .slider {
  background-color: #4CAF50;
}

.ios-switch .slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  border-radius: 50%;
  transition: 0.4s;
}

.ios-switch input:checked + .slider:before {
  transform: translateX(30px);
}
    }
}

.backContri{
    .CBPost {
      width: 1200px;
      height: 80%;
      background-color: #d9d9d9;
      padding: 30px;
      display: flex;
      justify-self: center;
      align-items: center;
      position: fixed;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      margin: auto;
      z-index: 10;

      .box {
          width: 100%;
          height: 100%;
          display: flex;
          justify-content: center;
          align-items: center;
          background-color: #fff;
          padding: 20px;

          .swiperPost {
              width: 480px;
              // height: 680px;
              margin-right: 50px;

              .swiper-slide {
                  img {
                      width: 100%;
                      height: 100%;
                  }
              }
          }

          .inner {
              // height: 680px;

              p {
                  font-size: 18px;
              }

              .title {
                  border-top: 30px solid map-get($color, $key: success);
                  border-left: 30px solid map-get($color, $key: success);
                  padding-top: 20px;
                  padding-inline: 20px;
                  position: relative;

                  h3 {
                      font-size: map-get($fontsizes, h2);
                      line-height: 70px;
                  }

                  h4 {
                      font-size: map-get($fontsizes, h4);
                  }

                  .closePost {
                      background-color: black;
                      font-size: 50px;
                      font-weight: 1000;
                      color: #fff;
                      border-radius: 50px;
                      width: 60px;
                      height: 60px;
                      display: inline-block;
                      position: absolute;
                      text-align: center;
                      line-height: 50px;
                      right: -5%;
                      top: -35%;
                      cursor: pointer;
                  }
              }

              .info {
                  background-color: #fff;
                  padding-left: 50px;
                  padding-right: 20px;
                  padding-top: 30px;
                  padding-bottom: 10px;
                  width: 100%;
                  height: 200px;
                  display: inline-grid;
                  position: relative;

                  .PostingDate {
                      display: block;
                      margin-top: auto;
                      text-align: end;
                      color: #999;
                      padding-block: 10px;
                  }
              }

              .info::before {
                  content: "";
                  background-image: url("~@/assets/images/Line.svg");
                  width: 520px;
                  height: 2px;
                  position: absolute;
                  bottom: 0;
                  left: 9%;
              }

              .txt {
                  padding-left: 50px;
                  padding-right: 20px;
                  height: 280px;

                  p {
                      text-indent: 2em;
                      padding-top: 20px;
                  }
              }

              .author {
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
                  padding-left: 50px;
                  padding-right: 50px;
                  height: 50px;

                  .line {
                      width: 300px;
                      height: 12px;
                      background-color: map-get($color, $key: success);
                  }

                  span {
                      font-size: 24px;
                      font-weight: 900;
                  }
              }

              .head {
                  position: absolute;
                  border-radius: 50%;
                  width: 120px;
                  height: 120px;
                  bottom: -2%;
                  right: -2%;
                  border: 6px solid #333;
              }
          }
      }
  }
}
</style>