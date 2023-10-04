<template>
    <div class="BackNews" v-if="addToggle">
        <div class="NewsSearch">
            商品編號查詢:
            <input type="text">
            <button class="NewsSearchBtn">查詢</button>
        </div>
        <div class="NewsTitle">
            <p>編號</p>
            <p>類別</p>
            <p>消息標題</p>
            <p>發布日期</p>
            <p>編輯</p>
        </div>
        <div class="NewsInfro" v-for="news  in news " :key="news.news_id">
            <p>{{ news.news_id }}</p>
            <p>{{ news.news_tag2 }}</p>
            <p>{{ news.news_title }}</p>
            <p>{{ news.news_date }}</p>
            <div class="edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
        </div>
        <div class="addSta">
            <button @click="addToggle = !addToggle">新增消息</button>
        </div>
    </div>
    <form class="newsAdd" v-else>
        <div class="mainTitle">
            <label for="">消息標題</label>
            <input type="text" v-model="formData.title" id="news_title">
        </div>
        <div class="secTitle">
            <label for="">文章副標</label>
            <input type="text" v-model="formData.sectitle" id="news_bdes">
        </div>
        <div class="mainPic">
            <div class="uploadPic">
                <label for="">版頭圖片</label>
                <div class="pic">
                    <p>＋</p>
                    <input type="file" @change="FileChange" name="image">
                    <img :src="picURL" v-show="fix">
                </div>
            </div>
        </div>
        <div class="choose">
            <label for="">消息分類：</label>
            <select name="" id="" v-model="formData.tag">
                <option value="活動消息">活動消息</option>
                <option value="活動消息">最新消息</option>
            </select>
        </div>
        <div class="Ctx">
            <label for="">內文</label>
            <textarea class="custom-input" v-model="formData.content"></textarea>
            <!-- <input type="text"> -->
        </div>
        <div class="btn">
            <button @click="addToggle = !addToggle">取消新增</button>
            <button @click="addNews" type="button">確認新增</button>
        </div>
    </form>
</template>

<script>
import BackProTest from "@/testdata/BackProTest.json"
export default {
    data() {
        return {
            item: BackProTest,
            items: BackProTest.map((item) => ({ ...item, isChecked: false, })),
            addToggle: true,
            fix: false,
            formData: {
                title: "",
                sectitle: "",
                tag: "",
                imageURL: null,
                content: "",
            },
            picURL:"",
            news: []
        }
    },
    methods: {
        FileChange(e) {
            console.log(e.target.files[0].name);
            const file = e.target.files[0]; // 獲取所有所選文件
            const reader = new FileReader();
            let URL = "../../img/"
            let fileName = file.name

            console.log(file);
            console.log(reader);

            // this.formData.imageURL = `${URL}${fileName}`
            reader.onload = () => {
                // 當讀取完成時觸發
                this.picURL = reader.result; // 將 Data URL 賦值給圖片的 src
            };

            if (file) {
                reader.readAsDataURL(file); // 讀取文件內容，以 Data URL 形式
                this.formData.imageURL=file
            }
            this.fix = true

        },
        addNews() {

            // 建立數據資料夾好發給PHP做處理新增
            const formData = new FormData();
            formData.append("news_title", this.formData.title);
            formData.append("news_sectitle", this.formData.sectitle);
            formData.append("news_tag", this.formData.tag);
            formData.append("news_imageURL", this.formData.imageURL);
            formData.append("news_content", this.formData.content);

            fetch(`http://localhost/dai/public/phps/addNews.php`, {
                method: "post",
                body: formData
            })
                .then(res => res.json())
                .then((res) => {
                    if (!res.error) {
                        alert(res.msg)
                        this.addToggle = !this.addToggle;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        fetchData() {
            fetch(`http://localhost/dai/public/phps/getNews.php`)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    this.news = data; // 更新數據到news
                })
                .catch((error) => {
                    console.error('數據傳輸失敗：', error);
                });
        }
    },
    mounted() {
        this.fetchData()
    },
}
</script>

<style lang="scss">
.BackNews {
    margin-top: 3rem;
    border: 1px solid #aaa;
    background-color: #fff;
    width: 900px;
    height: 900px;
    padding: 50px;
    overflow: scroll;

    .NewsSearch {
        padding: 10px;

        .NewsSearchBtn {
            width: 80px;
            height: 28px;
            margin-left: 10px;
        }
    }

    .NewsTitle {
        display: flex;
        justify-content: space-evenly;
        background-color: #ddd;
        padding: 5px 0;

        p {
            width: 100%;
            text-align: center;
        }
    }

    .NewsInfro {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        padding: 5px 0;
        border-bottom: 1px solid #aaa;

        div,
        p {
            width: 100%;
            text-align: center;
        }

        .ios-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
            background-color: #ccc;
            border-radius: 15px;
        }

        .ios-switch input {
            display: none;
        }

        .ios-switch .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #565656;
            border-radius: 15px;
            transition: 0.4s;
        }

        .ios-switch input:checked+.slider {
            background-color: #4CAF50;
        }

        .ios-switch .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            border-radius: 50%;
            transition: 0.4s;
        }

        .ios-switch input:checked+.slider:before {
            transform: translateX(30px);
        }
    }

    .addSta {
        margin-top: 50px;
        text-align: center;

        button {
            padding: 10px 30px;
        }
    }
}

.newsAdd {
    border: 1px solid #aaa;
    background-color: #fff;
    // border-radius: 20px;
    width: 900px;
    height: 900px;
    overflow: auto;
    padding: 50px;
    margin-top: 3rem;

    .mainTitle {
        label {
            display: block;
            text-align: center;
            background-color: #ddd;
            font-size: 24px;
            font-weight: bold;
            padding: 5px 0;
        }

        input {
            width: 100%;
            margin-top: 30px;
            padding: 5px 0;
        }
    }

    .secTitle {
        margin-top: 50px;

        label {
            display: block;
            text-align: center;
            background-color: #ddd;
            font-size: 24px;
            font-weight: bold;
            padding: 5px 0;
        }

        input {
            width: 100%;
            margin-top: 30px;
            padding: 5px 0;
        }
    }

    .mainPic {
        margin-top: 50px;

        .uploadPic {
            // border: 1px solid red; text-align: center;
            text-align: center;
            display: flex;
            flex-direction: column;
            margin-top: 50px;

            label {
                display: block;
                text-align: center;
                background-color: #ddd;
                font-size: 24px;
                font-weight: bold;
                padding: 5px 0;
            }

            .pic {
                border: 1px dashed #aaa;
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

            input {
                margin-top: 30px;
                height: 200px;
            }
        }
    }

    .choose {
        margin-top: 50px;
        // border: 1px solid red;

        label {
            // border: 1px solid red;
            // display: block;
            // width: 200px;
        }

        select {
            width: 200px;
        }
    }

    .Ctx {
        display: flex;
        flex-direction: column;
        text-align: center;
        margin-top: 50px;

        label {
            display: block;
            text-align: center;
            background-color: #ddd;
            font-size: 24px;
            font-weight: bold;
            padding: 5px 0;
        }

        .custom-input {
            border: 1px solid #333;
            // border-top:1px solid transparent;
            margin-top: 1rem;
            height: 200px;
            width: 100%;
            padding: 10px;
            // line-height: 200px;
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