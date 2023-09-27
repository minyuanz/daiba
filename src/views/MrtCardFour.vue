<template>
  <div class="mrtContibuteInPage">
    <div class="title">
      <h1>四四南村</h1>
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
          <img src="../assets/images/mrtPag/four/four_1.jpg" alt="four_1" />
        </div>
      </div>
      <p>
        來到四四南村一定會好奇由來，四四南村是台北市的第一個眷村，由大陸青島遷台的四十四兵工廠員工與眷屬所建，因為還心繫著有一天會反攻大陸，所以在這的住宅構造都很簡陋，想不到這一等就沒有了下文直至現今，原本還有四四東村跟西村，但都市計畫，現存的也只有這塊小小的眷村土地了
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
          <img src="../assets/images/mrtPag/four/four_2.jpg" alt="four_2" />
        </div>
      </div>

      <p>
        現有的南村規劃成了信義公民會館，也是眷村文化公園，由四棟建築而組成，分成四個區域有著不同的主題，分別是台北信義親子館、臺北眷村文物館、好丘Good
        cho’s、跟PLAYground
        南村劇場‧青鳥·有.設計。眷村中的中央廣場，則是在假日有文青市集
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
          <img src="../assets/images/mrtPag/four/four_3.jpg" alt="four_3" />
        </div>
        <article>
          <p>
            四四南村B館，主要為四四南村文化保存靜態展示，展示主題包括：四四南村歷史軌跡、眷村藝文、眷村媽媽、眷村美食、眷村生活、遊戲人間、手工藝及多媒體放映室…等等。
          </p>
        </article>
      </div>
    </div>
    <article class="mbart">
      <p>
        四四南村B館，主要為四四南村文化保存靜態展示，展示主題包括：四四南村歷史軌跡、眷村藝文、眷村媽媽、眷村美食、眷村生活、遊戲人間、手工藝及多媒體放映室…等等。
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
          <img src="../assets/images/mrtPag/four/four_5.jpg" alt="four_5" />
        </div>
        <article>
          <p>
            四四南村C館，也有個常態性創意市集，大家熱愛的四四南村美食「好，丘」，餐飲以輕食為主，包括麵包、貝果、漢堡及咖啡飲料等，融合眷村文化提供藝展活動，是一處休閒用餐的好去處。
          </p>
        </article>
      </div>
    </div>
    <article class="mbart">
      <p>
        四四南村C館，也有個常態性創意市集，大家熱愛的四四南村美食「好，丘」，餐飲以輕食為主，包括麵包、貝果、漢堡及咖啡飲料等，融合眷村文化提供藝展活動，是一處休閒用餐的好去處。
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
        地址: 台北市士林區中山北路五段461巷21號 (近捷運「士林站」2號出口)<br />
        電話: (02) 2883-6883<br />
        營業時間:<br />
        ➢ 週日至週四 16:00~AM 03:00<br />
        ➢ 週五及週六 16:00~AM 04:00<br />
        注意事項:<br />
        ✦ 白天為咖啡廳，晚上是酒吧<br />
        ✦ PM8:00後才提供調酒
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
