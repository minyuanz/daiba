<template>
    <div class="accchange">
        <h1>更改基本資料</h1>
        <div class="changebox">
            <div class="accPic">
                <img src="https://steam.oxxostudio.tw/webp/gimp/example/simple-keyer-mask-16.webp" />
            </div>
            <button class="btn_s">上傳圖片</button>
            <div class="changeName">
                <label for="">名稱：</label>
                <input type="text" v-model="changeName">
            </div>
            <div class="changeBir">
                <label for="">生日：</label>
                <input type="date" v-model="changeBir">
            </div>
            <div class="changeSex">
                <label for="sex">性別：</label>
                <select name="" id="sex" v-model="changeSex">
                    <option value="男" >男</option>
                    <option value="女" >女</option>
                </select>
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
            toggle: '',
            changeName:'',
            changeBir:'',
            changeSex:'男'
        }
    },
    methods: {
        menu() {
            this.$emit('toggle-change')
            // document.getElementById('AccChange').style.display = 'none'
            // document.querySelector('.userInfo').style.display = 'block'
        }
    }
}
</script>

<style lang="scss">
.accchange {
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
        // border: 1px solid red;
        // margin-top: 50px;
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 180px repeat(6, 1fr);
        justify-items: center;
        align-items: center;
        gap: 40px;

        .accPic {
            // border: 1px solid red;
            width: 180px;
            height: 180px;
            margin: auto;
            // margin-top: 10px;

            img {
                width: 100%;
                height: 100%;
                border-radius: 100px;
                vertical-align: top;
                border: 8px solid black;
            }

            button {
                // text-align: center;
                margin-top: 10px;
            }
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

        .changeName {
            // border: 1px solid red;
            width: 50%;

        }

        .changeBir {
            width: 50%;
        }

        .changeSex {
            width: 50%;
        }
    }
}

@media screen and (max-width:414px) {
    .accchange {
        // width: 100%;
        .changebox {
            .accPic {
                // width: 80%;

                label {
                    width: 20%;
                }

                span {
                    width: 80%;
                }
            }

            .changeName {
                // border: 1px solid red;
                width: 80%;
            }

            .changeBir {
                width: 80%;
            }

            .changeSex {
                width: 80%;
            }
        }
    }
}
</style>