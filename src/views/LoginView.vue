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
          <input :type="typeChange" id="pwd" name="pwd" v-model="memPwd" />
          <div class="eyeOpen" @click="open" v-show="openEye">
            <i class="fa-solid fa-eye"></i>
          </div>
          <div class="eyeOpen" @click="close" v-show="closeEye">
            <i class="fa-solid fa-eye-slash"></i>
          </div>
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
      new: "",
      openPwd: false,
      openEye: true,
      closeEye: false
      // closeEye: false
    };
  },
  computed: {
    typeChange() {
      return this.openPwd == false ? 'password' : 'text'
    },
  },
  methods: {
    open() {
      console.log(11);
      this.openPwd = true
      this.openEye = !this.openEye
      this.closeEye = !this.closeEye
    },
    close() {
      this.openPwd = false
      this.openEye = !this.openEye
      this.closeEye = !this.closeEye
    },
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
        // this.$apiUrl('login.php')
        fetch(this.$apiUrl('login.php'), {
          method: "post",
          body: formData
        })
          .then(res => res.json())
          .then((res) => {
            if (res.result && res.result.mem_id) {
              let user = JSON.stringify(res.result);
              localStorage.setItem("user", user);
              let id = res.result.mem_id;
              this.$store.commit("getId", id);
              this.$router.push(`/user`);
            } else {
              alert("帳號或密碼有誤");
            }
          })
          .catch(function (error) {
            console.log(error);
          })
      }
    }
  },

  mounted() {
    let isLogin = localStorage.getItem('user')
    if (isLogin) {
      this.$router.push(`/user`)
    } else {
      return '/login'
    }
  },
};
</script>

<style lang="scss">
@import "../assets/scss/page/_Login.scss";
</style>
