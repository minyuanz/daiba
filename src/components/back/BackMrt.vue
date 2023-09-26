<template>
    <div class="backMrt" v-if="addToggle">
        <div class="mrtSearch">
            <label for="">請選擇捷運線：</label>
            <select name="" id="">
                <option :value="line.name" v-for="line in lines">{{ line.name }}</option>
            </select>
            <button class="btnsearch">查詢</button>
        </div>
        <div class="mrtTitle">
            <p>捷運站編號</p>
            <p>捷運站代碼1</p>
            <p>捷運站代碼2</p>
            <p>站名</p>
            <p>編輯</p>
            <p>刪除</p>
        </div>
        <div class="mrtInfo" v-for="info in sta" >
            <p>{{ info.sta_id }}</p>
            <p>{{ info.mrt_code1 }}</p>
            <p>{{ info.mrt_code2 }}</p>
            <p>{{ info.sta_name }}</p>
            <div class="edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="del">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>
        <div class="addSta">
            <button @click="addToggle = !addToggle">新增捷運站</button>
        </div>
    </div>
    <div class="backMrtAdd" v-else>
        <p>你正在新增車站：</p>
        <div class="addInfo">
            <div class="pic">
                <img src="https://picsum.photos/200/200/?random=10">
                <button>上傳圖片</button>
            </div>
            <div class="txt">
                <div>
                    <label for="">位於捷運線：</label>
                    <select name="" id="">
                        <option value="BL">BL</option>
                    </select>
                </div>
                <div>
                    <label for="">捷運站編號：</label>
                    <input type="text" value="BL11">
                </div>
                <div>
                    <label for="">位於捷運線：</label>
                    <select name="" id="">
                        <option value="noline">若無轉乘線則免填</option>
                    </select>
                </div>
                <div>
                    <label for="">捷運站編號：</label>
                    <input type="text" value="" placeholder="若無轉乘線則免填">
                </div>
                <div>
                    <label for="">捷運站名稱：</label>
                    <input type="text" value="西門">
                </div>
            </div>
        </div>
        <div class="addCtx">
            <span>捷運站描述</span>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sequi asperiores hic aspernatur excepturi adipisci repudiandae molestias architecto ea, mollitia dolores doloribus suscipit, perspiciatis at nobis tempora numquam! Ipsam, voluptate.</p>
            <span class="count">0/100字</span>
        </div>
        <div class="btn">
            <button @click="addToggle = !addToggle">取消新增</button>
            <button @click="addToggle = !addToggle">確認新增</button>
        </div>
    </div>
</template>

<script>
import BackMrt from "@/testdata/BackMrt.json"
export default {
    data() {
        return {
            sta:BackMrt,
            lines: [{
                name: 'BL線',
            },
            {
                name: 'R線',
            },
            {
                name: 'O線',
            },
            {
                name: 'G線',
            }],
            addToggle:true
        }
    },
}
</script>

<style lang="scss">
.backMrt {
    margin-top: 3rem;
    border: 1px solid #aaa;
    background-color: #fff;
    width: 900px;
    padding: 50px;

    .mrtSearch {
        // border: 1px solid red;
        margin: 10px 0;
        display: flex;
        align-items: center;

        select {
            height: 30px;
        }

        .btnsearch {
            // border: 1px solid red;
            margin: 0 10px;
            padding: 0px 30px;
            height: 30px;
        }
    }

    .mrtTitle {
        // border: 1px solid red;
        display: flex;
        justify-content: space-evenly;
        background-color: #ddd;
        padding: 5px 0;

        p {
            // border: 1px solid red;
            width: 100%;
            text-align: center;
        }
    }

    .mrtInfo {
        // border: 1px solid red;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        padding: 5px 0;
        border-bottom: 1px solid #aaa;

        div,
        p {
            // border: 1px solid red;
            width: 100%;
            text-align: center;
        }
    }

    .addSta {
        margin-top: 50px;
        text-align: center;
        // border: 1px solid red;

        button {
            padding: 10px 30px;
        }
    }
}

.backMrtAdd {
    border: 1px solid #aaa;
    background-color: #fff;
    // border-radius: 20px;
    width: 900px;
    padding: 50px;
    margin-top: 3rem;

    .addInfo {
        // border: 1px solid red;
        display: flex;
        justify-content: space-evenly;
        margin-top: 30px;

        .pic {
            display: flex;
            flex-direction: column;
            align-items: center;
            // border: 1px solid red;

            img {
                border-radius: 50%;
                width: 100%;
                vertical-align: bottom;
            }

            button {
                margin-top: 30px;
                padding: 10px 20px;
            }
        }

        .txt {
            div {
                // border: 1px solid red;
                margin: 20px 0;
                display: flex;
                align-items: center;
                input{
                    width: 220px
                }
                select {
                    // border: 1px solid red;
                    width: 220px
                }
            }
        }
    }
    .addCtx{
        // border: 1px solid #333;
        margin-top: 30px;
        span{
            display: block;
            text-align: center;
            background-color: #ddd;
            border: 1px solid #333;
        }
        p{
            border: 1px solid #333;
            border-top:1px solid transparent;
            height: 200px;
        }
        .count{
            border: 1px solid transparent;
            background-color: #fff;
            text-align: right;
            color:#ddd;
        }
    }
    .btn{
        // border: 1px solid red;
        margin-top: 30px;
        text-align: right;
        button{
            margin-left:20px;
            padding: 10px 20px;
        }
    }
}
</style>