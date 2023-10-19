<template>
  <div class="mrtTitle">
    <h1>捷運推薦</h1>
  </div>

  <section class="mrtLineCheck">
    <div class="mrtPic">
      <div class="pic mrtGrayStyle border-brownline">
        <img src="../../public/img/brown.jpeg" alt="brownline" />
      </div>
      <div class="pic mrtGrayStyle border-yellowline">
        <img src="../../public/img/yellow.jpeg" alt="yellowline" />
      </div>

      <div class="mrtMainLine">
        <div
          class="pic border-redline mrtRedBoy"
          @click="
            filterOptions('red');
            scrollTop();
            showTag('red');
          "
          @mouseenter="activate('red')"
          @mouseleave="deactivate('red')"
          :class="{ active: isActive.red }"
        >
          <img src="../../public/img/red.jpeg" alt="redline" />
        </div>
        <div
          class="pic border-blueline mrtBlueBoy"
          @click="
            filterOptions('blue');
            scrollTop();
            showTag('blue');
          "
          @mouseenter="activate('blue')"
          @mouseleave="deactivate('blue')"
          :class="{ active: isActive.blue }"
        >
          <img src="../../public/img/blue.jpeg" alt="blueline" />
        </div>
        <div
          class="pic border-greenline mrtGreenBoy"
          @click="
            filterOptions('green');
            scrollTop();
            showTag('green');
          "
          @mouseenter="activate('green')"
          @mouseleave="deactivate('green')"
          :class="{ active: isActive.green }"
        >
          <img src="../../public/img/green.jpeg" alt="greenline" />
        </div>
        <div
          class="pic border-orangeline mrtOrangeBoy"
          @click="
            filterOptions('orange');
            scrollTop();
            showTag('orange');
          "
          @mouseenter="activate('orange')"
          @mouseleave="deactivate('orange')"
          :class="{ active: isActive.orange }"
        >
          <img src="../../public/img/orange.jpeg" alt="orangeline" />
        </div>
        <div
          class="pic border-brownline mrtBrownBoy"
          @click="
            filterOptions('brown');
            scrollTop();
            showTag('brown');
          "
          @mouseenter="activate('brown')"
          @mouseleave="deactivate('brown')"
          :class="{ active: isActive.brown }"
        >
          <img src="../../public/img/brown.jpeg" alt="brownline" />
        </div>
        <div
          class="pic border-yellowline mrtYellowBoy"
          @click="
            filterOptions('yellow');
            scrollTop();
            showTag('yellow');
          "
          @mouseenter="activate('yellow')"
          @mouseleave="deactivate('yellow')"
          :class="{ active: isActive.yellow }"
        >
          <img src="../../public/img/yellow.jpeg" alt="yellowline" />
        </div>
      </div>
      <div class="pic mrtGrayStyle border-redline">
        <img src="../../public/img/red.jpeg" alt="redline" />
      </div>
      <div class="pic mrtGrayStyle border-blueline">
        <img src="../../public/img/blue.jpeg" alt="blueline" />
      </div>
    </div>
  </section>

  <section class="mrt-tagGroup">
    <div class="lineGroup">
      <div class="dark5 slim"></div>
      <div class="dark6 slim"></div>
      <div class="dark7 slim"></div>
      <div class="dark8 slim"></div>
      <div class="dark9 slim"></div>
    </div>

    <div v-if="MB" class="mrtTag">
      <button
        class="title-tag"
        v-for="(color, index) in selectColor"
        :key="color"
        :class="[BGColor(color), color]"
        @click="
          filterOptions(color);
          showTag(color);
          scrollTop();
        "
        @mouseenter="activate(color)"
        @mouseleave="deactivate(color)"
      >
        {{ upperCaseColorsMB[index] }}
      </button>
    </div>

    <div v-if="PC" class="mrtTag">
      <button
        class="title-tag"
        v-for="(color, index) in selectColor"
        :key="color"
        :class="[BGColor(color), color]"
        @mouseenter="activate(color)"
        @mouseleave="deactivate(color)"
        @click="
          filterOptions(color);
          showTag(color);
          scrollTop();
        "
      >
        {{ upperCaseColorsPC[index] }}
      </button>
    </div>
  </section>

  <div class="mrtBanner">
    <div class="swiper" id="mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for=" in 20">
          <img
            src="../../public/img/mrtArrow.png"
            alt=""
            @load="initializeSwiper"
          />
        </div>
      </div>
    </div>
  </div>

  <div class="mrtBanner">
    <div class="swiper" id="mySwiper2">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for=" in 20">
          <img
            src="../../public/img/mrtArrow.png"
            alt=""
            @load="initializeSwiper"
          />
        </div>
      </div>
    </div>
  </div>

  <div class="dottedLineBox">
    <div class="dottedLine"></div>
  </div>
  <!-- 站點板塊 -->
  <div class="mrtWrappo" id="mrtWrappo">
    <div class="mrtWrap" v-for="(item, index) in mrtstaGroup" :key="index">
      <div class="mrtSta">
        <!-- 站點文字介紹 -->
        <div class="mrtStaTxt">
          <h2>{{ item.sta_name }}</h2>
          <p>
            {{ item.sta_describe }}
          </p>
        </div>
        <!-- 站點圖跟捷運圖 -->
        <div
          class="mrtStaBox"
          @click="
            (closePost = !closePost),
              (lightBox = !lightBox),
              (item.isShow = !item.isShow),
              showMrtCard(item);
            selectedType = '景點';
          "
        >
          <div class="mrtStaMaruBox">
            <img
              class="mrtStaMaru"
              src="../../public/img/mrt_maru.png"
              alt="mrt_maru"
            />
          </div>
          <div class="mrtStaPicBox">
            <img class="mrtStaPic" :src="$imgUrl(item.sta_pictor)" alt="" />
          </div>
        </div>
      </div>
      <!------------------------美食住宿景點卡片 ------------------------------------->
      <div class="CBPost" v-show="closePost && item.isShow">
        <div class="box" v-if="item.isShow">
          <span class="closePost" @click="toggleMtrStaBox(item)">✖</span>
          <transition appear name="fade" mode="out-in">
            <div class="swiperMRTCard">
              <div class="swiper-wrapper">
                <!-- <div
                  class="swiper-slide"
                  v-for="(itemplace, index) in item.place"
                > -->
                <div
                  class="swiper-slide"
                  v-for="(itemCard, index) in filteredMrtCard"
                  :key="index"
                  :class="{
                    hidden:
                      selectedType !== '' && itemCard.fea_name !== selectedType,
                  }"
                >
                  <div
                    class="cardHeight"
                    
                  >
                    <!-- <router-link
                :to="{ path: itemplace?.router ? itemplace.router : '/' }"
                > -->
                    <router-link
                      :to="{
                        name: 'MrtCardPage',
                        params: { id: itemCard.special_id },
                      }"
                    >
                      <div class="mrtCardWrap">
                        <!-- 卡片 -->
                        <div class="card-h border-r">
                          <div class="img">
                            <img :src="$imgUrl(itemCard.special_pic1)" alt="" />
                          </div>
                          <div class="text">
                            <div class="title">
                              <h3>{{ itemCard.special_title }}</h3>
                            </div>
                            <div class="txt">{{ itemCard.special_des }}</div>
                          </div>
                        </div>
                      </div>
                    </router-link>
                  </div>
                </div>
              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </transition>
          <!-- to="/MrtCardPage/:id" -->
        </div>
        <!-- ---------------------按鈕 -->
        <div class="mrtTagbar" @click="checkShow">
          <div class="outer-circle"></div>
          <div class="color-circle"></div>
          <div class="inner-circle">
            <img src="../../public/img/mrtImg.png" alt="" />
          </div>
          <transition appear name="box" mode="out-in">
            <div class="checkBox" style="" v-if="showCheckBox">
              <div class="box">
                <button class="place" @click="selectType('景點')">景點</button>
                <button class="food" @click="selectType('美食')">美食</button>
                <button class="hotel" @click="selectType('住宿')">住宿</button>
              </div>
              <div class="triangle"></div>
            </div>
          </transition>
        </div>

        <!-- --------------------- -->
      </div>
    </div>
  </div>
  <div class="lightBox" v-show="lightBox" @click="toggleBox(item)"></div>
