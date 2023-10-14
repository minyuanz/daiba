<template>
  <div class="artWrap">
    <h1>我的投稿</h1>
    <div class="artGrid">
      <div class="artCard" v-for="card in articleCollect">
        <div class="card-h">
          <div class="img">
            <img :src=$imgUrl(card.art_pic1) alt="" />
            <!-- <div class="head">
              <img :src="card.head" alt="" />
            </div> -->
          </div>
          <div class="text">
            <div class="title">
              <span class="gray title-tag">#{{ card.fea_tag }}</span>
              <h3>{{ card.art_title }}</h3>
              <p>{{ card.art_subTitle }}</p>
            </div>
          </div>
          <span class="time">
            {{ card.art_date }}
          </span>
          <p class="txt">
            {{ card.art_content }}
          </p>
        </div>
      </div>
      <!-- <Page :total="cards.length" size="small" :page-size="pageSize" @on-change="updatePage" id="page" /> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cards: [
        {
          image: require("@/../public/img/artCard.png"),
          head: require("@/../public/img/artCard1.png"),
          // image: '../img/artCard.png',
          // head: '../img/artCard1.png',
          tag: "住宿推薦",
          title: "原來京站樓上長這樣？",
          title2: "開箱五星級行政豪華客房一泊二食",
          date: "2020-06-15",
          ctx: "在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。",
        },
        {
          image: require("@/../public/img/artCard.png"),
          head: require("@/../public/img/artCard1.png"),
          tag: "住宿推薦",
          title: "原來京站樓上長這樣？",
          title2: "開箱五星級行政豪華客房一泊二食",
          date: "2020-06-15",
          ctx: "在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。",
        },
        {
          image: require("@/../public/img/artCard.png"),
          head: require("@/../public/img/artCard1.png"),
          tag: "住宿推薦",
          title: "原來京站樓上長這樣？",
          title2: "開箱五星級行政豪華客房一泊二食",
          date: "2020-06-15",
          ctx: "在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。",
        },
        {
          image: require("@/../public/img/artCard.png"),
          head: require("@/../public/img/artCard1.png"),
          tag: "住宿推薦",
          title: "原來京站樓上長這樣？",
          title2: "開箱五星級行政豪華客房一泊二食",
          date: "2020-06-15",
          ctx: "在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。",
        },
        {
          image: require("@/../public/img/artCard.png"),
          head: require("@/../public/img/artCard1.png"),
          tag: "住宿推薦",
          title: "原來京站樓上長這樣？",
          title2: "開箱五星級行政豪華客房一泊二食",
          date: "2020-06-15",
          ctx: "在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。",
        },
        {
          image: require("@/../public/img/artCard.png"),
          head: require("@/../public/img/artCard1.png"),
          tag: "住宿推薦",
          title: "原來京站樓上長這樣？",
          title2: "開箱五星級行政豪華客房一泊二食",
          date: "2020-06-15",
          ctx: "在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。",
        },
      ],
      cardsDisplay: [],
      pageSize: 6,
      currentPage: 1,
      articleCollect: []
    };
  },
  methods: {
    updatePage(page) {
      // console.log(page);
      this.currentPage = page;
      this.cardsDisplay = this.cards;
      const startIdx = (this.currentPage - 1) * this.pageSize;
      const endIdx = startIdx + this.pageSize;
      this.cardsDisplay = this.cards.slice(startIdx, endIdx);
    },
    getMemberArticle() {
      let memId = this.$store.state.memInfo.mem_id
      // `http://localhost/dai/public/phps/getMemberArticle.php?memId=${memId}`
      // this.$apiUrl('getMemberArticle.php?memId=${memId}')

      let formData = new FormData()
      formData.append("mem_id", memId);
      fetch(this.$apiUrl('getMemberArticle.php'), {
        method: 'post',
        body: formData
      })
        .then(res => res.json())
        .then((res) => {
          this.articleCollect = res
        })
        .catch((error) => {
          console.error('數據傳輸失敗：', error);
        });
    }
  },
  mounted() {
    this.cardsDisplay = this.cards;
    this.getMemberArticle()
  },
};
</script>

<style lang="scss">
.artWrap {
  border: 1px solid #aaa;
  background-color: #fff;
  border-radius: 20px;
  width: 900px;

  h1 {
    text-align: center;
    margin: 30px 0;
    // grid-area: 1/1/2/3;
  }

  .artGrid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 20px;
    padding: 0 50px;
    justify-items: center;

    .artCard {
      .card-h {
        border: 1px solid #aaa;
        width: 250px;
        height: 350px;
        overflow: auto;
        margin: 0;

        .img {
          img {
            border-radius: 0px;
          }

          // .head {
          //   overflow: auto;
          // }
        }
      }
    }

    #page {
      grid-area: 3/1/4/4;
      // display: block;
      text-align: center;
    }
  }
}

@media screen and (max-width: 414px) {
  .artWrap {
    width: 100%;

    .artGrid {
      display: block;

      .artCard {
        .card-h {
          height: 550px;
          margin: 10px 0;
        }
      }
    }
  }
}
</style>
