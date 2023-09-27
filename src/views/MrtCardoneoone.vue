<template>
  <div class="mrtContibuteInPage">
    <div class="title">
      <h1>台北101</h1>
      <div class="tag">
        <span class="title-tag gray">#美食推薦</span>
        <span class="title-tag gray">#景點推薦</span>
        <span class="title-tag red">#淡水信義線</span>
      </div>
    </div>
    <div class="fixCenter">
      <div
        class="imageArea"
        :style="{
          backgroundImage: `url(${background1})`,
        }"
      >
        <div class="image">
          <img
            src="../assets/images/mrtPag/oneoone/oneoone_1.jpg"
            alt="oneoone_1"
          />
        </div>
      </div>
      <p>
        TAIPEI 101座落於台北最菁華地段，是國內建築界有史以來最大的工程專案。
        該專案主要由國內十四家企業共同組成的台北金融大樓股份有限公司，與國內外專業團隊聯手規劃，並由國際級建築大師李祖原精心設計，超越單一量體的設計觀，以吉祥數字「八」（「發」的諧音），作為設計單元。
      </p>
    </div>
    <div class="fixCenter part2">
      <div
        class="imageArea"
        :style="{
          backgroundImage: `url(${background2})`,
        }"
      >
        <div class="image">
          <img
            src="../assets/images/mrtPag/oneoone/oneoone_2.jpg"
            alt="oneoone_2"
          />
        </div>
      </div>

      <p>
        前往台北
        101，當然不能錯過最經典的觀景台。觀景台分為室內和室外兩個區域，室內觀景台位於
        89F，室外則位於 91F，兩者都可以 360
        度視野俯瞰台北城市天際線，置身於雲霧間，感受極致高空美景，路面上的車水馬龍盡收眼底。
      </p>
    </div>
    <!-- ------------------------------------------------------------ -->
    <div
      class="fixCenter part3"
      :style="{
        backgroundImage: MB ? `url(${backgroundMb3})` : `url(${background3})`,
      }"
    >
      <div class="content">
        <div class="image">
          <img
            src="../assets/images/mrtPag/oneoone/oneoone_3.jpg"
            alt="oneoone_3"
          />
        </div>
        <article>
          <p>
            如果要參觀 91F 的室外觀景台，必須使用第 16
            號柱旁邊的樓梯上樓參觀。室外的觀景台為圓弧狀，外圍以鐵柵欄區隔，拍照不必擔心有玻璃反光，天氣好的時候格外舒適。
          </p>
        </article>
      </div>
    </div>
    <article class="mbart">
      <p>
        如果要參觀 91F 的室外觀景台，必須使用第 16
        號柱旁邊的樓梯上樓參觀。室外的觀景台為圓弧狀，外圍以鐵柵欄區隔，拍照不必擔心有玻璃反光，天氣好的時候格外舒適。
      </p>
    </article>
    <!-- ------------------------------------------------------------ -->
    <div
      class="fixCenter part4"
      :style="{
        backgroundImage: MB ? `url(${backgroundMb4})` : `url(${background4})`,
      }"
    >
      <div class="content">
        <div class="image">
          <img
            src="../assets/images/mrtPag/oneoone/oneoone_4.jpg"
            alt="oneoone_4"
          />
        </div>
        <article>
          <p>
            如果從室內觀景台下樓梯到 88 樓 (一樣位在第 16 號柱)
            爲風阻尼器參觀區。風阻尼器是一顆巨大鋼球，利用球的擺動物理來減緩建築物的晃動幅度，是全球唯二開放遊客觀賞的巨型阻尼器。
          </p>
        </article>
      </div>
    </div>
    <article class="mbart">
      <p>
        如果從室內觀景台下樓梯到 88 樓 (一樣位在第 16 號柱)
        爲風阻尼器參觀區。風阻尼器是一顆巨大鋼球，利用球的擺動物理來減緩建築物的晃動幅度，是全球唯二開放遊客觀賞的巨型阻尼器。
      </p>
    </article>
    <div class="seperate">
      <svg height="10" width="4000">
        <g fill="none">
          <path
            stroke="#ccc"
            stroke-width="5"
            d="M 0,0 l4000,0"
            stroke-dasharray="10,10"
          />
        </g>
      </svg>
    </div>
    <div class="fixCenter detail">
      <p>
        《 詳細資訊 》<br />
        地址: 台北市信義區市府路45號<br />
        購物中心:<br />
        ➢ 周日至周四 11:00-21:30<br />
        ➢ 周五、周六及國定假日前一天 11:00-22:00<br />
        觀景台:<br />
        ➢ 周一至周日及國定假日 11:00-21:00<br />
        ✦ 請先至購物中心五樓觀景台售票處
      </p>
      <ButtonM :HTMLInner="btninner" />
    </div>
  </div>
</template>
<script>
import background1 from "@../../../public/img/ron/part1bgc.svg";
import background2 from "@../../../public/img/ron/part2bgc.svg";
import background3 from "@../../../public/img/ron/part3bgc.svg";
import backgroundMb3 from "@../../../public/img/ron/part3_mb.svg";
import background4 from "@../../../public/img/ron/part4bgc.svg";
import backgroundMb4 from "@../../../public/img/ron/part4_mb.svg";
import ButtonL from "@/components/ButtonM.vue";
export default {
  data() {
    return {
      background1,
      background2,
      background3,
      backgroundMb3,
      background4,
      backgroundMb4,
      MB: false,
      PC: false,
      btninner: "官方網站",
    };
  },
  components: {
    ButtonL,
  },
  mounted() {
    this.WindowWidth();
    window.addEventListener("resize", this.WindowWidth);
  },
  methods: {
    WindowWidth() {
      if (window.innerWidth <= 768) {
        this.MB = true;
        this.PC = false;
      } else {
        this.PC = true;
        this.MB = false;
      }
    },
  },
};
</script>
