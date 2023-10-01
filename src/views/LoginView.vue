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
          <input type="email" id="email" name="email" v-model="memEmail" />
        </div>
        <div class="loginPwd">
          <label for="pwd">密碼</label>
          <input type="password" id="pwd" name="pwd" v-model="memPwd" />
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
      memEmail: "",
      memPwd: "",
    };
  },
  methods: {
    login() {
      if (this.memEmail == "" && this.memPwd == "") {
        alert("請輸入帳號和密碼")
      }
      else {
        // 創建一個新的 FormData 對象
        let formData = new FormData();
        // 將表單數據添加到 FormData 對象中
        formData.append("memEmail", this.memEmail);
        formData.append("memPwd", this.memPwd);


        fetch(`http://localhost/dai/public/phps/login.php`, {
          method: "post",
          // headers: {
          //   'content-type': 'multipart/form-data'
          // },
          // credentials: 'include',
          body: formData
        })
          .then(res => res.json())
          .then((res) => {
            console.log(res);
            if (!res.error) {
              alert('login成功');
              // clearForm();
              // this.$router.push("/home")
            }
          })
          .catch(function (error) {
            console.log(error);
          })
        // console.log(111);
        // fetch("http://localhost/dai/public/phps/login.php", {
        //   method: "post",
        //   headers: {
        //     "Content-Type": "application/x-www-form-urlencoded"
        //   },
        //   // // credentials: "include",
        //   body: new URLSearchParams({
        //     mem_email: this.memEmail,
        //     mem_pwd: this.memPwd
        //   })
        // })
        //   .then(res => res.json())
        //   .then((res) => {
        //     console.log(res);
        //     if (!res.error) {
        //       alert('login成功');

        //     }
        //   })
        //   .catch(function (error) {
        //     console.log(error);

        //   })
      }
      // this.$router.push("/User")
    }
  },
};
</script>

<style lang="scss">
@import "../assets/scss/page/_Login.scss";
</style>
