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
      <form action="" method="post">
        <div class="loginEmail">
          <label for="email">信箱</label>
          <input type="text" id="email" v-model="memId" />
        </div>
        <div class="loginPwd">
          <label for="pwd">密碼</label>
          <input type="password" id="pwd" v-model="memPwd" />
        </div>
        <router-link to="/ForgetPwd">忘記密碼 ?</router-link>
        <button class="btn_l btnlogin" type="button" @click="login">
          登入
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
      memId: "",
      memPwd: "",
    };
  },
  methods: {
    login() {
      if (this.memId == "" && this.memPwd == "") {
        alert("請輸入帳號和密碼")
      }
      else {
        // fetch()
        console.log(111);
      }
      // this.$router.push("/User")
    }
  },
};
</script>

<style lang="scss">
@import "../assets/scss/page/_Login.scss";
</style>
