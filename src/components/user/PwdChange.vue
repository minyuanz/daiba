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
            <div class="accurance">
                <button class="btn_l">確認更改</button>
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
            checkPwd: ''
        }
    },
    methods: {
        menu() {
            this.$emit('toggle-change')
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