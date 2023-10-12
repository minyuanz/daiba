<template>
    <section class="CBWrapper">
        <h1>投稿熱門</h1>
        <!-- 跑馬燈區 -->
        <div class="swiperBanner">
            <div class="swiper-wrapper">
                <div class="swiper-slide" v-for="(taipeis, taipeisIndex) in swipers" :key="taipeisIndex"
                    :class="{ even: evenPic(taipeisIndex) }">
                    <div class="pic">
                        <img :src="taipeis.image" :alt="taipeis.CTName" />
                        <div class="info">
                            <div class="tag">
                                <span v-for="(MRTline, lineIndex) in taipeis.station" :key="lineIndex"
                                    :class="getClassObject(taipeis.line, lineIndex)">{{ MRTline }}</span>
                            </div>
                            <p>{{ taipeis.CTName }}</p>
                            <p class="en">{{ taipeis.ENName }}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" v-for="(taipeis, taipeisIndex) in swipers" :key="taipeisIndex"
                    :class="{ even: evenPic(taipeisIndex) }">
                    <div class="pic">
                        <img :src="taipeis.image" :alt="taipeis.CTName" />
                        <div class="info">
                            <div class="tag">
                                <span v-for="(MRTline, lineIndex) in taipeis.station" :key="lineIndex"
                                    :class="getClassObject(taipeis.line, lineIndex)">{{ MRTline }}</span>
                            </div>
                            <p>{{ taipeis.CTName }}</p>
                            <p class="en">{{ taipeis.ENName }}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" v-for="(taipeis, taipeisIndex) in swipers" :key="taipeisIndex"
                    :class="{ even: evenPic(taipeisIndex) }">
                    <div class="pic">
                        <img :src="taipeis.image" :alt="taipeis.CTName" />
                        <div class="info">
                            <div class="tag">
                                <span v-for="(MRTline, lineIndex) in taipeis.station" :key="lineIndex"
                                    :class="getClassObject(taipeis.line, lineIndex)">{{ MRTline }}</span>
                            </div>
                            <p>{{ taipeis.CTName }}</p>
                            <p class="en">{{ taipeis.ENName }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 引導訊息 -->
        <div v-show="closeTxt" class="talk">
            <p>
                還有其他推薦的捷運美食、景點與住宿嗎？<br />
                來與大家分享你私心推薦的站點吧！
            </p>
            <span @click="closeTxt = !closeTxt">✖</span>
        </div>

        <!-- 我要投稿 -->
        <div class="toCB">
            <router-link to="/Submit">
                <ButtonM :HTMLInner="btninner" />
            </router-link>
        </div>
    </section>

    <section class="CBArea">
        <div class="CBTitle">
            <h2>投稿專欄</h2>

            <!-- 標籤 -->
            <div>
                <span v-for="(CBtag, tagindex) in CBtag" :key="tagindex" class="gray">#{{ CBtag }}</span>
            </div>
            <div>
                <span v-for="(MRTLine, MRTLineindex) in MRTLine" :key="MRTLineindex"
                    :class="getClassObject(MRTLine, MRTLineindex)">#{{ MRTLine }}</span>
            </div>
        </div>

        <!-- 文章清單 -->
        <div class="CBList">
            <div v-for="itemList in CBList" :key="itemList.art_no"
                @click="(closePost = !closePost), (lightBox = !lightBox), openInner(itemList)">
                <div :class="{ 'card-w': PC, 's-card-h': !PC }">
                    <div class="img">
                        <img :src="`${this.$store.state.imgURL}` + itemList.art_pic1" alt="">
                        <!-- <img :src="PC ? 'https://picsum.photos/200/280/?random=10' : 'https://picsum.photos/280/200/?random=10'" /> -->
                        <!-- <img src="https://picsum.photos/80/80/?random=10" class="head" /> -->
                    </div>
                    <div class="text">
                        <div class="title">
                            <h3>{{ itemList.art_title }}</h3>
                            <p>{{ itemList.art_subTitle }}</p>
                            <div class="tag">
                                <span class="title-tag gray">#景點推薦</span>
                                <span class="title-tag blue">#板南線</span>
                            </div>
                            <span class="s_text time">{{ itemList.art_date }}</span>
                        </div>
                        <div class="txt">
                            {{ itemList.art_content }}
                        </div>

                    </div>
                </div>
            </div>
            <!-- 文章內容 -->
            <div class="CBPost" v-show="closePost">
                <div class="box">
                    <img src="https://picsum.photos/200/200/?random=10" class="head" />
                    <span class="closePost" @click="(closePost = !closePost), (lightBox = !lightBox)">✖</span>
                    <div class="swiperPost">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img :src="`${this.$store.state.imgURL}` + CBPost.art_pic1" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img :src="`${this.$store.state.imgURL}` + CBPost.art_pic2" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img :src="`${this.$store.state.imgURL}` + CBPost.art_pic3" alt="">
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="inner">
                        <div class="title">
                            <h3>{{ CBPost.art_title }}</h3>
                            <h4>{{ CBPost.art_subTitle }}</h4>
                        </div>
                        <div class="scrollbarArea">
                            <div class="info">
                                <p>地址：{{ CBPost.art_address }}</p>
                                <span class="PostingDate">發布日期：{{ CBPost.art_date }}</span>
                            </div>
                            <div class="txt">
                                <p>{{ CBPost.art_content }}</p>
                            </div>
                        </div>
                        <div class="author">
                            <div class="line"></div>
                            <span>TIM SMITH JR.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 燈箱 -->
    <div class="lightBox" v-show="lightBox"></div>

    <!-- 背景輪播 -->
    <div class="mrtBanner">
        <div class="swiper" id="mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide test" v-for=" in 20">
                    <img src="../../public/img/mrtArrow2.png" alt="" />
                </div>
            </div>
        </div>
    </div>

    <!-- 背景輪播 -->
    <div class="mrtBanner">
        <div class="swiper" id="mySwiper2">
            <div class="swiper-wrapper">
                <div class="swiper-slide test" v-for=" in 20">
                    <img src="../../public/img/mrtArrow2.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { faL } from "@fortawesome/free-solid-svg-icons";
import Swiper from "swiper/bundle";
import ButtonM from '@/components/ButtonM.vue';
import axios from 'axios';
export default {
    data() {
        return {
            CBList: [],
            CBPost: [],
            PC: true,
            LAP: true,
            btninner: "我要投稿",
            swipers: [
                {
                    image: `${this.$store.state.publicURLL}/img/Grand Hyatt Taipei.jpg`,
                    station: ["BL12", "R10"],
                    line: ["板南線", "淡水信義線"],
                    tag: "住宿",
                    ENName: "Palais de Chine Hotel Taipei",
                    CTName: "君品酒店",
                },
                {
                    image: `${this.$store.state.publicURLL}/img/Humble Boutique Hotel.jpg`,
                    station: ["G15", "O08"],
                    line: ["松山新店線", "中和新蘆線"],
                    tag: "住宿",
                    ENName: "Humble Boutique Hotel",
                    CTName: "寒居酒店",
                },
                {
                    image: `${this.$store.state.publicURLL}/img/Xiangshan.png`,
                    // image: "../img/Xiangshan.png",
                    station: ["R02"],
                    line: ["淡水信義線"],
                    tag: "景點",
                    ENName: "Xiangshan",
                    CTName: "象山",
                },
                {
                    image: `${this.$store.state.publicURLL}/img/Gui.jpg`,
                    // image: "../img/Gui.jpg",
                    station: ["R12"],
                    line: ["淡水信義線"],
                    tag: "美食",
                    ENName: "Cheng Zong The Canned Rice Cake",
                    CTName: "正宗筒仔米糕",
                },
                {
                    image: `${this.$store.state.publicURLL}/img/National monument.jpg`,
                    // image: "../img/National monument.jpg",
                    station: ["G10", "R08"],
                    line: ["松山新店線", "淡水信義線"],
                    tag: "景點",
                    ENName: "National monument",
                    CTName: "中正紀念堂",
                },
                {
                    image: `${this.$store.state.publicURLL}/img/Wagui.jpg`,
                    // image: "../img/Wagui.jpg",
                    station: ["G19"],
                    line: ["松山新店線"],
                    tag: "美食",
                    ENName: "Raohe St. Night Market Savory Rice Pudding",
                    CTName: "饒河碗糕關東煮",
                },
                {
                    image: `${this.$store.state.publicURLL}/img/Taipei Park.jpg`,
                    // image: "../img/Taipei Park.jpg",
                    station: ["R16"],
                    line: ["淡水信義線"],
                    tag: "景點",
                    ENName: "Taipei Children's Amusement Park",
                    CTName: "台北兒童新樂園",
                },
                {
                    image: `${this.$store.state.publicURLL}/img/zoo.jpg`,
                    // image: "../img/zoo.jpg",
                    station: ["BR01"],
                    line: ["文湖線"],
                    tag: "景點",
                    ENName: "Taipei Zoo",
                    CTName: "台北市立動物園",
                },
            ],
            colorClassMap: {
                板南線: "blue",
                淡水信義線: "red",
                松山新店線: "green",
                中和新蘆線: "orange",
                文湖線: "brown",
                環狀線: "yellow",
            },
            CBtag: ["所有文章", "美食推薦", "景點推薦", "住宿推薦"],
            MRTLine: [
                "中和新蘆線",
                "淡水信義線",
                "松山新店線",
                "板南線",
                "文湖線",
                "環狀線",
            ],
            closeTxt: true,
            closePost: false,
            lightBox: false,
            swiper: false,
        };
    },
    components: {
        ButtonM
    },
    methods: {
        windowWidth() {
            if (window.innerWidth <= 1280) {
                this.LAP = true;
                this.PC = false;

            } else {
                this.PC = true;
                this.LAP = false;
            }
        },
        evenPic(taipeisIndex) {
            return taipeisIndex % 2 === 0;
        },
        getClassObject(colors, lineIndex) {
            const color = colors[lineIndex];
            const lineColor = this.colorClassMap[color];
            const lineColorTag = this.colorClassMap[colors];
            if (Array.isArray(colors)) {
                return lineColor;
            } else {
                return lineColorTag;
            }
        },
        // 背景圖
        initSwiper() {
            const swiper = new Swiper(".swiper", {
                direction: "vertical",
                speed: 3500,
                loop: true,
                loopedSlides: 10,
                autoHeight: true,
                slidesPerView: "auto",
                spaceBetween: 0,
                autoplay: {
                    delay: 0,
                    pauseOnMouseEnter: false,
                    disableOnInteraction: false,
                },
            });
        },
        openInner(item) {
            this.CBPost = item
            // this.closePost = false
            this.lightBox = true

        }
    },
    computed: {

    },

    mounted() {

        this.windowWidth()
        // 景點輪播
        const swiperBanner = new Swiper(".swiperBanner", {
            direction: "horizontal",
            speed: 2000,
            loop: true,
            slidesPerView: "auto",
            spaceBetween: -1,
            allowTouchMove: false,
            loopedSlides: 5,
            autoplay: {
                delay: 0,
                pauseOnMouseEnter: true,
                disableOnInteraction: false,
            },
        });

        // 投稿輪播
        const swiperPost = new Swiper(".swiperPost", {
            effect: "cube",
            speed: 2000,
            loop: true,
            autoplay: {
                delay: 1000
            },
            cubeEffect: {
                shadow: true,
                slideShadows: true,
                shadowOffset: 20,
                shadowScale: 0.94,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        // 背景圖輪播
        setTimeout(() => {
            this.initSwiper();
        }, 100); // 延遲100毫秒


        window.addEventListener("resize", this.windowWidth);
    },
    created() {
        axios.get('http://localhost/dai/public/phps/getArticle.php')
            .then((res) => {
                this.CBList = res.data
                console.log(this.CBList)
            })
            .catch((error) => {
                console.error('資料失敗：', error);
            });
    }
}
</script>


<style scoped lang="scss">
@import "../assets/scss/page/ContributeView";
</style>
