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
      if (this.memEmail == "" || this.memPwd == "") {
        alert("請輸入帳號和密碼")
      }
      else {
        // 創建一個新的 FormData 對象
        let formData = new FormData();
        // 將表單數據添加到 FormData 對象中
        formData.append("mem_email", this.memEmail);
        formData.append("mem_pwd", this.memPwd);

        // https://tibamef2e.com/chd103/g5
        // http://localhost/dai/public
        fetch(`http://localhost/dai/public/phps/login.php`, {
          method: "post",
          body: formData
        })
          .then(res => res.json())
          .then((res) => {
            if (res.result["mem_id"]) {
              let user = JSON.stringify(res.result);
              localStorage.setItem("user", user)
              // 獲得memId、存進vuex的memId
              let id = res.result["mem_id"]
              this.$store.commit("getId", id)
              this.$router.push(`/user`)
            }
          })
          .catch(function (error) {
            console.log(error);
          })
      }
    }
  },
  // beforeRouteEnter(to, from, next) {
  //   // 在進入路由前執行以下操作
  //   let isLogin = localStorage.getItem('user')
  //   if (!isLogin) {
  //     // 如果使用者已登入，可以進入路由
  //     // console.log(to.meta);
  //     next(`/login`);
  //   } 
  //   else {
  //     next(`/user`);
  //     // 如果使用者未登入，導向登入頁面
  //   }
  // },
  // beforeRouteEnter(to, from, next) {

  // console.log(to);

  // console.log(from);

  // let isLogin = localStorage.getItem('user')

  // if (isLogin) {
  //   // this.$router.push(`/user/${isLogin}`)
  //   // return '/user'
  //   next(this.$router.push(`/user/${isLogin}`));
  //   // console.log(isLogin);
  // } else {
  //   // return '/login'
  //   next()
  // }
  // ...
  // console.log(to);
  // console.log(from);
  // if (to.meta.isAuth && to.name !== 'login') {
  //   let isLogin = localStorage.getItem('user')
  //   if (isLogin) {
  //     this.$router.push(`/user/${this.$store.state.memId}`)
  //   }
  // }
  //   // next()
  //   // return true
  //   
  // } else {
  //   return '/login'
  // } else {
  // return true
  // },

  mounted() {
    let isLogin = localStorage.getItem('user')
    if (isLogin) {
      this.$router.push(`/user`)
    } else {
      return '/login'
    }

    // const name = "user" + "=";
    // const decodedCookie = decodeURIComponent(document.cookie);
    // const cookieArray = decodedCookie.split(';');

    // for (let i = 0; i < cookieArray.length; i++) {
    //   let cookie = cookieArray[i];
    //   while (cookie.charAt(0) === ' ') {
    //     cookie = cookie.substring(1);
    //   }
    //   if (cookie.indexOf(name) === 0) {
    //     console.log(cookie.substring(name.length, cookie.length));
    //     if (cookie.substring(name.length, cookie.length)) {
    //       // 有cookie的話路由依據該會員的memId進入頁面、memId是從vuex抓過來
    //       this.$router.push(`/user/${this.$store.state.memId}`);
    //     }
    //   }
    // }
    // return "";
  },
};
</script>

<style lang="scss">
@import "../assets/scss/page/_Login.scss";
</style>
