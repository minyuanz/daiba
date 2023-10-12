import { createStore } from "vuex";

const baseURL =
  process.env.NODE_ENV === "development"
    ? "/api"
    : "https://tibamef2e.com/cgd103/g1/api";
const publicURL =
  process.env.NODE_ENV === "development"
    ? ""
    : "https://tibamef2e.com/chd103/ingrid/koala";

const publicURLL = "https://tibamef2e.com/chd103/g5";

// const imgURL = process.env.NODE_ENV === "development" ? "http://localhost/dai/public/img/" : "https://tibamef2e.com/chd103/g5";
const imgURLp = process.env.NODE_ENV === "development" ? "http://localhost/dai/public/img/product/" : ""




export default createStore({
  state: {
    point: [],//儲存點數
    cart: [], // 儲存商品
    favorites: [],
    purchaseProcess: {},
    publicURLL,
    imgURL: process.env.VUE_APP_IMG_URL, //圖片路徑
    imgURLp,//商品圖片路徑
    memId: "", // 存會員的memId
    memInfo: "",
    loggedInUser: null, // 後台登入狀態
    mrtCardPage: [
      {
        id: 1,
        title: "台北101",
        grayTag: "景點推薦",
        colorTag: ['信義安和'],
        mrtimg1: require("../assets/images/mrtPag/oneoone/oneoone_1.jpg"),
        p1: "TAIPEI 101座落於台北最菁華地段，是國內建築界有史以來最大的工程專案。該專案主要由國內十四家企業共同組成的台北金融大樓股份有限公司，與國內外專業團隊聯手規劃，並由國際級建築大師李祖原精心設計，超越單一量體的設計觀，以吉祥數字「八」（「發」的諧音），作為設計單元。",
        mrtimg2: require("../assets/images/mrtPag/oneoone/oneoone_2.jpg"),
        p2: "前往台北101，當然不能錯過最經典的觀景台。觀景台分為室內和室外兩個區域，室內觀景台位於89F，室外則位於 91F，兩者都可以 360度視野俯瞰台北城市天際線，置身於雲霧間，感受極致高空美景，路面上的車水馬龍盡收眼底。",
        mrtimg3: require("../assets/images/mrtPag/oneoone/oneoone_3.jpg"),
        p3: "如果要參觀 91F 的室外觀景台，必須使用第 16號柱旁邊的樓梯上樓參觀。室外的觀景台為圓弧狀，外圍以鐵柵欄區隔，拍照不必擔心有玻璃反光，天氣好的時候格外舒適。",
        mrtimg4: require("../assets/images/mrtPag/oneoone/oneoone_4.jpg"),
        p4: "如果從室內觀景台下樓梯到 88 樓 (一樣位在第 16 號柱)爲風阻尼器參觀區。風阻尼器是一顆巨大鋼球，利用球的擺動物理來減緩建築物的晃動幅度，是全球唯二開放遊客觀賞的巨型阻尼器。",
        p5: "《 詳細資訊 》\n 地址: 台北市信義區市府路45號<br />購物中心:<br />➢ 周日至周四 11:00-21:30<br />➢ 周五、周六及國定假日前一天 11:00-22:00<br />觀景台:<br />➢ 周一至周日及國定假日 11:00-21:00<br />✦ 請先至購物中心五樓觀景台售票處",
        address: "台北市信義區市府路45號",
        tel: "02-8101-8800",
        time1: "周日至周四 11:00-21:30",
        time2: "周五、周六及國定假日前一天 11:00-22:00",
      },
      {
        id: 2,
        title: "四四南村",
        grayTag: "#景點推薦",
        colorTag: "#信義安和",
        mrtimg1: require("../assets/images/mrtPag/four/four_1.jpg"),
        p1: "來到四四南村一定會好奇由來，四四南村是台北市的第一個眷村，由大陸青島遷台的四十四兵工廠員工與眷屬所建，因為還心繫著有一天會反攻大陸，所以在這的住宅構造都很簡陋，想不到這一等就沒有了下文直至現今，原本還有四四東村跟西村，但都市計畫，現存的也只有這塊小小的眷村土地了",
        mrtimg2: require("../assets/images/mrtPag/four/four_2.jpg"),
        p2: "現有的南村規劃成了信義公民會館，也是眷村文化公園，由四棟建築而組成，分成四個區域有著不同的主題，分別是台北信義親子館、臺北眷村文物館、好丘Goodcho’s、跟PLAYground南村劇場‧青鳥·有.設計。眷村中的中央廣場，則是在假日有文青市集",
        mrtimg3: require("../assets/images/mrtPag/four/four_3.jpg"),
        p3: "四四南村B館，主要為四四南村文化保存靜態展示，展示主題包括：四四南村歷史軌跡、眷村藝文、眷村媽媽、眷村美食、眷村生活、遊戲人間、手工藝及多媒體放映室…等等。",
        mrtimg4: require("../assets/images/mrtPag/four/four_4.jpg"),
        p4: "四四南村C館，也有個常態性創意市集，大家熱愛的四四南村美食「好，丘」，餐飲以輕食為主，包括麵包、貝果、漢堡及咖啡飲料等，融合眷村文化提供藝展活動，是一處休閒用餐的好去處。",
        p5: "《 詳細資訊 》\n 地址: 台北市信義區市府路45號<br />購物中心:<br />➢ 周日至周四 11:00-21:30<br />➢ 周五、周六及國定假日前一天 11:00-22:00<br />觀景台:<br />➢ 周一至周日及國定假日 11:00-21:00<br />✦ 請先至購物中心五樓觀景台售票處",
        address: "台北市信義區信義路五段24巷5弄",
        tel: "02-2723-7937",
        time1: "週二至週日 09:00-17:00",
        time2: "週一公休",
      },
    ],
  },

  getters: {
    cartTotal(state) {
      // 計算總價
      return state.cart.reduce(
        (total, product) => total + product.prod_price * product.count,
        0
      );
    },
    //算商品總數
    cartItemCount(state) {
      return state.cart.length;
    },
  },
  mutations: {
    addToCart(state, product) {
      // 添加商品到購物車
      product.count = product.count || 1;
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
      const cartItem = state.cart.find(
        (item) => item.prod_id === product.prod_id
      );
      if (cartItem) {
        cartItem.count++;
      }
    },
    decrementCount(state, product) {
      // 在購物車中減少數量
      const cartItem = state.cart.find(
        (item) => item.prod_id === product.pord_id
      );
      if (cartItem && cartItem.count > 1) {
        cartItem.count--;
      }
    },
    getId(state, memId) {
      // 拿到會員的memId
      state.memId = memId
    },
    getInfo(state, memInfo) {
      // 拿到會員的memInfo
      state.memInfo = memInfo
    },
    setLoggedInUser(state, user) {//後台loco的數據暫存
      state.loggedInUser = user;
    },
  },
  actions: {
    addToCart({ commit, state }, product) {
      // 檢查購物車中 商品是否重複
      const existingProduct = state.cart.find(
        (item) => item.prod_id === product.prod_id
      );

      if (existingProduct) {
        //如果有 則加一個
        existingProduct.count += product.count;
        commit("updateCart", state.cart);
      } else {
        // 沒有則 加入購物車
        commit("addToCart", product);
      }
    },
    removeFromCart({ commit, state }, product) {
      // 移除購物車該商品
      const index = state.cart.findIndex(
        (item) => item.prod_id === product.prod_id
      );

      if (index !== -1) {
        commit("removeFromCart", index);
      }
    },
    login({ commit }, user) {
      // 針對登入後的操錯 這邊先暫存  之後用權限備用
      // 假设登录成功后，后端返回的用户信息包含在 user 对象中
      commit('setLoggedInUser', user);
    },
    // clearCart({ commit }) {
    //   // 清空購物車
    //   commit('clearCart');
    // },
  },
  modules: {},
});