</template>

<script>
import Swiper from "swiper/bundle";
import gsap from "gsap";
import "swiper/swiper-bundle.css";
import { pushScopeId } from "vue";
import axios from "axios";

export default {
  data() {
    return {
      selectedType: "景點",
      selectedFeature: "",
      selectMrtId: "R",
      mrtstaGroup: [],
      filteredMrtCard: [],
      mrtData: [],
      mrtcard: [],
      lightBox: false,
      closePost: false,
      originalPlaceData: [],
      defaultColor: "red",
      selectedColor: "red",
      filteredMrt: [],
      swiperMRTCard: null,
      showCheckBox: true,
      selectColor: ["red", "blue", "green", "orange", "brown", "yellow"],
      showAll: true,
      src: "../../public/img/mrtArrow.jpg",
      PC: true,
      MB: true,
      isActive: {
        red: false,
        blue: false,
        green: false,
        orange: false,
        brown: false,
        yellow: false,
      },
    };
  },

  mounted() {
    axios
      .get(this.$apiUrl("mrt.php"))
      .then((res) => {
        this.mrtData = res.data;
        this.mrtstaGroup = this.mrtData.filter(
          (mrtData) =>
            mrtData.mrt_id1 === this.selectMrtId ||
            mrtData.mrt_id2 === this.selectMrtId
        );
      })
      .catch((err) => {
        console.log("err", err);
      });

    axios
      .get(this.$apiUrl("BackFeatureM.php"))
      .then((res) => {
        console.log("got it", res);
        this.mrtcard = res.data;
      })
      .catch((err) => {
        console.log("err", err);
      });
    gsap.fromTo(
      ".mrtRedBoy",
      {
        y: "-120%",
      },
      {
        y: "0%",
        duration: 0.3,
        delay: 0.5,
      }
    );
    gsap.fromTo(
      ".mrtBlueBoy",
      {
        y: "-120%",
      },
      {
        y: "0%",
        duration: 0.3,
        delay: 0.6,
      }
    );
    gsap.fromTo(
      ".mrtGreenBoy",
      {
        y: "-120%",
      },
      {
        y: "0%",
        duration: 0.3,
        delay: 0.7,
      }
    );
    gsap.fromTo(
      ".mrtOrangeBoy",
      {
        y: "-120%",
      },
      {
        y: "0%",
        duration: 0.3,
        delay: 0.8,
      }
    );
    gsap.fromTo(
      ".mrtBrownBoy",
      {
        y: "-120%",
      },
      {
        y: "0%",
        duration: 0.3,
        delay: 0.9,
      }
    );
    gsap.fromTo(
      ".mrtYellowBoy",
      {
        y: "-120%",
      },
      {
        y: "0%",
        duration: 0.3,
        delay: 1,
      }
    );

    setTimeout(() => {
      this.initSwiper();
    }, 100);

    this.swiper()

    this.WindowWidth();
    window.addEventListener("resize", this.WindowWidth);
  },

  methods: {
    filterOptions(color) {
      if (color === "red") {
        this.selectMrtId = "R";
        this.mrtstaGroup = this.mrtData.filter(
          (mrtData) =>
            mrtData.mrt_id1 === this.selectMrtId ||
            mrtData.mrt_id2 === this.selectMrtId
        );
      }
      if (color === "blue") {
        this.selectMrtId = "BL";
        this.mrtstaGroup = this.mrtData.filter(
          (mrtData) =>
            mrtData.mrt_id1 === this.selectMrtId ||
            mrtData.mrt_id2 === this.selectMrtId
        );
      }
      if (color === "green") {
        this.selectMrtId = "G";
        this.mrtstaGroup = this.mrtData.filter(
          (mrtData) =>
            mrtData.mrt_id1 === this.selectMrtId ||
            mrtData.mrt_id2 === this.selectMrtId
        );
      }
      if (color === "orange") {
        this.selectMrtId = "O";
        this.mrtstaGroup = this.mrtData.filter(
          (mrtData) =>
            mrtData.mrt_id1 === this.selectMrtId ||
            mrtData.mrt_id2 === this.selectMrtId
        );
      }
      if (color === "brown") {
        this.selectMrtId = "BR";
        this.mrtstaGroup = this.mrtData.filter(
          (mrtData) =>
            mrtData.mrt_id1 === this.selectMrtId ||
            mrtData.mrt_id2 === this.selectMrtId
        );
      }
      if (color === "yellow") {
        this.selectMrtId = "Y";
        this.mrtstaGroup = this.mrtData.filter(
          (mrtData) =>
            mrtData.mrt_id1 === this.selectMrtId ||
            mrtData.mrt_id2 === this.selectMrtId
        );
      }

      this.scrollTop();
    },

    showMrtCard(item) {
      console.log("Clicked item:", item.sta_name);
      // 根据点击的站点 item 获取相应的 mrtcard 数据
      this.filteredMrtCard = this.mrtcard.filter(
        (card) => card.sta_name === item.sta_name
      );
      console.log("Filtered Mrt Card:", this.filteredMrtCard);
      // 显示相关的卡片内容
      this.closePost = true;
      this.lightBox = true;
      item.isShow = true;
    },

    selectType(type) {
      this.selectedType = type;
      this.$nextTick(() => {
        this.swiper();
      });
     
    },

    swiper(){
      const swiperMRTCard = new Swiper(".swiperMRTCard", {
      direction: "horizontal",
      speed: 500,
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        375: {
          slidesPerView: 1,
          slidesPerGroup: 1,
          spaceBetween: 30,
        },
        415: {
          slidesPerView: 1,
          slidesPerGroup: 1,
          spaceBetween: 30,
        },
        577: {
          slidesPerView: 2,
          slidesPerGroup: 2,
          spaceBetween: 30,
        },
        769: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        1281: {
          slidesPerView: 4,
          slidesPerGroup: 4,
          spaceBetween: 50,
        },
      },
    });
console.log(swiperMRTCard);
    },
    // changeContent(type) {
    //   // 保存原始資料
    //   this.selectedFeature = type;
    //   if (this.originalPlaceData.length === 0) {
    //     this.originalPlaceData = this.filteredMrt.map((item) => ({ ...item }));
    //   }

    //   this.filteredMrt.forEach((item) => {
    //     item.isShow = false;
    //     item.place = item[type];
    //   });
    // },

    // resetToPlace() {
    //   if (this.originalPlaceData.length > 0) {
    //     this.filteredMrt.forEach((item, index) => {
    //       item.isShow = false;
    //       item.place = this.originalPlaceData[index].place;
    //     });
    //     this.originalPlaceData = []; // 清空暫存的資料
    //   }
    // },

    someMethod() {
      if (Array.isArray(this.selectColor)) {
        const result = this.selectColor.map((color) => color.toUpperCase());
      } else {
        console.warn("selectColor is not an array:", this.selectColor);
      }
    },

    checkShow() {
      this.showCheckBox = !this.showCheckBox;
    },

    activate(color) {
      this.isActive[color] = true;
    },
    deactivate(color) {
      this.isActive[color] = false;
    },

    scrollTop() {
      document
        .querySelector("#mrtWrappo")
        .scrollIntoView({ behavior: "smooth" });
    },

    showTag(color) {
      this.selectedColor = color;
    },

    BGColor(color) {
      if (this.selectedColor === color) {
        return `${color}Click`;
      }
    },
    //rwd判斷
    WindowWidth() {
      if (window.innerWidth <= 768) {
        this.MB = true;
        this.PC = false;
      } else {
        this.PC = true;
        this.MB = false;
      }
    },
    // 背景圖
    initSwiper() {
      const swiper = new Swiper(".swiper", {
        direction: "vertical",
        speed: 3500,
        loop: true,
        loopedSlides: 10,
        autoHeight: true,
        slidesPerView: "auto",
        spaceBetween: 0,
        autoplay: {
          delay: 0,
          pauseOnMouseEnter: false,
          disableOnInteraction: false,
        },
      });
    },
    toggleMtrStaBox(item) {
      this.closePost = !this.closePost;
      item.isShow = !item.isShow;
      this.lightBox = !this.lightBox;
    },

    toggleBox(item) {
      this.closePost = !this.closePost;
      // item.isShow = !item.isShow;
      this.lightBox = !this.lightBox;
    },
  },

  computed: {
    upperCaseColorsMB() {
      if (Array.isArray(this.selectColor)) {
        return this.selectColor.map((color) =>
          color.toUpperCase().substring(0, 2)
        );
      } else {
        console.warn("selectColor is not an array:", this.selectColor);
        return [];
      }
    },
    upperCaseColorsPC() {
      if (Array.isArray(this.selectColor)) {
        return this.selectColor.map((color) => color.toUpperCase());
      } else {
        console.warn("selectColor is not an array:", this.selectColor);
        return [];
      }
    },
    // filteredMrtcard() {
    //   // 根据当前站点的 sta_name 过滤 mrtcardGroup
    //   return this.mrtcard.filter(
    //     (itemcard) => itemcard.sta_name === this.mrtstaGroup
    //   );
    // },
  },
  watch: {
    lightBox(nVal) {
      if (!nVal) return;
      this.$nextTick(() => {
        this.swiperMRTCard = new Swiper(".swiperMRTCard", {
          direction: "horizontal",
          speed: 500,
          loop: true,
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          breakpoints: {
            375: {
              slidesPerView: 1,
              slidesPerGroup: 1,
              spaceBetween: 30,
            },
            415: {
              slidesPerView: 1,
              slidesPerGroup: 1,
              spaceBetween: 30,
            },
            577: {
              slidesPerView: 2,
              slidesPerGroup: 2,
              spaceBetween: 30,
            },
            769: {
              slidesPerView: 3,
              spaceBetween: 30,
            },
            1281: {
              slidesPerView: 4,
              slidesPerGroup: 4,
              spaceBetween: 50,
            },
          },
        });
      });
    },
  },

  created() {},
  beforeUnmount() {
    this.swiperMRTCard?.destroy();
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/page/_mrt.scss";

.active {
  animation: flash 300ms linear forwards;
}

// .title-tag:hover ~ .pic.active {
//   animation: flash 300ms linear forwards;
// }

@keyframes flash {
  0% {
    filter: brightness(100%);
  }

  100% {
    filter: brightness(150%);
  }
}
.hidden {
  display: none;
}
</style>
