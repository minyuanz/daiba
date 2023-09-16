<template>
    <div class="mailchange">
        <h1>更改信箱</h1>
        <div class="changebox">
            <div class="mail">
                <label for="">信箱</label>
                <!-- <input type="text"> -->
                <span>0912-345-678</span>
            </div>
            <div class="changeMail">
                <label for="">新信箱</label>
                <input type="text" v-model="changemail">
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
            changemail: '',
        }
    },
    methods: {
        menu() {
            this.$emit('toggle-change')
            // console.log(11)
            // document.getElementById('MailChange').style.display = 'none'
            // document.querySelector('.userInfo').style.display = 'block'
        }
    }
}
</script>

<style lang="scss">
.mailchange {
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
        grid-template-rows: repeat(6, 1fr);
        justify-items: center;
        gap: 40px;

        .mail {
            // border: 1px solid red;
            width: 50%;

            label {
                // border: 1px solid red;
                display: inline-block;
                width: 20%;
            }

            span {
                // border: 1px solid red;
                display: inline-block;
                width: 80%;
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

        .changeMail {
            // border: 1px solid red;
            width: 50%;
        }

    }
}

@media screen and (max-width:414px) {
    .mailchange {
        .changebox {
            .mail {
                width: 80%;

                label {
                    width: 30%;
                }

                span {
                    width: 70%;
                }
            }

            .changeMail {
                width: 80%;
            }
        }
    }
}
</style>