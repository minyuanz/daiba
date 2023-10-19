<template>
  <!-- <header-area /> -->
  <!-- <pre>{{ $imgUrl('aa/bbb.jpg') }}</pre> -->
  <!-- <pre>{{ $apiUrl('aa/bbb.php') }}</pre> -->
  <!-- <pre>{{ $apiUrl('getNews.php') }}</pre> -->
  <header-area v-if="!$route.meta.hideApp"> </header-area>
  <!-- <div :class="{'body': poke }" > </div> -->

  <main>
    <router-view />
    <!-- Main -->
  </main>

  <footer-area v-if="!$route.meta.hideApp" />
</template>

<script>
import HeaderArea from "@/components/Header.vue";
import FooterArea from "@/components/Footer.vue";
export default {
  data() {
    return {
      apikey: "831993a5339d4b7cadc74621231609",
      weather: {},

    };
  },
  components: {
    HeaderArea,
    FooterArea,
  },

  computed: {
    // poke() {
    //     // 根據路由的 meta.useAppLayout 屬性來決定是否使用 App.vue 佈局
    //     return this.$route.path === "/MemberPagesBgc";
    // },
  },
  mounted() {
    fetch(
      "https://api.weatherapi.com/v1/current.json?q=Taipei&lang=zh_tw&key=6270d6c5f0ba491196f45945231810"
    )
      .then((res) => res.json())
      .then((json) => {
        this.weather = json.current;
      });

  },
};
</script>

<style lang="scss">
body,
html {
  max-width: 1920px;
  margin-inline: auto;
}

#app {
  font-family: Noto Sans TC, "Brown Medium", Avenir, Helvetica, Arial,
    sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  // text-align: center;
  color: #333;
}
</style>
