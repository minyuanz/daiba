<template>
    <div class="newsinWrap">
        <span class="newsinTag title-tag gray">#{{ news.tag }}</span>
        <span class="newsindate"> 發佈日期：{{ news.date }}</span>
        <h1>{{ news.title }}</h1>

        <div class="swiper">
            <div class="newsinpic swiper-wrapper">
                <img :src="news.image" alt="" class="swiper-slide">
                <img :src="news.image1" alt="" class="swiper-slide">
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="newsintxt">
            <p>{{ news.contents }}</p>
        </div>

        <div class="newsinBtn">
            <button class="btn_s">
                <router-link to="/home">前往官網</router-link>
            </button>
            <button class="btn_s">
                <router-link to="New">上一頁</router-link>
            </button>
        </div>
    </div>
</template>

<script>
import Swiper from "swiper/bundle";

export default {
    data() {
        return {
            news: {
                tag: '活動消息',
                date: '2023-07-07',
                title: '植感生活－植物郵票與押花特展',
                image: require('../../public/img/newsbackimg.jpg'),
                image1: require('../../public/img/news4.png'),
                contents: '綠色植物的生命力，讓人感到快樂與朝氣。為鼓勵大眾親近植物，本館特規劃「植感生活－植物郵票與押花特展」，期透過展出郵票與手作押花作品，使民眾認識植物，推廣香草植物的多元應用與花藝美學，讓生活增添綠意與愜意。'
            }
        }
    },
    mounted() {
        const swiper = new Swiper(".swiper", {
            direction: "horizontal",
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 3000
            },
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
        })

        // const swiper = new Swiper(".swiper", {
        //     // Optional parameters
        //     direction: "horizontal",
        //     speed: 1500,
        //     loop: true,
        //     slidesPerView: 1,
        //     spaceBetween: 0,
        //     scrollbar: {
        //         // dragcClass:'.swiper-scrollbar'
        //         el: '.swiper-scrollbar'
        //     },
        //     initialSlide: 0, //第一個顯示的畫面,
        //     // grabCursor: true,
        //     breakpoints: { //width:414px顯示一個
        //         414: {
        //             slidesPerView: 1
        //         }
        //     }
        // }
        // )
    }
}

</script>

<style lang="scss">
@import "@/assets/scss/page/newsinside";
</style>