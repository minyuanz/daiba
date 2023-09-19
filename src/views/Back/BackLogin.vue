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
            <button class="btn_l">
                <router-link to="BackMember">登入</router-link>
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
    },
};
</script>
  
<style lang="scss">
@import "@/assets/scss/page/BackLogin";
</style>
  