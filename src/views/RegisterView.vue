<template>
  <div class="registerWrap">
    <div class="registerPic">
      <img src="../../public/img/register.png" />
    </div>
    <div class="registerText">
      <h1>會員註冊</h1>
      <form action="RegSuccess" class="regForm">
        <div class="registerName">
          <label for="name">姓名</label>
          <input type="text" id="name" />
        </div>
        <div class="registerGender">
          <label for="gender">性別</label>
          <select>
            <option value="">男</option>
            <option value="">女</option>
          </select>
        </div>
        <div class="registerBir">
          <label for="bir">生日</label>
          <input type="date" id="bir" />
        </div>
        <div class="registerTel">
          <label for="tel">電話</label>
          <input type="text" id="tel" />
        </div>
        <div class="registerEmail">
          <label for="email">信箱</label>
          <input type="email" id="email" />
        </div>
        <div class="registerPwd">
          <label for="pwd">密碼</label>
          <input type="password" id="pwd" v-model="userPwd" />
        </div>
        <div class="registerCheck">
          <label for="check">再次輸入</label>
          <input type="password" id="check" />
        </div>
        <button class="btn_l">註冊</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userId: "",
      userPwd: "",
      userIdTrue: "qaq@gmail.com",
      userPwdTrue: 111,
    };
  },
  methods: {
    register() {
      if (this.userId == this.userIdTrue && this.userPwd == this.userPwdTrue) {
        alert("登入成功");
      } else {
        alert("登入失敗");
      }
    },
  },
};
</script>

<style lang="scss"></style>
