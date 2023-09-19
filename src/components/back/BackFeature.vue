<template>
    <div class="backFeature">
        <div class="feaSearch">
            <label for="">請選擇捷運線：</label>
            <select name="" id="">
                <option :value="line.name" v-for="line in lines">{{ line.name }}</option>
            </select>
            <label for="">請選擇捷運站：</label>
            <select name="" id="">
                <option :value="sta.name" v-for="sta in stations">{{ sta.name }}</option>
            </select>
            <label for="">請選擇分類：</label>
            <select name="" id="">
                <option :value="fea.name" v-for="fea in features">{{ fea.name }}</option>
            </select>
        </div>
        <div class="feaTitle">
            <p>站名</p>
            <p>標題</p>
            <p>推薦分類</p>
            <p>更新時間</p>
            <p>編輯</p>
            <p>刪除</p>
        </div>
        <div class="feaInfo" v-for="info in infos">
            <p>{{ info.staName }}</p>
            <p>{{ info.Title }}</p>
            <p>{{ info.Fea }}</p>
            <p>{{ info.Date }}</p>
            <div class="edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="del">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>
        <div class="addSta">
            <button>新增推薦</button>
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
            stations: [{
                name: 'BL01'
            }, {
                name: 'BL02'
            }, {
                name: 'BL03'
            },],
            features: [{
                name: '美食'
            },
            {
                name: '景點'
            }, {
                name: '住宿'
            }],
            infos: [{
                staName: '板橋',
                Title: '漢堡',
                Fea: '美食',
                Date: '2023-02-03'
            }, {
                staName: '板橋',
                Title: '漢堡',
                Fea: '美食',
                Date: '2023-02-03'
            }, {
                staName: '板橋',
                Title: '漢堡',
                Fea: '美食',
                Date: '2023-02-03'
            },]
        }
    }
}
</script>

<style lang="scss">
.backFeature {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
    width: 900px;
    padding: 50px;

    .feaSearch {
        // border: 1px solid red;
        margin: 10px 0;
        display: flex;
        align-items: center;

        select {
            height: 30px;
            margin-right:30px;
            width: 100px;
            text-align: center;
        }


    }

    .feaTitle {
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

    .feaInfo {
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