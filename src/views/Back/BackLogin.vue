<template>
    <div class="BackloginWrap">
        <div class="BackloginPic">
            <img src="../../../public/img/login.png" />
        </div>
        <div class="BackloginText">
            <h1>管理員登入</h1>
            <div class="Backloginacc">
                <label for="acc">帳號</label>
                <input type="text" id="acc" v-model="adminId" />
            </div>
            <div class="BackloginPwd">
                <label for="pwd">密碼</label>
                <input type="password" id="pwd" v-model="adminPwd" />
            </div>
            <button class="btn_l"  @click="loginAdmin">
                <!-- <router-link to="BackMember">登入</router-link> -->
                登入
            </button>
            <button class="btn_l">
                <router-link to="/">返回</router-link>
            </button>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            adminId:'',
            adminPwd:'',
        };
    },
    methods: {
        loginAdmin() {
        // 獲取輸入的管理員帳密
        const adminId = this.adminId;
        const adminPwd = this.adminPwd;

        // 創立一組傳去後台的數據(非form表單)
        const data = new FormData();
        data.append('adminId', adminId);
        data.append('adminPwd', adminPwd);
        fetch('http://localhost/dai/public/phps/BackLogin.php', {
        method: 'POST',
        body: data,
      })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                //登入成功後移動到這個頁面
                this.$router.push('/Back/BackMember');
                // 儲存用戶訊息到 Vuex
                this.$store.commit('setLoggedInUser', adminId);
                // 儲存用戶訊息到 localStorage
                this.setBackloginaccLocalStorage(adminId, adminPwd);
            } else {
                if (result.msg === '此帳號已經停權') {
                // 如果用戶遭停權
                alert('您的帳號已經停權，請聯絡管理員');
                } else {
                // 登入失敗
                alert('登入失敗，請檢察帳號密碼');
                }
            }
        })
        .catch(error => {
            console.error('登入錯誤：', error);
        });
        },
        setBackloginaccLocalStorage(acc,pwd){
            localStorage.setItem('BackloginContent', JSON.stringify({ acc, pwd }));
        },
        getBackloginaccLocalStorage(){
            // 从 localStorage 中獲取用戶訊息
            const BackloginContent = JSON.parse(localStorage.getItem('BackloginContent'));
            if (BackloginContent) {
            this.adminId = BackloginContent.acc;
            this.adminPwd = BackloginContent.pwd;
            }
        },
    },
};
</script>
  
<style lang="scss">
@import "@/assets/scss/page/BackLogin";
</style>
  