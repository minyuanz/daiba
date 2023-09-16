<template>
    <div class="phonechange">
        <h1>更改手機號碼</h1>
        <div class="changebox">
            <div class="phone">
                <label for="">手機號碼</label>
                <!-- <input type="text"> -->
                <span>0912-345-678</span>
            </div>
            <div class="changePhone">
                <label for="">新手機號碼</label>
                <input type="text" v-model="changePhone">
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
            changePhone: '',
        }
    },
    methods: {
        menu() {
            this.$emit('toggle-change')
            // console.log(11)
            // document.getElementById('PhoneChange').style.display = 'none'
            // document.querySelector('.userInfo').style.display = 'block'
        }
    }
}
</script>

<style lang="scss">
.phonechange {
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

        .phone {
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

        .changePhone {
            // border: 1px solid red;
            width: 50%;
        }

    }
}

@media screen and (max-width:414px) {
    .phonechange {
        .changebox {
            .phone {
                width: 80%;

                label {
                    width: 30%;
                }

                span {
                    width: 70%;
                }
            }

            .changePhone {
                width: 80%;
            }
        }
    }
}
</style>