<template>
    <div class="backMrt">
        <div class="mrtSearch">
            <label for="">請選擇捷運線：</label>
            <select name="" id="">
                <option :value="line.name" v-for="line in lines">{{ line.name }}</option>
            </select>
            <button class="btnsearch">查詢</button>
        </div>
        <div class="mrtTitle">
            <p>行</p>
            <p>捷運站編號</p>
            <p>站名</p>
            <p>編輯</p>
            <p>刪除</p>
        </div>
        <div class="mrtInfo" v-for="info in infos">
            <p>{{ info.id }}</p>
            <p>{{ info.number }}</p>
            <p>{{ info.name }}</p>
            <div class="edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="del">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>
        <div class="addSta">
            <button>新增捷運站</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
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
            infos: [{
                id: '1',
                number: 'BL01',
                name: '頂埔',
            }, {
                id: '12',
                number: 'BL01',
                name: '頂埔',
            }, {
                id: '13',
                number: 'BL01',
                name: '頂埔',
            }, {
                id: '14',
                number: 'BL01',
                name: '頂埔',
            }, {
                id: '15',
                number: 'BL01',
                name: '頂埔',
            }, {
                id: '16',
                number: 'BL01',
                name: '頂埔',
            }, {
                id: '17',
                number: 'BL01',
                name: '頂埔',
            }, {
                id: '18',
                number: 'BL01',
                name: '頂埔',
            },]
        }
    },
}
</script>

<style lang="scss">
.backMrt {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
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
</style>