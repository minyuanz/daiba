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
          <!-- <i class="fa-solid fa-face-surprise"></i> -->
          <span> Google登入 </span>
        </button>
        <button class="btn_l">
          <i class="fa-brands fa-facebook"></i>
          <!-- <i class="fa-regular fa-face-smile"></i> -->
          <span> Facebook登入 </span>
          <!-- <i class="fa-brands fa-facebook"></i> -->
        </button>
      </div>
      <div class="loginOr">OR</div>
      <form :action="formAction" class="loginForm">
        <div class="loginEmail">
          <label for="email">信箱</label>
          <input type="text" id="email" v-model="userId" />
          <!-- {{ userId }} -->
        </div>
        <div class="loginPwd">
          <label for="pwd">密碼</label>
          <input type="password" id="pwd" v-model="userPwd" />
          <!-- {{ userPwd }} -->
        </div>
        <a href="forgetPwd">忘記密碼 ?</a>
        <button class="btn_l" @click="login">登入</button>
      </form>
      <a href="RegisterView">還沒有會員 ? 會員註冊</a>
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
  methods: {
    login() {
      if (this.userId == this.userIdTrue && this.userPwd == this.userPwdTrue) {
        alert("登入成功"), (this.formAction = "/User");
      } else {
        alert("登入失敗");
      }
    },
  },
};
</script>

<style lang="scss"></style>
