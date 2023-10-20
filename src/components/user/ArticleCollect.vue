<template>
  <div class="collect">
    <h1>投稿收藏</h1>
    <div class="collectGrid">
      <div class="collectCard" v-for="(card, index) in paginatedList" :key="index">
        <div class="s-card-h">
          <div class="img">
            <!-- $imgUrl(card.art_pic1) -->
            <img :src=$imgUrl(card.art_pic1) alt="" />
          </div>
          <div class="text">
            <div class="title">
              <h4>{{ card.art_title }}</h4>
              <p>{{ card.art_subTitle }}</p>
              <div class="time">{{ card.art_date }}</div>
              <!-- 推薦tag -->
              <span class="gray title-tag">#{{ card.fea_tag }}</span>
              <!-- 捷運線tag-->
              <!-- <span class="blue title-tag">#{{ card.tag2 }}</span> -->
            </div>
            <!-- <div class="txt">{{ card.art_content }}</div> -->
            <div @click="delCollect(index)" class="del">✖</div>
            <!-- <span class="closePost">✖</span> -->
            <!-- <div class="head" style="overflow: auto;">
                            <img :src="card.head" alt="">
                        </div> -->
          </div>
        </div>
      </div>
      <div class="pagination">
        <button class="paginationmain" @click="prevPage" :disabled="currentPage === 1 || isLoading">
          ＜
        </button>
        <button class="paginationmain" @click="goToPage(page)" v-for="page in totalPages" :key="page"
          :class="{ 'current-page': page === currentPage }">
          {{ page }}
        </button>
        <button class="paginationmain" @click="nextPage" :disabled="currentPage === totalPages || isLoading">
          ＞
        </button>
      </div>
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
      articleCollect: [],
      // 
      pageSize: 6,
      currentPage: 1,
      // articleCollect: [],
      isLoading: true,
    };
  },
  computed: {
    //算出所有的頁數
    totalPages() {
      return Math.ceil(this.articleCollect.length / this.pageSize);
    },
    // 顯示頁面的資料
    paginatedList() {
      const startIndex = (this.currentPage - 1) * this.pageSize; //算出上一頁跑到陣列第幾個
      const endIndex = startIndex + this.pageSize;
      return this.articleCollect.slice(startIndex, endIndex);
    },
    // totalPages() {
    //   const filteredProducts = this.allProducts.filter(item => {
    //     if (this.selectedType === 'all') {
    //       return true;
    //     } else {
    //       return item.prod_type === this.selectedType;
    //     }
    //   });
    //   return Math.ceil(filteredProducts.length / this.pageSize);
    // },
  },
  methods: {
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage -= 1;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage += 1;
      }
    },
    goToPage(page) {
      this.currentPage = page;
    },
    updatePage(page) {
      // console.log(page);
      this.currentPage = page;
      this.cardsDisplay = this.cards;
      const startIdx = (this.currentPage - 1) * this.pageSize;
      const endIdx = startIdx + this.pageSize;
      this.cardsDisplay = this.cards.slice(startIdx, endIdx);
    },
    delCollect(index) {
      console.log(index);

      let memId = this.$store.state.memInfo.mem_id
      let art_id = this.articleCollect[index].art_id

      console.log(memId);
      console.log(art_id);

      const formData = new FormData();
      formData.append("mem_id", memId);
      formData.append("art_id", art_id);

      confirm('確定取消收藏嗎?')
      // $apiUrl('delArticleCollect.php')
      fetch(this.$apiUrl('delArticleCollect.php'), {
        method: 'post',
        body: formData
      })
        .then(res => res.json())
        .then((res) => {
          if (!res.error) {
            alert(res.msg);
            location.reload();
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getArticleCollect() {
      let memId = this.$store.state.memInfo.mem_id
      let formData = new FormData()
      formData.append("mem_id", memId);
      // this.$apiUrl('getArticleCollect.php')
      fetch(this.$apiUrl('getArticleCollect.php'), {
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
    this.getArticleCollect()
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
      height: 350px;

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

    .pagination {
      // width: 100%;
      // display: flex;
      // align-items: center;
      // justify-content: center;
      // margin: 5rem auto;
      grid-area: 3/1/4/4;

      .paginationmain {
        margin: 0 .5rem;
        cursor: pointer;
        width: 45px;
        height: 45px;
        border: none;
        background: none;
        color: #555;
        font-size: 18px;
      }

      .current-page {
        border: 1px solid #999;
        border-radius: 50%;
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
