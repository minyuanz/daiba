<template>
  <div class="CartWrap">
    <div class="CartSpeedBox">
      <div class="course">
        <section>
          <h4 class="SpeedNo info">1</h4>
          <h4 class="SpeedText ">購 物 車</h4>
        </section>
        <div></div>
        <section>
          <h4 class="SpeedNo unwork">2</h4>
          <h4 class="SpeedText">付款運送</h4>
        </section>
        <div></div>
        <section>
          <h4 class="SpeedNo unwork">3</h4>
          <h4 class="SpeedText">訂單完成</h4>
        </section>
      </div>
    </div>
    <div class="CartProBOX">
      <h2 class="CartProTitle">購物車</h2>
      <div class="CartProCardBox">
        <div class="CartProCardTitle">
          <div>商品圖</div>
          <div class="proName">商品名稱</div>
          <div>單價</div>
          <div>數量</div>
          <div>小計</div>
          <div class="delete">刪除</div>
        </div>
        <div v-for="(product, index) in cartItems" :key="index" class="CartProCardDetail">
          <div class="CardDetailImg">
            <img :src="`${this.$store.state.imgURLp}` +  product.prod_img1" alt="">
          </div>
          <div class="CardDetailTitle">{{ product.prod_name }}</div>
          <div class="CardDetailPrice">{{ product.prod_price }}</div>
          <div class="CardDetailCount">
            <div @click="decrementCount(product)">-</div>
            <p>{{ product.count }}</p>
            <div @click="incrementCount(product)">+</div>
          </div>
          <div class="CardDetailTotal">NT${{ product.prod_price * product.count }}</div>
          <div class="CardDetailDelet"  @click="removeFromCart(product)">x</div>
        </div>
      </div>
      <div class="CartProTotalBox">
        <p class="CartProTotalTitle">商品金額小記:</p>
        <p class="CartProTotalPrice">NT$ {{ cartTotal }}</p>
      </div>
    </div>
    <div class="CartBtmBox">
      <div class="btn_s" @click="goToStore">返回購物</div>
      <div class="btn_s" @click="gotoCheckout">前往結帳</div>
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
    const userInfo = localStorage.getItem('user');
    if (userInfo) {
      // 檢查用戶是否登入，有的話前往結帳頁面
      this.$router.push({ name: 'shopping', params: { cartItems: this.cartItems } });
    } else {
      // 如果未登入則跳轉登入頁面
      alert("請先登入會員");
      this.$router.push('/login');
    }
  },
  },
};
</script>

<style lang="scss">

</style>
