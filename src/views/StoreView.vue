<template>
  <div class="storeWrap">
    <h1 class="storeTitle">精選購物</h1>
    <!-- <div class="storeSearch">
      <div class="storeSearchMrt">
        <span>捷運線選擇</span>
        <i class="fa-solid fa-play fa-rotate-90"></i>
        <ul class="SearchMrtBox">
          <li v-for="i in 5">選項1</li>
        </ul>
      </div>
      <div class="storeSearchSta">
        <span>捷運站選擇</span>
        <i class="fa-solid fa-play fa-rotate-90"></i>
        <ul class="SearchStaBox">
          <li v-for="i in 5">選項1</li>
        </ul>
      </div>
      <div class="storeSearchSP">
        <span>特色選擇</span>
        <i class="fa-solid fa-play fa-rotate-90"></i>
        <ul class="SearchSPBox">
          <li v-for="i in 5">選項1</li>
        </ul>
      </div>
      <button class="storeSearchBt">搜尋</button>
    </div> -->
    <div class="storecardbox">
      <div v-for="item  in paginatedProducts "  :key="item.pord_id"  class="storeCard">
        <router-link :to="'/storeDetail/' + item.pord_id" >
          <div class="imgbox">
            <img  class="storeCardimg" :src="item.prod_img1" alt=""/>
            <div class="storeButton">
              <i class="fa-regular fa-heart" style="cursor: pointer"></i>
            </div>
          </div>
      </router-link>
        <div class="storeBottom">
          <div class="storeCardText">
            <h2 class="CardDes">{{ item.pord_name }}</h2>
            <h3 class="CardPri">NT${{ item.pord_price }}</h3>
          </div>
          <div class="storeButton">
            <button class="btn_s" @click="addToCart(item)">加入購物車</button>
          </div>
        </div>
      </div>
    </div>
    <div class="pagination">
      <button
        class="paginationmain"
        @click="prevPage"
        :disabled="currentPage === 1"
      >
        ＜
      </button>
      <button
        class="paginationmain"
        @click="goToPage(page)"
        v-for="page in totalPages"
        :key="page"
        :class="{ 'current-page': page === currentPage }"
      >
        {{ page }}
      </button>
      <button
        class="paginationmain"
        @click="nextPage"
        :disabled="currentPage === totalPages"
      >
        ＞
      </button>
    </div>
  </div>
</template>

<script>
import ProTest from "@/testdata/ProTest.json";
export default {
  components: {},
  data() {
    return {
      allProducts: ProTest, // 假設顯示所有商品數據
      pageSize: 6, // 每頁顯示數量
      currentPage: 1, // 當前頁數
      testitem: ProTest,
    };
  },
  methods: {
    // goToStoreDetail(Detail) {
    //   this.$router.push({
    //     name: 'storeDetail',
    //     params: {
    //       id:Detail
    //       }
    //   });
    // },
    addToCart(product) {
      this.$store.dispatch('addToCart', { ...product, count: this.count });
      alert("已加入購物車");
    },
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
  },
  computed: {
    paginatedProducts() {
      const startIndex = (this.currentPage - 1) * this.pageSize;
      const endIndex = startIndex + this.pageSize;
      return this.allProducts.slice(startIndex, endIndex);
    },
    totalPages() {
      return Math.ceil(this.allProducts.length / this.pageSize);
    },
  },
};
</script>

<style lang="scss">
.storeWrap {
  max-width: 1200px;
  margin: auto;
  width: 100%;

  .storeTitle {
    // border-bottom: 5px black solid;
    margin: 3rem 0;
    text-align: center;
  }
  .storeSearch {
    width: 100%;
    height: 10vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: map-get($map: $fontsizes, $key: h4);

    .storeSearchMrt {
      border: 3px solid black;
      padding: 0 0.5rem;
      margin-right: 50px;
      span {
        font-size: map-get($map: $fontsizes, $key: h4);
        margin-right: 20px;
      }
      &:hover .SearchMrtBox {
        display: block;
      }
      .SearchMrtBox {
        display: none;
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        li {
          padding: 12px 16px;
          text-decoration: none;
          cursor: pointer;
          &:hover {
            background-color: rgb(108, 108, 108);
            color: #fffcfc;
          }
        }
      }
    }
    .storeSearchSta {
      border: 3px solid black;
      padding: 0 0.5rem;
      margin-right: 50px;
      span {
        font-size: map-get($map: $fontsizes, $key: h4);
        margin-right: 20px;
      }
      &:hover .SearchStaBox {
        display: block;
      }
      .SearchStaBox {
        display: none;
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        li {
          padding: 12px 16px;
          text-decoration: none;
          cursor: pointer;
          &:hover {
            background-color: rgb(108, 108, 108);
            color: #fffcfc;
          }
        }
      }
    }
    .storeSearchSP {
      border: 3px solid black;
      padding: 0 0.5rem;
      margin-right: 50px;
      span {
        font-size: map-get($map: $fontsizes, $key: h4);
        margin-right: 20px;
      }
      &:hover .SearchSPBox {
        display: block;
      }
      .SearchSPBox {
        display: none;
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        li {
          padding: 12px 16px;
          text-decoration: none;
          cursor: pointer;
          &:hover {
            background-color: rgb(108, 108, 108);
            color: #fffcfc;
          }
        }
      }
    }
    .storeSearchBt {
      width: 100px;
    }
  }
  .storecardbox {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;

    .storeCard {
      border: #eee 8px solid;
      width: 32%;
      overflow: hidden;
      padding: 2rem;
      margin-block: 2rem;
      .imgbox{
        width: 100%;
        // height: 300px;
        position: relative;
      .storeCardimg {
        width: 100%;
        cursor: pointer;
        object-fit: cover;
      }
      .storeButton {
          position: absolute;
          right: 10px;
          bottom: 10px;
          font-size: 30px;
          z-index: 2;
          .fa-heart{
            color:#ddd;
            // background-color: #fff;
          }
        }
      }
      .storeBottom {
        // display: flex;
        width: 100%;
        position: relative;

        .storeCardText {
          width: 100%;
          display: flex;
          flex-wrap: wrap;
          flex-direction: column;

          .CardDes {
            font-size: 30px;
            margin: 10px 0 ;
            // color: #444;

          }
          .CardPri {
            color: #5b5b5b;
          }
        }
        .storeButton {
          position: absolute;
          bottom: 0;
          right: 0;
          width: 180;
          font-size: 30px;
          button {
            width: 160px;
          }
        }
      }
    }
  }
  .pagination {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 5rem auto;
    .paginationmain {
      margin: 0 .5rem;
      cursor: pointer;
      width: 45px;
      height: 45px;
      border: none;
      background: none;
      color: #555;
      font-size:18px;
    }
    .current-page {
      border: 1px solid #999;
      border-radius: 50%;
    }
  }
}

