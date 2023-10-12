<template>
    <div class="SubmitTitle">
        <h1>投稿文章</h1>
    </div>
    <!-- 注意事項 -->
    <section class="SubmitNorms" v-show="Norms">

        <div class="txt">
            <p>投稿注意事項：</p>
            <ul>
                <li>投稿文章至歹霸俗（以下簡稱本站）必須為個人原作，不得抄襲。或曾經以任何形式在媒體上（包含FB個人頁面、粉絲團、個人部落格）發表或出版、曾經在其他網站上刊登過或屬翻譯作品概不接受。請勿「一稿多投」，本站對來稿有刪修權，但不負審查義務，若刊登後有侵犯他人著作權時，仍需自行負擔法律責任。
                </li>
                <li>不要允許未經授權的複製或重新分發文章。確保網站的內容僅在你的平台上可用，除非有明確的授權。</li>
                <li>引用或參考其他人的作品時，遵循引用規範，如適用的引用標準。</li>
                <li>投稿文章主題與內容必須符合台北捷運的「美食」、「景點」、「住宿」推薦之相關主題。</li>
                <li>投稿文章字數於300字以內，必須使用全型中文標點符號，須為繁體中文版本，若因以其他編碼（如簡體中文）遞交而出現亂碼情況，恕不予處理。</li>
                <li>實施內容審核流程，確保提交的文章內容符合網站的政策和規定。可以考慮將文章提交到審核隊列，並在審核通過後才發布。</li>
                <li>投稿文章(含所附之圖片、圖表等資料)一經錄用，版權即屬歹霸俗所有，稿件除刊載於本站外，也可能刊載在其他與國試論壇合作的媒體平台或電子書
                    報，同時亦可能收錄於國試論壇其他出版品。凡投稿被錄用，皆視為本網站可以無條件使用、編輯、刪改、重製、改作、散布、發行、公開發表、公開傳輸、翻譯該等資料之權利。</li>
                <li>文章將進行選擇標籤和分類，以幫助讀者瀏覽。</li>
            </ul>
            <!-- CheckBOX -->
            <div class="checkBox">
                <input type="checkbox" id="checkbox">
                <span>我同意</span>
            </div>
            <!-- 下一步 -->
            <div class="next">
                <ButtonS class="btn_s" :HTMLInner="btninner[0]" @click="ToSubmit" />
                <!-- <button class="btn_s" @click="ToSubmit">下一步</button> -->
            </div>
        </div>
    </section>

    <!-- 填寫頁面 -->
    <section class="SubmitArea" v-show="Submit">
        <form @submit.prevent="addNewSubmit" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="title">標題</label>
                    <input type="txt" v-model="newSubmitArticle.title" @input="checkTitle">
                    <span v-if="titleError">請輸入標題</span>
                </li>
                <li>
                    <label for="title">副標題</label>
                    <input type="txt" v-model="newSubmitArticle.subTitle" @input="checkSubTitle">
                    <span v-if="subTitleError">請輸入副標題</span>
                </li>
                <li>
                    <label for="title">地址</label>
                    <input type="txt" v-model="newSubmitArticle.address" @input="checkSubTitle">
                    <span v-if="addressError">請輸入地址</span>
                </li>
                <li>
                    <label for="title">選擇分類</label>
                    <div class="select">
                        <select name="" id="" v-model="newSubmitArticle.line" @change="checkClass(newSubmitArticle)">
                            <option value="0">請選擇捷運線</option>
                            <option value="blue">板南線</option>
                        </select>
                        <select name="" id="" v-model="newSubmitArticle.station" @change="checkClass(newSubmitArticle)">
                            <option value="0">請選擇捷運站</option>
                            <option value="10">板橋</option>
                        </select>
                        <select name="" id="" v-model="newSubmitArticle.class" @change="checkClass(newSubmitArticle)">
                            <option value="0">請選擇項目</option>
                            <option value="1">美食</option>
                            <option value="2">景點</option>
                            <option value="3">住宿</option>
                        </select>
                    </div>
                    <span v-if="classError">請選擇分類</span>
                </li>
                <li>
                    <label for="title">上傳圖片</label>
                    <div class="UploadImg">
                        <div class="img" v-for="i in 3" :key="inputKey">
                            <p>＋</p>
                            <input type="file" accept="image/*" multiple @change="handleFileUpload(i, $event)"
                                :name="'img' + inputKey">
                            <img v-if="imgsData[i]" :src="uploadedImages[i]" alt="">
                        </div>
                    </div>
                    <span v-if="imageError">請至少上傳一張圖片</span>
                </li>
                <li>
                    <label for="txt">內文</label>
                    <textarea name="" id="txt" cols="30" rows="10" style="resize:none" v-model="newSubmitArticle.content"
                        @input="checkTxt"></textarea>
                    <span v-if="txtError">請輸入內文</span>
                </li>
            </ul>

            <div class="next">
                <ButtonS class="btn_s" :HTMLInner="btninner[0]" type="submit" />
            </div>
        </form>

    </section>


    <!-- 完成頁面 -->
    <section class="SubmitFinish" v-show="Finish">
        <p>感謝您的投稿，我們將為您審核，請耐心等候。</p>
        <div class="next">
            <router-link to="/Contribute" class="btn_s">
                <ButtonS :HTMLInner="btninner[1]" />
            </router-link>
        </div>
    </section>
