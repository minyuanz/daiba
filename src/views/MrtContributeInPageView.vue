<template>
  <div class="mrtContibuteInPage">
    <div class="title">
      <h1>榕RON</h1>
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
          <img src="../../public/img/ron/ron.jpg" alt="ron1" />
        </div>
      </div>
      <p>
        榕 RON CAFE BAR
        是以音樂與藝文作為核心精神，結合咖啡酒飲與在地人文料理的餐飲酒吧
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
          <img src="../../public/img/ron/ron2.jpg" alt="ron1" />
        </div>
      </div>

      <p>
        將二樓面向文林路的牆面改為大面窗景， 囊括捷運往來的軌道聲和綠意景緻，
        與吧檯旁亮起的銀幕畫面相互呼應， 讓人駐足在電影般的榕民活動中心。
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
          <img src="../../public/img/ron/ron3.jpg" alt="ron1" />
        </div>
        <article>
          <p>
            榕，<br />
            一座單名的咖啡酒吧，出自門前的老榕樹，翻新老屋創造士林傳說。在這裡，隨著派對聚會與音樂的喧鬧聲，我們聚集了氣味相投的常客老友們，
            互相稱之為「榕民」。<br />
            <br />2013年末，榕團隊以酒飲、餐點與音樂派對發想企劃，在台式老屋裡融入西洋文化。
            當人們踏上階梯探訪舊式公寓，就能感受到特有的榕式氣味。
          </p>
        </article>
      </div>
    </div>
    <article class="mbart">
      <p>
        榕，<br />
        一座單名的咖啡酒吧，出自門前的老榕樹，翻新老屋創造士林傳說。在這裡，隨著派對聚會與音樂的喧鬧聲，我們聚集了氣味相投的常客老友們，
        互相稱之為「榕民」。<br />
        <br />2013年末，榕團隊以酒飲、餐點與音樂派對發想企劃，在台式老屋裡融入西洋文化。
        當人們踏上階梯探訪舊式公寓，就能感受到特有的榕式氣味。
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
          <img src="../../public/img/ron/ron4.jpg" alt="ron1" />
        </div>
        <article>
          <p>
            由電影背景的主理人，與熱愛音樂得好友們於2013年成立，期許在酒吧餐飲空間，使來客們找到歸屬感，延續記憶營造舊地重遊的空間感受。<br /><br />
            榕 RON 團隊為空間注入藝術，為氣氛加入音樂，從餐點翻玩創意，
            為情感抒發提供餐酒空間，「榕」合出人與人的交流。
          </p>
        </article>
      </div>
    </div>
    <article class="mbart">
      <p>
        由電影背景的主理人，與熱愛音樂得好友們於2013年成立，期許在酒吧餐飲空間，使來客們找到歸屬感，延續記憶營造舊地重遊的空間感受。<br /><br />
        榕 RON 團隊為空間注入藝術，為氣氛加入音樂，從餐點翻玩創意，
        為情感抒發提供餐酒空間，「榕」合出人與人的交流。
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

<style lang="scss">
@import "../assets/scss/page/_mrtContributeInPage";
</style>
