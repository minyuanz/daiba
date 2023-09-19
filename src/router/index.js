import { createRouter, createWebHistory } from "vue-router";
// import HomeView from "../views/HomeView.vue";
// import LoginView from "@/views/LoginView.vue";
// import storeView from "@/views/storeView.vue";
// import NotFound from "@/views/NotFoundView.vue";

const routes = [
  {
    path: "/",
    name: "Main",
    component: () =>
    import(/* webpackChunkName: "About" */ "../views/Main.vue"),
    // meta: {
    //   useAppLayout: false, // 不使用 App.vue 佈局
    // },
  },
  {
    path: "/home",
    name: "home",
    // component: HomeView,
    component: () =>
    import(/* webpackChunkName: "About" */ "../views/HomeView.vue"),
    // meta: {
    //   useAppLayout: false, // 不使用 App.vue 佈局
    // },
  },
  {
    path: "/about",
    name: "about",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "About" */ "../views/AboutView.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () =>
      import(/* webpackChunkName: "Login" */ "@/views/LoginView.vue"),
  },
  {
    path: "/registerView",
    name: "register",
    component: () =>
      import(/* webpackChunkName: "Register" */ "@/views/RegisterView.vue"),
  },
  {
    path: "/regSuccess",
    name: "regSuccess",
    component: () =>
      import(/* webpackChunkName: "RegSuccess" */ "@/views/RegSuccess.vue"),
  },
  {
    path: "/store",
    name: "store",
    component: () =>
      import(/* webpackChunkName: "Store" */ "@/views/StoreView.vue"),
  },
  {
    path: "/storeDetail/:id'",
    name: "storeDetail",
    component: () =>
      import(/* webpackChunkName: "Store" */ "@/views/StoreDetailView.vue"),
  },
  {
    path: "/mrt",
    name: "mrt",
    // component: LoginView,
    component: () =>
      import(/* webpackChunkName: "Mrt" */ "@/views/MrtView.vue"),
  },
  {
    path: "/mrtContributeInPage",
    name: "mrtContributeInPage",
    // component: MrtContributeInPageView,
    component: () =>
      import(
        /* webpackChunkName: "MrtContributeInPage" */ "@/views/MrtContributeInPageView.vue"
      ),
  },
  {
    path: "/Game",
    name: "game",
    // component: LoginView,
    component: () =>
      import(/* webpackChunkName: "Game" */ "@/views/GameView.vue"),
  },
  {
    path: "/contribute",
    name: "contribute",
    // component: LoginView,
    component: () =>
      import(/* webpackChunkName: "Contribute" */ "@/views/ContributeView.vue"),
  },
  {
    path: "/Submit",
    name: "Submit",
    // component: LoginView,
    component: () =>
      import(/* webpackChunkName: "Contribute" */ "@/views/Submit.vue"),
  },
  {
    path: "/new",
    name: "new",
    // component: LoginView,
    component: () =>
      import(/* webpackChunkName: "New" */ "@/views/NewView.vue"),
  },

  {
    path: "/forgetPwd",
    name: "forgetPwd",
    component: () =>
      import(/* webpackChunkName: "ForgetPwd" */ "@/views/ForgetPwd.vue"),
  },

  {
    path: "/cart",
    name: "cart",
    component: () =>
      import(/* webpackChunkName: "Cart" */ "@/views/CartView.vue"),
  },
  {
    path: "/shopping",
    name: "shopping",
    component: () =>
      import(/* webpackChunkName: "Cart" */ "@/views/Shopping.vue"),
  },
  {
    path: "/shoppingDone",
    name: "shoppingDone",
    component: () =>
      import(/* webpackChunkName: "Cart" */ "@/views/ShoppingDone.vue"),
  },
  {
    path: "/pwdSuccess",
    name: "pwdSuccess",
    component: () =>
      import(/* webpackChunkName: "PwdSuccess" */ "@/views/PwdSuccess.vue"),
  },
  {
    path: "/newinside",
    name: "newinside",
    component: () =>
      import(/* webpackChunkName: "Newinside" */ "@/views/Newinside.vue"),
  },
  {
    path: "/MemberPagesBgc",
    name: "MemberPagesBgc",
    component: () =>
      import(
        /* webpackChunkName: "MemberPagesBgc" */ "@/views/MemberPagesBgc.vue"
      ),
  },
  {
    path: "/user",
    name: "/user",
    component: () => import(/* webpackChunkName: "User" */ "@/views/User.vue"),
  },

  {
    path: "/:pathMatch(.*)*",
    name: "NotFound",
    component: () =>
      import(/* webpackChunkName: "err" */ "@/views/NotFoundView.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    // 始终滚动到顶部
    return { top: 0 };
  },
});

export default router;