</template>


<script>
import { Checkbox } from 'view-ui-plus';
import ButtonS from '@/components/ButtonS.vue';
import axios from 'axios';
export default {
    data() {
        return {
            btninner: ["下一步", "返回投稿熱門"],
            Norms: true,
            Submit: false,
            Finish: false,
            title: '',
            subtitle: '',
            txt: '',
            titleError: false,
            subTitleError: false,
            classError: false,
            imageError: false,
            txtError: false,
            addressError: false,
            uploadedImages: [],
            imgsData: [],
            inputKey: 1,
            newSubmitArticle: {
                title: '',
                subTitle: '',
                address: '',
                line: 0,
                station: 0,
                class: 0,
                pic1: null,
                pic2: null,
                pic3: null,
                content: '',
            },

        }
    },
    components: {
        ButtonS
    },
    methods: {
        ToSubmit() {
            let consent = document.getElementById('checkbox').checked
            if (consent === true) {
                this.Norms = false
                this.Submit = true
            } else {
                alert('請閱讀並同意條款才能夠投稿！')
            }
        },

        checkTitle() {
            if (this.newSubmitArticle.title === '') {
                this.titleError = true;
            } else {
                this.titleError = false;
            }
        },
        checkSubTitle() {
            if (this.newSubmitArticle.subTitle === '') {
                this.subTitleError = true;
            } else {
                this.subTitleError = false;
            }
            if (this.newSubmitArticle.address === '') {
                this.addressError = true;
            } else {
                this.addressError = false;
            }
        },
        checkClass(newSubmitArticle) {
            if (newSubmitArticle.line === '0' || newSubmitArticle.section === '0' || newSubmitArticle.class === '0') {
                this.classError = true;
            } else {
                this.classError = false;
            }
        },
        checkTxt() {
            if (this.newSubmitArticle.txt === '') {
                this.txtError = true;
            } else {
                this.txtError = false;
            }
        },
        checkImg() {
            if (this.uploadedImages.length <= 0) {
                this.imageError = true;
            } else {
                this.imageError = false;
            }

        },
        Send() {
            this.checkTitle();
            this.checkSubTitle();
            // this.checkClass();
            this.checkTxt();
            this.checkImg();

            if (this.titleError || this.subTitleError || this.classError || this.txtError || this.uploadedImages.length <= 0) {
                alert('請檢查輸入欄位');
                return; // 停止执行
            } else {

            }

        },
        // 預覽圖片
        handleFileUpload(index, event) {
            const fileInput = event.target;
            const files = fileInput.files;
            console.log(fileInput)
            console.log(files)

            for (let j = 0; j < files.length; j++) {
                const file = files[j];

                this.uploadedImages[index] = URL.createObjectURL(file);
                this.imgsData[index] = true;
                this.newSubmitArticle[`pic${index}`] = file;



            }


        },

        // POST到後端
        addNewSubmit() {
            console.log(this.newSubmitArticle)
            const formData = new FormData();
            formData.append('art_title', this.newSubmitArticle.title);
            formData.append('art_subTitle', this.newSubmitArticle.subTitle);
            formData.append('art_address', this.newSubmitArticle.address);
            formData.append('sta_id', this.newSubmitArticle.station);
            formData.append('fea_id', this.newSubmitArticle.class);
            formData.append('art_pic1', this.newSubmitArticle.pic1);
            formData.append('art_pic2', this.newSubmitArticle.pic2);
            formData.append('art_pic3', this.newSubmitArticle.pic3);
            formData.append('art_content', this.newSubmitArticle.content);
            formData.append('mem_id', parseInt(this.$store.state.memInfo.mem_id));

            axios.post('http://localhost/dai/public/phps/submit.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then((response) => {
                    if (response.status === 200) { //檢查http  狀態碼來判別 php新增成功與否
                        this.Submit = false;
                        this.Finish = true;
                        // 下面為新增成功後 清空表單

                        this.newSubmitArticle = {
                            title: '',
                            subTitle: '',
                            address: '',
                            line: 0,
                            station: 0,
                            class: 0,
                            pic1: null,
                            pic2: null,
                            pic3: null,
                            content: '',
                        };
                    } else {
                        this.Send();
                    }
                })
                .catch((error) => {
                    console.error('新增商品請求失敗：', error);
                });
        },
    }
    , mounted() {
        console.log(parseInt(this.$store.state.memInfo.mem_id))
    }
}






</script>