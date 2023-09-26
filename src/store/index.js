import { createStore } from "vuex";

const baseURL =
  process.env.NODE_ENV === "development"
    ? "/api"
    : "https://tibamef2e.com/cgd103/g1/api";
const publicURL =
  process.env.NODE_ENV === "development"
    ? ""
    : "https://tibamef2e.com/chd103/ingrid/koala";
export default createStore({
  state: {
    cart: [], // 儲存商品
    favorites: [],  
    purchaseProcess: {},
  },
  getters: {
    cartTotal(state) {
      // 計算總價
      return state.cart.reduce((total, product) => total + product.pord_price * product.count, 0);
    },
    //算商品總數
    cartItemCount(state) {
      return state.cart.length; 
    },
  },
  mutations: {
    addToCart(state, product) {
      // 添加商品到購物車
      product.count = 1;
      state.cart.push(product);
    },
    removeFromCart(state, index) {
      // 刪除商品
      state.cart.splice(index, 1);
    },
    // clearCart(state) {
    //   // 清空購物車
    //   state.cart = [];
    // },
    incrementCount(state, product) {
      // 在購物車中 增加數量
      const cartItem = state.cart.find(item => item.pord_id === product.pord_id);
      if (cartItem) {
        cartItem.count++;
      }
    },
    decrementCount(state, product) {
      // 在購物車中減少數量
      const cartItem = state.cart.find(item => item.pord_id === product.pord_id);
      if (cartItem && cartItem.count > 1) {
        cartItem.count--;
      }
    },
  },
  actions: {
    addToCart({ commit, state }, product) {
      // 檢查購物車中 商品是否重複
      const existingProduct = state.cart.find(item => item.pord_id === product.pord_id);

      if (existingProduct) {
        //如果有 則加一個
        commit('incrementCount', existingProduct);
      } else {
        // 沒有則 加入購物車
        commit('addToCart', product);
      }
    },
    removeFromCart({ commit, state }, product) {
      // 移除購物車該商品
      const index = state.cart.findIndex(item => item.pord_id === product.pord_id);

      if (index !== -1) {
        commit('removeFromCart', index);
      }
    },
    // clearCart({ commit }) {
    //   // 清空購物車
    //   commit('clearCart');
    // },
  },
  modules: {},
});
