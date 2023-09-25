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
            <div class="acurrance">
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
            toggle: '',
            changeName:'',
            changeBir:'',
            changeSex:'男'
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

    .changebox >*{
        display: block;
        inset: 0;
        margin: 3rem auto;
    }
        .acurrance{
            button{
                display: block;
                margin: 2rem auto;
            }
        }
        .accPic {
            // border: 1px solid red;
            width: 180px;
            height: 180px;
            margin: auto;
            margin-top: 2rem;

            img {
                width: 100%;
                height: 100%;
                border-radius: 100px;
                vertical-align: top;
                border: 8px solid black;
            }
        }

        label {
            width: 400px;
            display: block;
            inset: 0;
            margin: auto;
            margin-bottom: 10px;
            font-size: map-get($map,small);
        }

        input {
            width: 400px;
            display: block;
            border: transparent;
            inset: 0;
            margin: auto;
            border-bottom: 1px solid #aaa;
            font-size: map-get($map,small);
        }
        select{
            display: block;
            margin-left: 2rem;
            font-size: map-get($map,small);
        }

        .changeName {
            width: 50%;

        }

        .changeBir {
            width: 50%;
        }

        .changeSex {
            // display: flex;
            width: 50%;
        }
}

@media screen and (max-width:414px) {
    .accchange {
        width: 100%;
        .changebox {
            width: 100%;
            button{
                width: 80%;
            }
            .accPic {
                width: 150px;
                height: 150px;
                img{
                    width: 150px;
                    height: 150px;
                }

                span {
                    width: 80%;
                }
            }

            .changeName {
                // border: 1px solid red;
                width: 80%;
                label,input{
                    width: 100%;
                }
            }

            .changeBir {
                width: 80%;
                label,input{
                    width: 100%;
                }
            }

            .changeSex {
                width: 80%;
                // margin: 0;
                display: flex;
                label,select{ 
                    margin: 0;
                    display: inline-block;
                    width: 25%;
                }
            }
        }
    }
}
</style>