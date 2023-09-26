<template>
    <div class="backFeature" v-if="addToggle">
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
            <button @click="addToggle = !addToggle">新增推薦</button>
        </div>
    </div>
    <div class="backFeaAdd" v-else>
        <div class="feaHead">
            <div class="mainTitle">
                <label for="">文章標題</label>
                <input type="text">
            </div>
            <div class="mainPic">
                <label for="">版頭圖片</label>
                <div class="pic">
                    <p>＋</p>
                    <input type="file" @change="FileChange">
                    <img :src="imageURL" alt="" v-show="fix">
                </div>
            </div>
            <div class="secTitle">
                <label for="">文章副標</label>
                <input type="text">
            </div>
            <div class="selectTAg">
                <label for="">捷運站：</label>
                <select name="" id="">
                    <option value="BL01">BL01</option>
                </select>
                <label for="">推薦分類：</label>
                <select name="" id="">
                    <option value="food">food</option>
                </select>
            </div>
        </div>
        <div class="backFeaInfo">
            <div class="uploadPic" v-for="(pic, index) in pics" :key="index">
                <label for="">{{ pic.title }}</label>
                <div class="pic">
                    <p>＋</p>
                    <input type="file" @change="handleFileChange($event, index)">
                    <img :src="pic.imageURL" v-show="pic.fix">
                </div>
                <input type="text">
            </div>
        </div>
        <div class="backFeaCtx">
            <label for="">詳細資訊</label>
            <input type="text">
        </div>
        <div class="btn">
            <button @click="addToggle = !addToggle">取消新增</button>
            <button @click="addToggle = !addToggle">確認新增</button>
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
            },],
            addToggle: true,
            pics: [{
                title: '圖片一',
                imageURL: null,
                fix: false
            }, {
                title: '圖片二',
                imageURL: null,
                fix: false
            }, {
                title: '圖片三',
                imageURL: null,
                fix: false
            },],
            imageURL: null,
            fix:false
        }
    },
    methods: {
        handleFileChange(e, index) {
            const files = e.target.files; // 獲取所有所選文件

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = () => {
                    // 當讀取完成時觸發
                    this.pics[index].imageURL = reader.result; // 將 Data URL 賦值給圖片的 src
                };
                // this.pics[index].imageURL = true;
                // 
                if (file) {
                    reader.readAsDataURL(file); // 讀取文件內容，以 Data URL 形式
                }
            }
            this.pics[index].fix = true

        },
        FileChange(e) {
            const file = e.target.files[0]; // 獲取所有所選文件
            const reader = new FileReader();

            console.log(file);
            console.log(reader);

            reader.onload = () => {
                // 當讀取完成時觸發
                this.imageURL = reader.result; // 將 Data URL 賦值給圖片的 src
            };

            if (file) {
                reader.readAsDataURL(file); // 讀取文件內容，以 Data URL 形式
            }
            this.fix = true

        },

    }
}
</script>

<style lang="scss">
.backFeature {
    margin-top: 3rem;
    border: 1px solid #aaa;
    background-color: #fff;
    width: 900px;
    padding: 50px;

    .feaSearch {
        // border: 1px solid red;
        margin: 10px 0;
        display: flex;
        align-items: center;

        select {
            height: 30px;
            margin-right: 30px;
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

.backFeaAdd {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
    width: 900px;
    height: 900px;
    padding: 50px;
    overflow: auto;

    .feaHead {

        // border: 1px solid red;
        .mainTitle {
            text-align: center;
            display: flex;
            flex-direction: column;

            label {
                font-size: 24px;
                font-weight: bold;
            }

            input {
                margin-top: 30px;
                padding: 5px 0;
                border: 1px solid #aaa;
            }
        }

        .mainPic {
            // border: 1px solid red;
            text-align: center;
            display: flex;
            flex-direction: column;
            margin-top: 30px;

            label {
                font-size: 24px;
                font-weight: bold;
            }

            .pic {
                border: 1px solid #aaa;
                margin-top: 30px;
                position: relative;

                p {
                    font-size: 24px;
                    line-height: 200px;
                }

                input {
                    border: 1px solid red;
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    opacity: 0;
                    z-index: 9;
                }

                img {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                }
            }
        }

        .secTitle {
            // border: 1px solid red;
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            text-align: center;

            label {
                font-size: 24px;
                font-weight: bold;
            }

            input {
                border: 1px solid #aaa;
                margin-top: 30px;
                padding: 5px 0;
            }
        }

        .selectTAg {
            // border: 1px solid red;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin-top: 30px;

            label {
                // width: 15%;
            }

            select {
                width: 200px;
            }
        }
    }

    .backFeaInfo {
        margin-top: 50px;
        padding-top: 30px;
        border-top: 1px dashed #aaa;

        .uploadPic {
            // border: 1px solid red; text-align: center;
            text-align: center;
            display: flex;
            flex-direction: column;
            margin-top: 50px;

            label {
                font-size: 24px;
                font-weight: bold;
            }

            .pic {
                border: 1px dashed #aaa;
                margin-top: 30px;
                position: relative;

                p {
                    // font-size: 24px;
                    line-height: 200px;
                }

                input {
                    border: 1px solid red;
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    opacity: 0;
                    z-index: 9;
                }

                img {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                }
            }

            input {
                margin-top: 30px;
                height: 200px;
            }
        }
    }

    .backFeaCtx {
        display: flex;
        flex-direction: column;
        text-align: center;
        margin-top: 50px;

        label {
            font-size: 24px;
            font-weight: bold;
        }

        input {
            height: 200px;
            margin-top: 30px;
            border: 1px solid #aaa;
        }
    }

    .btn {
        // border: 1px solid red;
        margin-top: 30px;
        text-align: right;

        button {
            margin-left: 20px;
            padding: 10px 20px;
        }
    }
}
</style>