<template>
  <div class="mrtContibuteInPage">
    <div class="title">
      <h1>{{ mrtCardPage.title }}</h1>
    </div>
    <div class="fixCenter">
      <div
        class="imageArea"
        :style="{
          backgroundImage: `url(${background1})`,
        }"
      >
        <div class="image">
          <img :src="mrtCardPage.mrtimg1" alt="" />
        </div>
      </div>
      <p>
        {{ mrtCardPage.p1 }}
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
          <img :src="mrtCardPage.mrtimg2" alt="ron1" />
        </div>
      </div>

      <p>
        {{ mrtCardPage.p2 }}
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
          <img :src="mrtCardPage.mrtimg3" alt="ron1" />
        </div>
        <article>
          <p>
            {{ mrtCardPage.p3 }}
          </p>
        </article>
      </div>
    </div>
    <article class="mbart">
      <p>
        {{ mrtCardPage.p3 }}
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
          <img :src="mrtCardPage.mrtimg4" alt="ron1" />
        </div>
        <article>
          <p>
            {{ mrtCardPage.p4 }}
          </p>
        </article>
      </div>
    </div>
    <article class="mbart">
      <p>
        {{ mrtCardPage.p4 }}
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
      <div class="detailTxt">
        <p>《 詳細資訊 》</p>
        <p>地址: {{ mrtCardPage.address }}</p>
        <p>電話: {{ mrtCardPage.tel }}</p>
      </div>
      <div class="timelTxt">
        <p>《 營業時間 》</p>
        <p>➢ {{ mrtCardPage.time1 }}</p>
        <p>➢ {{ mrtCardPage.time2 }}</p>
      </div>

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
      MB: true,
      PC: true,
      btninner: "官方網站",
      mrtCardPage: "",
    };
  },
  components: {
    ButtonL,
  },
  mounted() {
    this.WindowWidth();
    window.addEventListener("resize", this.WindowWidth);

    const storeId = parseInt(this.$route.params.id);
    this.mrtCardPage = this.$store.state.mrtCardPage.find(
      (item) => item.id === storeId
    );
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
