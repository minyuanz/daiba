<template>
  <div class="storeWrap">
    <h1 class="storeTitle">精選購物</h1>
    <div class="storeFilter">
      <button @click="filterProducts('all')">全部</button>
      <button @click="filterProducts('Souvenir')">伴手禮</button>
      <button @click="filterProducts('memento')">紀念品</button>
    </div>
    <div class="storecardbox">
      <div v-for="item  in paginatedProducts "  :key="item.pord_id"  class="storeCard">
        <div style="display:none ;">{{ item.prod_type }}</div>
        <router-link :to="'/storeDetail/' + item.prod_id">
          <div class="imgbox">
            <img  class="storeCardimg" :src="$imgUrl(item.prod_img1)"/>
            <!-- <div class="storeButton addToHeart">
              <i class="fa-regular fa-heart" style="cursor: pointer"></i>
            </div> -->
          </div>
      </router-link>
        <div class="storeBottom">
          <div class="storeCardText">
            <h2 class="CardDes">{{ item.prod_name }}</h2>
            <h3 class="CardPri">NT${{ item.prod_price }}</h3>
          </div>
          <div class="storeButton">
            <button class="btn_s" @click="addToCart(item)">加入購物車</button>
          </div>
        </div>
      </div>
    </div>
    <div class="pagination">
      <button class="paginationmain" @click="prevPage" :disabled="currentPage === 1 || isLoading">
        ＜
      </button>
      <button class="paginationmain" @click="goToPage(page)" v-for="page in totalPages" :key="page" :class="{ 'current-page': page === currentPage }">
        {{ page }}
      </button>
      <button class="paginationmain" @click="nextPage" :disabled="currentPage === totalPages || isLoading">
        ＞
      </button>
    </div>
  </div>
</template>

<script>
// import ProTest from "@/testdata/ProTest.json";
import axios from 'axios';
export default {
  components: {},
  data() {
    return {
      allProducts: [], // 假設顯示所有商品數據
      pageSize: 6, // 每頁顯示數量
      currentPage: 1, // 當前頁數
      selectedType: 'all',
      isLoading: true,
      // testitem: ProTest,
    };
  },
  created() {
        this.fetchData(); 
    },
  methods: {
    fetchData() {
            axios.get(this.$apiUrl('ProductM.php'))
            .then((response) => {
            this.allProducts = response.data; // 更新數據到 products
            this.isLoading = false;
        })
            .catch((error) => {
            console.error('數據傳輸失敗：', error);
        });
        },
        filterProducts(type) {
          this.selectedType = type;
          this.currentPage = 1; // 将当前页数重置为第一页
        },
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
      window.scrollTo(0, 0);
    },
  },
  computed: {
  paginatedProducts() {
    const startIndex = (this.currentPage - 1) * this.pageSize;
    const endIndex = startIndex + this.pageSize;
    const filteredProducts = this.allProducts.filter(item => {
      if (this.selectedType === 'all') {
        return true;
      } else {
        return item.prod_type === this.selectedType;
      }
    });
    return filteredProducts.slice(startIndex, endIndex);
  },
  totalPages() {
    const filteredProducts = this.allProducts.filter(item => {
      if (this.selectedType === 'all') {
        return true;
      } else {
        return item.prod_type === this.selectedType;
      }
    });
    return Math.ceil(filteredProducts.length / this.pageSize);
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
  .storeFilter{
    width: 100%;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    button {
        width: 100px;
        height: 70px;
        border: 2px solid #666;
        background-color: transparent;
        cursor: pointer;
        border-radius: 10px;
        margin: 30px;
        transition: all 0.3s;
        &:hover {
          // border: 2px solid #333;
          background-color: #ddd;
        }
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
      font-weight: bold;
      text-align: center;
      padding: 0;
      
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
      // flex-wrap: wrap;
      // justify-content: flex-start;
      gap: 16px;

      .storeCard {
        margin: 0px;
        display: flex;
        flex-direction: column;
        width: calc(50% - 8px);
        padding: 0.8rem;
        .imgbox{
       .storeCardimg {
        width: 100%;
        object-fit: cover;
        cursor: pointer;
      }
      .storeButton{
          right: 5px;
          bottom: 5px;
        }
      }
        .storeBottom {
          margin-top: .2rem;
          display: flex;
          flex: 1;
          flex-direction: column;
          justify-content: space-between;
          .storeCardText {
            width: 100%;
            .CardDes {
              margin: 0px 0 0 0;
              font-size: 18px;
              line-height: 24px;
            }
            .CardPri {
              color: #5b5b5b;
              font-size: 18px;
              line-height: 24px;
            }
          }
          .storeButton {
            margin-top: 10px;
            display: block;
            width: 100%;
            position: relative;
            button {
              width: 100%;
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
      margin: 5rem auto 0;
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
