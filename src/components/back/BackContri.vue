<template>
  <div class="BackNews">
    <div class="NewsSearch">
      投稿編號查詢:
      <input type="text" v-model="search" />
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
    <div class="NewsInfro" v-for="item in filter" :key="item.art_id">
      <p>{{ item.art_id }}</p>
      <p>{{ item.fea_tag }}</p>
      <p>{{ item.art_title }}</p>
      <p>{{ item.mem_name }}</p>
      <p>{{ item.art_date }}</p>
      <div>
        <button @click="showItemDetail(item)">查閱</button>
      </div>
      <div class="upcheck">
        <label class="ios-switch">
          <input type="checkbox" :checked="item.art_status === '1'" @change="togglePermission(item)" />
          <span class="slider" :style="{
            backgroundColor: item.art_status === '1' ? '#4CAF50' : '#565656',
          }"></span>
        </label>
      </div>
    </div>
    <div class="backContri">
      <div class="CBPost" v-show="closePost">
                <div class="box">
                    <img v-if="selectedItem.mem_img" :src=$imgUrl(selectedItem.mem_img) class="head" />
                    <img v-else :src=$imgUrl(userImg) class="head" />
                    <span class="closePost" @click="(closePost = !closePost), (lightBox = !lightBox)">✖</span>
                    <div class="swiperPost">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-if="selectedItem.art_pic1">
                                <img :src=$imgUrl(selectedItem.art_pic1) alt="圖片1">
                            </div>
                            <div class="swiper-slide" v-if="selectedItem.art_pic2">
                                <img :src=$imgUrl(selectedItem.art_pic2) alt="圖片2">
                            </div>
                            <div class="swiper-slide" v-if="selectedItem.art_pic3">
                                <img :src=$imgUrl(selectedItem.art_pic3) alt="圖片3">
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="inner">
                        <div class="title" :class="titleColor(selectedItem.sta_id1)">
                            <h3>{{ selectedItem.art_title }}</h3>
                            <h4>{{ selectedItem.art_subTitle }}</h4>
                            <div class="lineColor" :class="lineColor(selectedItem.sta_id1)"></div>
                        </div>
                        <div class="tag">
                            <span class="title-tag" :class="artChooseTag(selectedItem.sta_id1)">#{{
                                    colorClassMap2[selectedItem.sta_id1] }}</span>
                            <span class="title-tag" :class="artChooseTag(selectedItem.sta_id2)" v-if="selectedItem.sta_id1 !== selectedItem.sta_id2">
                                {{selectedItem.sta_id2 ? '#' +colorClassMap2[selectedItem.sta_id2] : null }}</span>
                        </div>
                        <div class="scrollbarArea">
                            <div class="info">
                                <p>地址：{{ selectedItem.art_address }}</p>
                                <span class="PostingDate">發布日期：{{ selectedItem.art_date }}</span>
                            </div>
                            <div class="txt">
                                <p>{{ selectedItem.art_content }}</p>
                            </div>
                        </div>
                        <div class="author">
                            <div class="line" :class="lineColor(selectedItem.sta_id1)"></div>
                            <span>{{ selectedItem.mem_name }}</span>
                        </div>
                    </div>
                </div>
            </div>

    </div>
  </div>
</template>

