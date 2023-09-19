<template>
    <div class="userInfo" id="userInfo" v-if="'會員資料' == toggle">

        <h1>會員資料</h1>
        <div class="userBtn">
            <button class="ChangAC" @click="To">
                <i class="fa-solid fa-face-laugh"></i>
                更改基本資料
            </button>
            <button class="ChangAC" @click="To">
                <i class="fa-solid fa-lock"></i>
                更改帳號/密碼
            </button>
            <button class="ChangAC" @click="To">
                <i class="fa-solid fa-phone"></i>
                更改手機號碼
            </button>
            <button class="ChangAC" @click="To">
                <i class="fa-solid fa-envelope"></i>
                更改信箱
            </button>
        </div>
    </div>
    <!-- 更改基本資料 -->
    <AccChange id="AccChange" v-else-if="'更改基本資料' == toggle" @toggle-change="toggleUpdate" />
    <!-- 更改帳號/密碼 -->
    <PwdChange id="PwdChange" v-else-if="'更改帳號/密碼' == toggle" @toggle-change="toggleUpdate" />
    <!-- 更改手機號碼 -->
    <PhoneChange id="PhoneChange" v-else-if="'更改手機號碼' == toggle" @toggle-change="toggleUpdate" />
    <!-- 更改信箱 -->
    <MailChange id="MailChange" v-else-if="'更改信箱' == toggle" @toggle-change="toggleUpdate" />
</template>

<script>
import AccChange from '@/components/user/AccChange.vue'
import PwdChange from '@/components/user/PwdChange.vue'
import PhoneChange from '@/components/user/PhoneChange.vue'
import MailChange from '@/components/user/MailChange.vue'
export default {
    components: {
        AccChange,
        PwdChange,
        PhoneChange,
        MailChange
    },
    data() {
        return {
            username: '',
            userbir: '',
            usersex: '男',
            toggle: '會員資料'
        }
    },
    methods: {
        toggleUpdate() {
            this.toggle = '會員資料'
        },
        To(e) {
            console.log(e.target.innerText)
            this.toggle = e.target.innerText
        },

    },
}
</script>

<style lang="scss">
.userInfo {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
    width: 900px;
    // margin-left: 10px;
    // display: none;

    h1 {
        text-align: center;
        margin-top: 100px;
    }

    .userBtn {
        // border: 1px solid red;
        margin-top: 100px;
        // width: 500px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        padding: 0 100px;

        // text-align: center;
        button {
            height: 100px;
            margin: 50px;
            // background-color: #fff;
        }
    }
}

@media screen and (max-width:414px) {
    .userInfo {
        border: none;
        margin: 0;

        h1 {
            margin: 25px 0;
        }

        .userBtn {
            // display: block;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
            // text-align: center;

            button {
                margin: 10px 0;
            }


        }
    }

}
</style>