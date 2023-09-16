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
    cart: [],
    favorites: [],
    purchaseProcess: {},
  },
  getters: {
    cartTotal(state) {
      return state.cart.length;
    },
  },
  mutations: {
    addToCart(state, product) {
      state.cart.push(product);
    },
  },
  actions: {
    addToCart(context, product) {
      context.commit("addToCart", product);
    },
  },
  modules: {},
});