<script>
// import BackProTest from "@/testdata/BackProTest.json"
import Swiper from "swiper/bundle";
import axios from "axios";
export default {
  data() {
    return {
      selectedItem: {}, //用於保存資料
      closePost: false,
      items: [],
      search: '',
      colorClassMap2: {
                BL: "板南線",
                R: "淡水信義線",
                G: "松山新店線",
                O: "中和新蘆線",
                BR: "文湖線",
                Y: "環狀線",
            }
      // item:BackProTest,
      // items: BackProTest.map((item) => ({...item,isChecked: false,})),
    };
  },
  computed: {
    filter() {
      if (this.search == '') {
        return this.items
      } else {
        return this.items.filter(item => {
          return this.search == item.art_id
        })
      }

    },

 // 如會員沒照片則顯示空照片
 userImg(){
            return 'user.png'
        },

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
    axios
      .get(this.$apiUrl('BackContriM.php'))
      .then((response) => {
        this.items = response.data;
      })
      .catch((error) => {
        console.error("獲取數據失敗：", error);
      });
  },
  methods: {
        // 內文的border顏色
        titleColor(id){
            return `title${id}`
        },

         // 內文的底線顏色
        lineColor(id){
            return `line${id}`
        },

         // 捷運站顏色
         artChooseTag(id) {
            if (id === 'BL') {
                return 'blue'
            } else if (id === "R") {
                return 'red'
            } else if (id === 'G') {
                return 'green'
            } else if (id === 'O') {
                return 'orange'
            } else if (id === 'BR') {
                return 'brown'
            } else if (id === 'Y') {
                return 'yellow'
            }

        },



    showItemDetail(item) {
      this.selectedItem = { ...item }; //拷貝目標訊息
      this.closePost = true; //顯示點擊項目資料
    },
    togglePermission(item) {
      // 更改狀態
      item.art_status = item.art_status === "1" ? "0" : "1";
      axios
        .post(this.$apiUrl('ContralBackContri.php'), {
          art_id: item.art_id,
          art_status: item.art_status,
        })
        .then((response) => {
          // 檢查
          if (response.data.success) {
            console.log("狀態已更新");
            alert("狀態已更新成功");
          } else {
            console.error("狀態更新失败");
            alert("狀態更新失敗");
            // 如果失敗則保持原本渲染的狀態
            item.art_status = item.art_status === "1" ? "0" : "1";
          }
        })
        .catch((error) => {
          console.error("更新請求失敗：", error);
          alert("更新請求失敗");
          // 如果失敗則保持原本渲染的狀態
          item.art_status = item.art_status === "1" ? "0" : "1";
        });
    },
  },
};
</script>