@media screen and (max-width: 414px) {
  .storeWrap {
    max-width: 414px;
    padding: 2.5rem 1.5rem;
    margin: auto;
    width: 100%;

    .storeTitle {
      font-size: map-get($map: $fontsizes, $key: h1);
      border-bottom: NONE;
      padding-bottom: 15px;
      font-weight: bold;
      text-align: center;
      padding: 50px;
    }
    .storeSearch {
      width: 100%;
      height: 10vh;
      display: flex;
      justify-content: space-evenly;
      margin: auto;
      align-items: center;
      font-size: map-get($map: $fontsizes, $key: h4);

      .storeSearchMrt {
        border: 3px solid black;
        padding: 0 0rem;
        margin-right: 0px;
        span {
          font-size: map-get($map: $fontsizes, $key: h4);
          margin-right: 0px;
        }
        &:hover .SearchMrtBox {
          display: block;
        }
        .SearchMrtBox {
          display: none;
          position: absolute;
          background-color: white;
          border: 1px solid #ccc;
          width: 150px;
          box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
          li {
            padding: 12px 16px;
            text-decoration: none;
            cursor: pointer;
            &:hover {
              background-color: rgb(108, 108, 108);
              color: #fffcfc;
            }
          }
        }
      }
      .storeSearchSta {
        border: 3px solid black;
        padding: 0 0rem;
        margin-right: 0px;
        span {
          font-size: map-get($map: $fontsizes, $key: h5);
          margin-right: 0px;
        }
        &:hover .SearchStaBox {
          display: block;
        }
        .SearchStaBox {
          display: none;
          position: absolute;
          background-color: white;
          border: 1px solid #ccc;
          width: 150px;
          box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
          li {
            padding: 12px 16px;
            text-decoration: none;
            cursor: pointer;
            &:hover {
              background-color: rgb(108, 108, 108);
              color: #fffcfc;
            }
          }
        }
      }
      .storeSearchSP {
        border: 3px solid black;
        padding: 0 0rem;
        margin-right: 0px;
        span {
          font-size: map-get($map: $fontsizes, $key: h4);
          margin-right: 0px;
        }
        &:hover .SearchSPBox {
          display: block;
        }
        .SearchSPBox {
          display: none;
          position: absolute;
          background-color: white;
          border: 1px solid #ccc;
          width: 150px;
          box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
          li {
            padding: 12px 16px;
            text-decoration: none;
            cursor: pointer;
            &:hover {
              background-color: rgb(108, 108, 108);
              color: #fffcfc;
            }
          }
        }
      }
    }
    .storecardbox {
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-evenly;

      .storeCard {
        margin: 5px;
        display: flex;
        flex-wrap: wrap;
        width: 45%;
        overflow: hidden;
        .imgbox{
        width: 100%;
        height: 200px;
       .storeCardimg {
        width: 100%;
        height: 200px;
        object-fit: cover;
        cursor: pointer;
      }
      }
        .storeBottom {
          display: flex;
          flex-wrap: wrap;
          width: 100%;
          justify-content: space-between;

          .storeCardText {
            width: 100%;
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;

            .CardDes {
              margin: 10px 0 0 0;
            }
            .CardPri {
              color: #5b5b5b;
            }
          }
          .storeButton {
            margin-top: 10px;
            display: flex;
            align-items: end;
            width: 100%;
            font-size: 30px;
            justify-content: end;
            button {
              font-size: 16px;
              margin-left: 1rem;
              width: 100px;
            }
          }
        }
      }
    }
    .pagination {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: auto;
      .paginationmain {
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
</style>
