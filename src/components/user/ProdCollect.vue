<template>
  <div class="prodWrap">
    <h1>商品收藏</h1>
    <div class="prodGrid">
      <div class="prodCard" v-for="(card, index) in prodCollect">
        <div class="pic">
          <!-- $imgUrl(card.prod_img1) -->
          <img :src=$imgUrl(card.prod_img1) alt="" />
        </div>
        <div class="txt">
          <h3>{{ card.prod_name }}</h3>
          <span> NT.{{ card.prod_price }}</span>
          <div @click="delCollect(index)" class="del">
            <i class="fa-solid fa-trash-can"></i>
          </div>
        </div>
      </div>
    </div>
    <!-- <Page
      :total="cards.length"
      size="small"
      :page-size="pageSize"
      @on-change="updatePage"
      id="page"
    /> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      cards: [
        {
          image: require("@/../public/img/prod1.png"),
          // image: '../img/prod1.png',
          title: "台灣紀念酒杯",
          price: 150,
        },
        {
          image: require("@/../public/img/prod1.png"),
          title: "台灣紀念酒杯",
          price: 150,
        },
        {
          image: require("@/../public/img/prod1.png"),
          title: "台灣紀念酒杯",
          price: 150,
        },
        {
          image: require("@/../public/img/prod1.png"),
          title: "台灣紀念酒杯",
          price: 150,
        },
        {
          image: require("@/../public/img/prod1.png"),
          title: "台灣紀念酒杯",
          price: 150,
        },
        {
          image: require("@/../public/img/prod1.png"),
          title: "台灣紀念酒杯",
          price: 150,
        },
      ],
      cardsDisplay: [],
      pageSize: 6,
      currentPage: 1,
      prodCollect: []
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
      let memId = this.$store.state.memInfo.mem_id
      let prod_id = this.prodCollect[index].prod_id

      const formData = new FormData();
      formData.append("mem_id", memId);
      formData.append("prod_id", prod_id);
      // this.$apiUrl('delCollect.php')

      confirm('確定取消收藏嗎?')

      fetch(this.$apiUrl('delCollect.php'), {
        method: 'post',
        body: formData
      })
        .then(res => res.json())
        .then((res) => {
          if (!res.error) {
            alert(res.msg);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
      location.reload();
    },
    getCollect() {
      let memId = this.$store.state.memInfo.mem_id
      let formData = new FormData()
      formData.append("mem_id", memId);
      // this.$apiUrl('getArticleCollect.php')
      fetch(this.$apiUrl('getProdCollect.php'), {
        method: 'post',
        body: formData
      })
        .then(res => res.json())
        .then((res) => {
          this.prodCollect = res
        })
        .catch((error) => {
          console.error('數據傳輸失敗：', error);
        });

    }
  },
  mounted() {
    this.cardsDisplay = this.cards;
    this.getCollect()
  },
};
</script>

<style lang="scss">
.prodWrap {
  border: 1px solid #aaa;
  background-color: #fff;
  border-radius: 20px;
  width: 900px;

  h1 {
    text-align: center;
    margin: 30px 0;
  }

  .prodGrid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 300px);
    justify-items: center;
    // justify-content: center;
    align-items: center;
    padding: 0 30px;
    gap: 20px;

    .prodCard {
      .pic {
        img {
          width: 250px;
          height: 200px;
        }
      }

      .txt {
        // border: 1px solid red;
        // margin: auto;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        // .del{

        svg {
          cursor: pointer;
          font-size: 24px;
        }

        // }
      }
    }
  }

  #page {
    text-align: center;
  }
}

@media screen and (max-width: 414px) {
  .prodWrap {
    width: 100%;

    .prodGrid {
      display: block;

      .prodCard {
        margin: 10px 0;
      }
    }
  }
}
</style>
