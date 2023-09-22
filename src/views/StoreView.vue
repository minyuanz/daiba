<template>
  <div class="storeWrap">
    <div class="storeTitle">精選購物</div>
    <div class="storeSearch">
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
    </div>
    <div class="storecardbox">
      <div v-for="item in testitem" :key="item.pord_id" class="storeCard">
        <router-link :to="{ name: 'storeDetail', params: { id: item.pord_id } }">
          <img
          class="storeCardimg"
          :src="item.prod_img1"
          alt=""
        />
      </router-link>
        <div class="storeBottom">
          <div class="storeCardText">
            <h3 class="CardDes">{{ item.pord_name }}</h3>
            <h4 class="CardPri">{{ item.pord_price }}</h4>
          </div>
          <div class="storeButton">
            <i class="fa-regular fa-heart" style="cursor: pointer"></i>
            <button class="btn_s">加入購物車</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useRouter } from "vue-router";
import ProTest from "@/testdata/ProTest.json"
export default {
  data() {
    return {
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
      this.$store.dispatch("addToCart", product);
    },
  },
};
</script>

<style lang="scss">
.storeWrap {
  max-width: 1200px;
  padding: 2.5rem 1.5rem;
  margin: auto;
  width: 100%;

  .storeTitle {
    font-size: map-get($map: $fontsizes, $key: h1);
    border-bottom: 5px black solid;
    padding-bottom: 15px;
    font-weight: bold;
  }
  .storeSearch {
    width: 100%;
    height: 10vh;
    display: flex;
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
      display: flex;
      flex-wrap: wrap;
      width: 31%;
      overflow: hidden;
      margin-block: 3.5rem;
      .storeCardimg {
        width: 100%;
        cursor: pointer;
      }

      .storeBottom {
        display: flex;
        width: 100%;
        justify-content: space-between;

        .storeCardText {
          width: 30%;
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
          display: flex;
          align-items: end;
          width: 70%;
          font-size: 30px;
          justify-content: end;
          button {
            margin-left: 1rem;
            width: 60%;
          }
        }
      }
    }
  }
}

@media screen and (max-width: 414px) {
}
</style>
