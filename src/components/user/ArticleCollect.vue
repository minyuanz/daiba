<template>
  <div class="collect">
    <h1>投稿收藏</h1>
    <div class="collectGrid">
      <div class="collectCard" v-for="(card, index) in cardsDisplay" :key="index">
        <div class="s-card-h">
          <div class="img">
            <img :src="card.image" alt="" />
          </div>
          <div class="text">
            <div class="title">
              <h4>{{ card.title }}</h4>
              <p>{{ card.title2 }}</p>
              <div class="time">{{ card.date }}</div>
              <span class="gray title-tag">#{{ card.tag }}</span>
              <span class="blue title-tag">#{{ card.tag2 }}</span>
            </div>
            <!-- <div class="txt">{{ card.ctx }}</div> -->
            <div @click="delCollect(index)" class="del">✖</div>
            <!-- <span class="closePost">✖</span> -->
            <!-- <div class="head" style="overflow: auto;">
                            <img :src="card.head" alt="">
                        </div> -->
          </div>
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
          image: require("@/../public/img/collect.png"),
          head: require("@/../public/img/collect2.png"),
          // image: '../img/collect.png',
          // head: '../img/collect2.png',
          title: "五分埔商圈購物",
          title2: "台北成衣街｜衣服、飾品、配件、包包、 帽子批發",
          date: "2020-06-15",
          tag: "景點推薦",
          tag2: "板南線",
          ctx: "　　那天逛完華山KAKAO敗家後，就心血來潮到五分埔去逛逛，真的是久違了好多年，以前學生時期過年領完紅包，一定都是最期待來到五分埔買衣服！如今後來才知道原來這裡除了一般民眾外......。",
        },
        {
          image: require("@/../public/img/collect.png"),
          head: require("@/../public/img/collect2.png"),
          // image: '../img/collect.png',
          // head: '../img/collect2.png',
          title: "五分埔商圈購物",
          title2: "台北成衣街｜衣服、飾品、配件、包包、 帽子批發",
          date: "2020-06-15",
          tag: "景點推薦",
          tag2: "板南線",
          ctx: "　　那天逛完華山KAKAO敗家後，就心血來潮到五分埔去逛逛，真的是久違了好多年，以前學生時期過年領完紅包，一定都是最期待來到五分埔買衣服！如今後來才知道原來這裡除了一般民眾外......。",
        },
        {
          image: require("@/../public/img/collect.png"),
          head: require("@/../public/img/collect2.png"),
          // image: '../img/collect.png',
          // head: '../img/collect2.png',
          title: "五分埔商圈購物",
          title2: "台北成衣街｜衣服、飾品、配件、包包、 帽子批發",
          date: "2020-06-15",
          tag: "景點推薦",
          tag2: "板南線",
          ctx: "　　那天逛完華山KAKAO敗家後，就心血來潮到五分埔去逛逛，真的是久違了好多年，以前學生時期過年領完紅包，一定都是最期待來到五分埔買衣服！如今後來才知道原來這裡除了一般民眾外......。",
        },
        {
          image: require("@/../public/img/collect.png"),
          head: require("@/../public/img/collect2.png"),
          // image: '../img/collect.png',
          // head: '../img/collect2.png',
          title: "五分埔商圈購物",
          title2: "台北成衣街｜衣服、飾品、配件、包包、 帽子批發",
          date: "2020-06-15",
          tag: "景點推薦",
          tag2: "板南線",
          ctx: "　　那天逛完華山KAKAO敗家後，就心血來潮到五分埔去逛逛，真的是久違了好多年，以前學生時期過年領完紅包，一定都是最期待來到五分埔買衣服！如今後來才知道原來這裡除了一般民眾外......。",
        },
        {
          image: require("@/../public/img/collect.png"),
          head: require("@/../public/img/collect2.png"),
          // image: '../img/collect.png',
          // head: '../img/collect2.png',
          title: "五分埔商圈購物",
          title2: "台北成衣街｜衣服、飾品、配件、包包、 帽子批發",
          date: "2020-06-15",
          tag: "景點推薦",
          tag2: "板南線",
          ctx: "　　那天逛完華山KAKAO敗家後，就心血來潮到五分埔去逛逛，真的是久違了好多年，以前學生時期過年領完紅包，一定都是最期待來到五分埔買衣服！如今後來才知道原來這裡除了一般民眾外......。",
        },
      ],
      cardsDisplay: [],
      pageSize: 2,
      currentPage: 1,
      articleCollect:[]
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
    delCollect(index) {
      this.cardsDisplay.splice(index, 1);
      console.log(index);
    },
    getMemberArticle() {
      let memId = this.$store.state.memInfo.mem_id
      fetch(`http://localhost/dai/public/phps/getMemberArticle.php?memId=${memId}`)
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
.collect {
  border: 1px solid #aaa;
  background-color: #fff;
  border-radius: 20px;
  width: 900px;

  h1 {
    text-align: center;
    margin: 30px 0;
    // grid-area: 1/1/2/3;
  }

  .collectGrid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);
    justify-items: center;

    // padding: 0 50px;
    // gap: 10px;

    .s-card-h {
      margin: auto;
      margin-bottom: 10%;
      width: 250px;

      .img {
        img {
          height: 200px;
        }
      }

      // width: 100%;
      .del {
        background-color: black;
        font-size: 20px;
        font-weight: 1000;
        color: #fff;
        border-radius: 50px;
        width: 30px;
        height: 30px;
        display: inline-block;
        position: absolute;
        text-align: center;
        line-height: 30px;
        right: -8%;
        top: -5%;
        cursor: pointer;
        z-index: 2;

        &:hover {
          background-color: map-get($color, $key: danger);
        }
      }
    }
  }
}

@media screen and (max-width: 414px) {
  .collect {
    width: 100%;

    .collectGrid {
      grid-template-columns: repeat(1, 1fr);
      padding: 0 20px;

      .card-w {
        width: 100%;

        .img {
          display: none;
        }

        .text {
          width: 100%;
        }

        .head {
          display: none;
        }
      }
    }
  }
}
</style>
