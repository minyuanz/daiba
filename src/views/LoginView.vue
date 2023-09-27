<template>
  <div class="loginWrap">
    <div class="loginPic">
      <img src="../../public/img/login.png" />
    </div>
    <div class="loginText">
      <h1>會員登入</h1>
      <div class="loginOther">
        <button class="btn_l">
          <i class="fa-brands fa-google"></i>
          <span> Google登入 </span>
        </button>
        <button class="btn_l">
          <i class="fa-brands fa-facebook"></i>
          <span> Facebook登入 </span>
        </button>
      </div>
      <div class="loginOr">OR</div>
      <form action="" method="">
        <div class="loginEmail">
          <label for="email">信箱</label>
          <input type="text" id="email" v-model="userId" />
        </div>
        <div class="loginPwd">
          <label for="pwd">密碼</label>
          <input type="password" id="pwd" v-model="userPwd" />
        </div>
        <router-link to="/ForgetPwd">忘記密碼 ?</router-link>
        <button class="btn_l btnlogin" type="button">
          <router-link to="/User">登入</router-link>
        </button>
      </form>
      <router-link to="/RegisterView">還沒有會員 ? 會員註冊</router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userId: "",
      userPwd: "",
      userIdTrue: "111",
      userPwdTrue: 111,
      toggle: true,
      formAction: "",
    };
  },
  methods: {},
};
</script>

<style lang="scss">
@import "../assets/scss/page/_Login.scss";
</style>
