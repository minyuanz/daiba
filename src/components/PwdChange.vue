<template>
    <div class="pwdchange">
        <h1>更改帳號/密碼</h1>
        <div class="changebox">
            <div class="acc">
                <label for="">帳號</label>
                <!-- <input type="text"> -->
                <span>name</span>
            </div>
            <div class="changeAcc">
                <label for="">帳號更改</label>
                <input type="text" v-model="changeAcc">
            </div>
            <button class="btn_l">確認更改</button>
            <div class="pwd">
                <label for="">原密碼</label>
                <input type="password" v-model="pwd">
            </div>
            <div class="changePwd">
                <label for="">新密碼</label>
                <input type="password" v-model="changePwd">
            </div>
            <div class="checkPwd">
                <label for="">再次輸入</label>
                <input type="password" v-model="checkPwd">
            </div>
            <button class="btn_l">確認更改</button>
            <button class="btn_s" @click="menu">返回</button>
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
            checkPwd: ''
        }
    },
    methods: {
        menu() {
            this.$emit('toggle-change')
            // console.log(11)
            // document.getElementById('PwdChange').style.display = 'none'
            // document.querySelector('.userInfo').style.display = 'block'
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
        margin-top: 50px;
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: repeat(8, 1fr);
        justify-items: center;
        gap: 40px;

        .acc {
            // border: 1px solid red;
            width: 50%;

            label {
                // border: 1px solid red;
                display: inline-block;
                width: 10%;
            }

            span {
                // border: 1px solid red;
                display: inline-block;
                width: 90%;
                text-align: center;
            }

            // text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            border: transparent;
            border-bottom: 1px solid #aaa;
        }

        .changeAcc {
            // border: 1px solid red;
            width: 50%;
        }

        .pwd {
            width: 50%;
        }

        .changePwd {
            width: 50%;
        }

        .checkPwd {
            width: 50%;

        }

    }
}

@media screen and (max-width:414px) {
    .pwdchange {
        .changebox {
            .acc {
                width: 80%;

                label {
                    width: 20%;
                }

                span {
                    width: 80%;
                }
            }

            .changeAcc {
                // border: 1px solid red;
                width: 80%;
            }

            .pwd {
                width: 80%;
            }

            .changePwd {
                width: 80%;
            }

            .checkPwd {
                width: 80%;

            }
        }
    }
}</style>