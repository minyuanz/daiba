<template>
  <div class="registerWrap">
    <div class="registerPic">
      <img src="../../public/img/register.png" />
    </div>
    <div class="registerText">
      <h1>會員註冊</h1>
      <form action="" class="regForm" method="post">
        <div class="registerName">
          <label for="name">姓名</label>
          <input type="text" id="name" v-model="formData.name" required="true" />
        </div>
        <div class="registerGender">
          <label for="gender">性別</label>
          <select v-model="formData.gender">
            <option value="男">男</option>
            <option value="女">女</option>
          </select>
        </div>
        <div class="registerBir">
          <label for="bir">生日</label>
          <input type="date" id="bir" v-model="formData.bir" />
        </div>
        <div class="registerTel">
          <label for="tel">電話</label>
          <input type="text" id="tel" v-model="formData.tel" />
        </div>
        <div class="registerEmail">
          <label for="email">信箱</label>
          <input type="email" id="email" v-model="formData.email" />
        </div>
        <div class="registerPwd">
          <label for="pwd">密碼</label>
          <input type="password" id="pwd" v-model="formData.pwd" />
        </div>
        <div class="registerCheck">
          <label for="check">再次輸入</label>
          <input type="password" id="check" />
        </div>
        <button class="btn_l" type="button" @click="addToDb">註冊</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        name: "",
        gender: "",
        bir: "",
        tel: "",
        email: "",
        pwd: ""
      },
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
    addToDb() {
      // 創建一個新的 FormData 對象
      let formData = new FormData();

      // 將表單數據添加到 FormData 對象中
      formData.append("name", this.formData.name);
      // formData.append("gender", this.formData.gender);
      formData.append("bir", this.formData.bir);
      formData.append("tel", this.formData.tel);
      formData.append("email", this.formData.email);
      formData.append("pwd", this.formData.pwd);

      fetch(`http://localhost/dai/public/phps/register.php`, {
        method: "post",
        // headers: {
        //   'content-type': 'multipart/form-data'
        // },
        body: formData
      })
        .then(res => res.json())
        .then((res) => {
          console.log(res);
          if (!res.error) {
            alert('註冊成功');
            // clearForm();
          }
        })
        .catch(function (error) {
          console.log(error);
        })
    }
  },
};
</script>

<style lang="scss">
@import "../assets/scss/page/_Register";
</style>
