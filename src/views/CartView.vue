<template>
  <div class="CartWrap">
    <div class="CartSpeedBox">
      <div class="SpeedNo">
        <div>1</div>
        <div>2</div>
        <div>3</div>
      </div>
      <div class="SpeedText">
        <div>購物車</div>
        <div>付款運送</div>
        <div>訂單完成</div>
      </div>
    </div>
    <div class="CartProBOX">
      <div class="CartProTitle">購物車</div>
      <div class="CartProCardBox">
        <div class="CartProCardTitle">
          <div>商品資料</div>
          <div></div>
          <div>單價</div>
          <div>數量</div>
          <div>小計</div>
          <div></div>
        </div>
        <div v-for="(product, index) in cartItems" :key="index" class="CartProCardDetail">
          <div class="CardDetailImg">
            <img :src="product.prod_img1" alt="" />
          </div>
          <div class="CardDetailTitle">{{ product.pord_name }}</div>
          <div class="CardDetailPrice">{{ product.pord_price }}</div>
          <div class="CardDetailCount">
            <div @click="decrementCount(product)">-</div>
            <p>{{ product.count }}</p>
            <div @click="incrementCount(product)">+</div>
          </div>
          <div class="CardDetailTotal">NT${{ product.pord_price * product.count }}</div>
          <div class="CardDetailDelet"  @click="removeFromCart(product)">x</div>
        </div>
      </div>
      <div class="CartProTotalBox">
        <p class="CartProTotalTitle">商品金額小記:</p>
        <p class="CartProTotalPrice">NT$ {{ cartTotal }}</p>
      </div>
    </div>
    <div class="CartBtmBox">
      <div class="CartBtnBack" @click="goToStore">返回購物</div>
      <div class="CartBtnBackNex" @click="gotoCheckout">前往結帳</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      count: 1,
    };
  },
  computed: {
    cartItems() {
    return this.$store.state.cart;
  },
  cartTotal() {
    return this.$store.getters.cartTotal;
  },
},
  methods: {
    //刪除商品
    removeFromCart(product) {
    this.$store.dispatch('removeFromCart', product);
  },
  // 清空商品
  // clearCart() {
  //   this.$store.dispatch('clearCart');
  // },
  // 減少數量
  decrementCount(product) {
    this.$store.commit('decrementCount', product);
  },//增加數量
  incrementCount(product) {
    this.$store.commit('incrementCount', product);
  },
    goToStore() {
      this.$router.push("/Store");
    },
    gotoCheckout() {
  this.$router.push({ name: 'shopping', params: { cartItems: this.cartItems } });
},
  },
};
</script>

<style lang="scss">
.CartWrap {
  position: relative;
  max-width: 1200px;
  padding: 2.5rem 1.5rem;
  margin: auto;
  width: 100%;
  .CartSpeedBox {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    .SpeedNo {
      position: relative;
      width: 100%;
      display: flex;
      justify-content: space-around;
      align-items: center;
      div {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: map-get($map: $fontsizes, $key: h3);
        text-align: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: gray;
      }
    }
    .SpeedText {
      position: relative;
      width: 100%;
      display: flex;
      justify-content: space-around;
      align-items: center;
      margin: auto;
      div {
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: map-get($map: $fontsizes, $key: h3);
        text-align: center;
      }
    }
  }
  .CartProBOX {
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    background-color: rgb(234, 233, 233);
    width: 100%;
    .CartProTitle {
      padding: 30px;
      font-size: map-get($map: $fontsizes, $key: h3);
    }
    .CartProCardBox {
      display: flex;
      flex-wrap: wrap;
      width: 100%;
      font-size: map-get($map: $fontsizes, $key: h4);
      background-color: white;
      border-bottom: 1px solid gray;
      margin: auto;
      .CartProCardTitle {
        width: 100%;
        display: flex;
        margin: auto;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding: 10px 0;
        div {
          width: 16%;
        }
      }
      .CartProCardDetail {
        box-sizing: border-box;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        width: 100%;
        display: flex;
        margin: auto;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding: 10px 0;
        div {
          width: 16%;
        }
        .CardDetailImg {
          img {
            width: 100%;
            height: 150px;
            padding: 10px;
          }
        }
        // .CardDetailTitle{}
        // .CardDetailPrice{}
        .CardDetailCount {
          display: flex;
          margin: 0;
          p {
            border: 1px solid black;
            width: 70%;
          }
          div {
            border: 1px solid black;
            font-size: map-get($map: $fontsizes, $key: h3);
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
          }
        }
        // .CardDetailTotal{}
        .CardDetailDelet {
          cursor: pointer;
          font-weight: bold;
        }
      }
    }
    .CartProTotalBox {
      display: flex;
      padding: 30px;
      align-items: center;
      justify-content: right;
      .CartProTotalTitle {
        font-size: map-get($map: $fontsizes, $key: h4);
      }
      .CartProTotalPrice {
        padding-left: 10px;
        letter-spacing: 5px;
        color: rgb(236, 85, 112);
        font-size: map-get($map: $fontsizes, $key: h3);
      }
    }
  }
  .CartBtmBox {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: end;
    padding: 20px;
    .CartBtnBack {
      width: 300px;
      text-align: center;
      cursor: pointer;
      border: 1px solid red;
      border-radius: $border-radius;
      font-size: map-get($map: $fontsizes, $key: h3);
      padding: 10px 40px;
    }
    .CartBtnBackNex {
      width: 300px;
      margin-left: 10px;
      text-align: center;
      cursor: pointer;
      background-color: rgb(236, 85, 112);
      border: 1px solid red;
      border-radius: $border-radius;
      font-size: map-get($map: $fontsizes, $key: h3);
      padding: 10px 40px;
    }
  }
}
</style>
