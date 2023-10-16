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
                    <input type="date" id="bir" v-model="formData.bir" required="true" />
                </div>
                <div class="registerTel">
                    <label for="tel">電話</label>
                    <input type="text" id="tel" v-model="formData.tel" required="true" placeholder="請輸入10碼手機號碼" />
                </div>
                <div class="registerEmail">
                    <label for="email">信箱</label>
                    <input type="email" id="email" v-model="formData.email" required="true" ref="emailInput" />
                </div>
                <div class="registerPwd">
                    <label for="pwd">密碼</label>
                    <input :type="typeChange" id="pwd" v-model="formData.pwd" placeholder="請輸入最少6碼，並包含字母及數字" />
                    <div class="eyeOpen" @click="open" v-show="openEye">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div class="eyeOpen" @click="close" v-show="closeEye">
                        <i class="fa-solid fa-eye-slash"></i>
                    </div>
                </div>
                <!-- <div class="registerCheck">
          <label for="check">再次輸入</label>
          <input type="password" id="check" required="true" />
        </div> -->
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
            //正則判斷
            isValidName: "",
            isValidEmail: "",
            isValidPassword: "",
            isValidPhone: "",
            openPwd: false,
            openEye: true,
            closeEye: false

        };
    },
    computed: {
        typeChange() {
            return this.openPwd == false ? 'password' : 'text'
        },
    },
    methods: {
        open() {
            this.openPwd = true
            this.openEye = !this.openEye
            this.closeEye = !this.closeEye
        },
        close() {
            this.openPwd = false
            this.openEye = !this.openEye
            this.closeEye = !this.closeEye
        },
        validateName() {
            // 正则表达式示例：只包含字母和空格的姓名
            var regex = /^[A-Za-z\s]+$/;
            this.isValidName = regex.test(this.formData.name);
        },
        validatePhone() {
            // 正则表达式示例：09开头的10位数字
            var regex = /^09\d{8}$/;
            this.isValidPhone = regex.test(this.formData.tel);
        },
        validateEmail() {
            // 正则表达式示例：验证电子邮件地址
            var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            this.isValidEmail = regex.test(this.formData.email);
        },
        validatePassword() {
            // 正则表达式示例：密码包含字母、数字和特殊字符
            var regex = /^(?=.*[a-zA-Z]).{6,8}$/;
            this.isValidPassword = regex.test(this.formData.pwd);
        },
        addToDb() {
            // this.validateName();
            this.validateEmail();
            this.validatePassword();
            this.validatePhone();
            if (this.isValidEmail && this.isValidPassword && this.isValidPhone) {

                // 創建一個新的 FormData 對象
                let formData = new FormData();
                // 將表單數據添加到 FormData 對象中
                formData.append("name", this.formData.name);
                formData.append("bir", this.formData.bir);
                formData.append("tel", this.formData.tel);
                formData.append("email", this.formData.email);
                formData.append("pwd", this.formData.pwd);

                // this.$apiUrl('register.php')
                fetch(this.$apiUrl('register.php'), {
                    method: "post",
                    body: formData
                })
                    .then(res => res.json())
                    .then((res) => {
                        console.log(res);
                        if (res.emailExists) {
                            alert(res.msg)
                            this.$refs.emailInput.focus();
                        }
                        else if (!res.error) {
                            alert(res.msg);
                            this.$router.push("/home")
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    },
};
</script>

<style lang="scss">
@import "../assets/scss/page/_Register";
</style>