<style lang="scss">
.BackNews {
  margin-top: 3rem;
  border: 1px solid #aaa;
  background-color: #fff;
  width: 900px;
  padding: 50px;
  height: 900px;
  overflow-y: scroll;

  .NewsSearch {
    padding: 10px;

    .NewsSearchBtn {
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

      button {
        // width: 70px;
        // height: 40px;
        border: 2px solid #666;
        background-color: transparent;
        cursor: pointer;
        border-radius: 5px;
        padding: 5%;
        transition: all 0.3s;

        &:hover {
          // border: 2px solid #333;
          background-color: #ddd;
        }
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

    .ios-switch input:checked+.slider {
      background-color: #4caf50;
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

    .ios-switch input:checked+.slider:before {
      transform: translateX(30px);
    }
  }
}

.backContri {
  .CBPost {
    max-width: 1200px;
    max-height: 700px;
    background-color: #d9d9d9;
    padding: 30px;
    display: flex;
    justify-self: center;
    align-items: center;
    position: fixed;
    inset: 0;
    margin: auto;
    z-index: 10;

    .box {
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: space-around;
      align-items: center;
      background-color: #fff;
      padding: 20px;
      position: relative;

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
        right: 0%;
        top: 0%;
        cursor: pointer;
        z-index: 2;
      }

      .closePost:hover {
        background-color: map-get($color, $key: danger);
      }

      .head {
        position: absolute;
        border-radius: 50%;
        width: 100px;
        height: 100px;
        bottom: -7%;
        right: -5%;
        border: 6px solid #333;
        object-fit: cover;
      }

      .swiperPost {
        width: 40%;
        height: 100%;
        margin: 0 2rem 0 0;

        .swiper-button-prev::after,
        .swiper-button-next::after {
          scale: 0.8;
          color: #fff;
        }

        .swiper-slide {
          width: 100%;
          height: 100%;

          img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
      }

      .inner {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;

        p {
          font-size: map-get($map, small);
        }


        // .title::after {
        //   content: "";
        //   position: absolute;
        //   width: 90%;
        //   border-bottom: 1px solid map-get($color, $key: danger);
        //   bottom: 0;
        //   left: 5%;
        // }

        .title {
          padding-top: 1rem;
          padding-inline: 2rem;
          position: relative;
          height: 30%;

          h3 {
            font-size: map-get($fontsizes, h2);
            line-height: 70px;
            height: 50%;
          }

          h4 {
            font-size: map-get($fontsizes, h4);
            line-height: 65px;
          }

          .lineColor {
            position: absolute;
            width: 90%;
            bottom: 0;
            left: 5%;
          }

          .lineR {
            border-bottom: 1px solid map-get($color, $key: danger);
          }

          .lineBL {
            border-bottom: 1px solid map-get($color, $key: info);
          }

          .lineO {
            border-bottom: 1px solid map-get($color, $key: tangerine);
          }

          .lineG {
            border-bottom: 1px solid map-get($color, $key: success);
          }

          .lineBR {
            border-bottom: 1px solid map-get($color, $key: choco);
          }

          .lineY {
            border-bottom: 1px solid map-get($color, $key: warning);
          }

        }

        .titleR {
          border-top: 30px solid map-get($color, $key: danger);
          border-left: 30px solid map-get($color, $key: danger);
        }

        .titleBL {
          border-top: 30px solid map-get($color, $key: info);
          border-left: 30px solid map-get($color, $key: info);
        }

        .titleO {
          border-top: 30px solid map-get($color, $key: tangerine);
          border-left: 30px solid map-get($color, $key: tangerine);
        }

        .titleG {
          border-top: 30px solid map-get($color, $key: success);
          border-left: 30px solid map-get($color, $key: success);
        }

        .titleBR {
          border-top: 30px solid map-get($color, $key: choco);
          border-left: 30px solid map-get($color, $key: choco);
        }

        .titleY {
          border-top: 30px solid map-get($color, $key: warning);
          border-left: 30px solid map-get($color, $key: warning);
        }


        .DigLikeBox {
          position: absolute;
          font-size: 36px;
          // bottom: 1rem;
          right: 0.9rem;
          top: 9.5rem;
          z-index: 5;
          color: #000000;
        }

        .tag {
          padding-inline: 3.5rem;
        }

        .scrollbarArea::-webkit-scrollbar {
          width: 8px;
        }

        .scrollbarArea::-webkit-scrollbar-track {
          box-shadow: transparent;
        }

        .scrollbarArea::-webkit-scrollbar-thumb {
          border-radius: 10px;
          background-color: #ccc;
          cursor: pointer;
        }

        .scrollbarArea {
          overflow-x: hidden;
          overflow-y: scroll;
          margin-right: 20px;

          .info {
            width: 100%;
            //   width: calc(100% + 40px);
            background-color: transparent;
            // display: inline-grid;
            position: relative;
            padding: 1rem 0.5rem 0;


            p {
              padding-left: 3.5rem;
            }

            .PostingDate {
              display: block;
              text-align: end;
              color: #999;
              padding-bottom: 1.5rem;
              margin-top: 1rem;
              margin-left: auto;
            }
          }

          .info::before {
            content: "";
            border-bottom: #aaa 3px dashed;
            width: calc(90% - 0px);
            position: absolute;
            bottom: 0;
            left: calc(5% + 30px);
          }

          .txt {
            width: 520px;
            padding-left: 50px;
            padding-right: 20px;

            p {
              text-indent: 2em;
              padding-top: 20px;
            }
          }
        }

        .author {
          display: flex;
          justify-content: flex-end;
          align-items: end;
          gap: 1rem;
          padding: 0 60px 0 50px;
          height: 50px;

          .line {
            flex: 1;
            height: 12px;
          }

          .lineR {
            border-top: 30px solid map-get($color, $key: danger);
            border-left: 30px solid map-get($color, $key: danger);
          }

          .lineBL {
            border-top: 30px solid map-get($color, $key: info);
            border-left: 30px solid map-get($color, $key: info);
          }

          .lineO {
            border-top: 30px solid map-get($color, $key: tangerine);
            border-left: 30px solid map-get($color, $key: tangerine);
          }

          .lineG {
            border-top: 30px solid map-get($color, $key: success);
            border-left: 30px solid map-get($color, $key: success);
          }

          .lineBR {
            border-top: 30px solid map-get($color, $key: choco);
            border-left: 30px solid map-get($color, $key: choco);
          }

          .lineY {
            border-top: 30px solid map-get($color, $key: warning);
            border-left: 30px solid map-get($color, $key: warning);
          }

          span {
            font-size: 24px;
            font-weight: 900;
          }
        }
      }
    }
  }


}


@media screen and (max-width: 1280px){
  .backContri {

    .CBPost {
      width: 90%;
      height: 580px;

      .box {
        .closePost {
          scale: 0.8;
        }

        .scrollbarArea {
          margin-right: -10px;
        }

        .head {
          width: 100px;
          height: 100px;
          bottom: -6%;
          right: -4%;
          border: 7px solid #333;
        }

        .inner {
          p {
            font-size: map-get($map, small);
          }



          .title {

            padding-top: 1rem;
            padding-inline: 2rem;
            position: relative;
            height: 30%;
            z-index: 1;

            h3 {
              font-size: map-get($fontsizes, h2);
              line-height: 70px;
              height: 50%;
            }

            h4 {
              font-size: map-get($fontsizes, h4);
              margin-top: 0.5rem;
              line-height: normal;
            }
          }
        }
      }
    }
    }
}


</style>
