<template>
    <div class="pwdchange">
        <h1>更改帳號/密碼</h1>
        <div class="changebox">
            <div class="acc">
                <label for="">帳號</label>
                <!-- <input type="text"> -->
                <span>{{ this.$store.state.memInfo.mem_name }}</span>
            </div>
            <div class="changeAcc">
                <label for="">帳號更改</label>
                <input type="text" v-model="changeAcc">
            </div>
            <button class="btn_l" @click="updateName">確認更改</button>
            <div class="pwd">
                <label for="">原密碼</label>
                <input type="password" v-model="pwd">
            </div>
            <div class="changePwd">
                <label for="">新密碼</label>
                <input type="password" v-model="changePwd">
            </div>
            <!-- <div class="checkPwd">
                <label for="">再次輸入</label>
                <input type="password" v-model="checkPwd">
            </div> -->
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
            changeAcc: '',
            pwd: '',
            changePwd: '',
            checkPwd: '',
            member: this.$store.state.memInfo
        }
    },
    methods: {
        menu() {
            this.$emit('toggle-change')
        },
        updateName() {
            if (this.changeAcc == '') {
                alert('請輸入新帳號')
            } else {
                // 建立數據資料夾好發給PHP做處理新增
                const formData = new FormData();
                formData.append("mem_name", this.changeAcc);
                formData.append("mem_id", this.member.mem_id);
                fetch('http://localhost/dai/public/phps/UpdateMemberName.php', {
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
        },
        updatePwd() {

            if (this.pwd !== this.changePwd) {
                alert("請輸入相同的密碼")
            } else {
                // 建立數據資料夾好發給PHP做處理新增
                const formData = new FormData();
                // formData.append("chcek_pwd", this.changePwd);
                formData.append("mem_pwd", this.pwd);
                formData.append("mem_id", this.member.mem_id);

                fetch('http://localhost/dai/public/phps/UpdateMemberPwd.php', {
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

        .acc {
            width: 100%;

            span {
                display: block;
                text-align: center;
                // border: 1px solid red;
                font-size: map-get($map , small);
                // margin-bottom: 10px;
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