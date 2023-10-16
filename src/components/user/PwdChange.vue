<template>
    <div class="pwdchange">
        <h1>更改密碼</h1>
        <div class="changebox">
            <!-- <div class="acc">
                <label for="">名稱</label>
                <span>{{ this.$store.state.memInfo.mem_name }}</span>
            </div>
            <div class="changeAcc">
                <label for="">名稱更改</label>
                <input type="text" v-model="changeAcc">
            </div>
            <button class="btn_l" @click="updateName">確認更改</button> -->
            <!-- <div class="pwd">
                <label for="">原密碼</label>
                <input type="password" v-model="pwd">
            </div> -->
            <div class="changePwd">
                <label for="">新密碼</label>
                <input :type="typeChange" v-model="changePwd">
                <div class="eyeOpen" @click="open" v-show="openEye">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div class="eyeOpen" @click="close" v-show="closeEye">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
            </div>
            <div class="checkPwd">
                <label for="">再次確認</label>
                <input :type="typeChange" v-model="checkPwd">
                <div class="eyeOpen" @click="open" v-show="openEye">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div class="eyeOpen" @click="close" v-show="closeEye">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
            </div>
            <div class="accurance">
                <button class="btn_l" @click="updatePwd">確認更改</button>
                <button class="btn_l btn_undo" @click="menu">返回</button>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pwd: '',
            changeAcc: '',
            changePwd: '',
            checkPwd: '',
            member: this.$store.state.memInfo,
            openPwd: false,
            openEye: true,
            closeEye: false
        }
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
        menu() {
            this.$emit('toggle-change')
        },
        updatePwd() {

            if (this.changePwd !== this.checkPwd) {
                alert("請輸入相同的密碼")
            } else {
                // 建立數據資料夾好發給PHP做處理新增
                const formData = new FormData();
                // formData.append("chcek_pwd", this.changePwd);
                formData.append("mem_pwd", this.changePwd);
                formData.append("mem_id", this.member.mem_id);

                // this.$apiUrl('UpdateMemberPwd.php')
                fetch(this.$apiUrl('UpdateMemberPwd.php'), {
                    method: 'post',
                    body: formData
                })
                    .then(res => res.json())
                    .then((res) => {
                        if (!res.error) {
                            alert(res.msg);
                            this.menu()
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
            location.reload();
        }
    }
}
</script>

<style lang="scss">
.pwdchange {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
    width: 900px;
    // margin-left: 10px;
    // display: none;

    h1 {
        text-align: center;
        margin-top: 50px;
    }

    .changebox {
        width: 400px;
        inset: 0;
        margin: 5rem auto;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        gap: 2rem;

        .changePwd,
        .checkPwd {
            position: relative;

            .eyeOpen {
                // border: 1px solid red;
                position: absolute;
                right: 1rem;
                top: 2rem;
                cursor: pointer;
                // font-size: 24px;
            }
        }

        label {
            width: 400px;
            display: block;
            font-size: map-get($map , small);
            margin-bottom: 10px;
        }

        input {
            width: 400px;
            display: block;
            font-size: map-get($map , small);
            border: transparent;
            border-bottom: 1px solid #aaa;
        }

        .accurance>* {
            margin: .5rem 0;
        }

    }
}

@media screen and (max-width:414px) {
    .pwdchange {
        width: 100%;

        .changebox {
            width: 100%;

            .acc {
                width: 80%;

            }
        }

        .changebox>* {
            width: 80%;

            input,
            label {
                width: 100%;
            }
        }
    }
}
</style>