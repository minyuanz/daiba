<template>
  <div class="forgetPwdWrap">
    <div class="forgetPwdPic">
      <img src="../../public/img/forgetpwd.png" />
    </div>
    <div class="forgetPwdText">
      <h1>忘記密碼</h1>
      <p>請選擇重設方式</p>
      <form action="pwdSuccess" class="forgetPwdForm">
        <div class="forgetPwd">
          <label for="email">信箱</label>
          <input type="email" id="email" />
        </div>
        <button class="btn_l">取得驗證碼</button>
        <div class="loginOr">OR</div>
        <div class="forgetPwdGender">
          <label for="phone">手機</label>
          <input type="tel" maxlength="10" id="phone" />
        </div>
        <button class="btn_l">取得驗證碼</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {},
};
</script>

<style lang="scss"></style>
