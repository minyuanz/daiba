<template>
    <div class="artWrap">
        <h1>投稿文章</h1>
        <div class="artGrid">
            <div class="artCard" v-for="card in cardsDisplay">
                <div class="card-h">
                    <div class="img">
                        <img :src="card.image" alt="">
                        <div class="head">
                            <img :src="card.head" alt="">
                        </div>
                    </div>
                    <div class="text">
                        <div class="title">
                            <span class="tag gray">#{{ card.tag }}</span>
                            <h3>{{ card.title }}</h3>
                            <p>{{ card.title2 }}</p>
                        </div>
                    </div>
                    <span class="time">
                        {{ card.date }}
                    </span>
                    <p class="txt">
                        {{ card.ctx }}
                    </p>
                </div>
            </div>
            <!-- <Page 
            :total="cards.length" 
            size="small" 
            :page-size="pageSize" 
            @on-change="updatePage"  id="page"/> -->
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            cards: [{
                image: '../img/artCard.png',
                head: '../img/artCard1.png',
                tag: '住宿推薦',
                title: '原來京站樓上長這樣？',
                title2: '開箱五星級行政豪華客房一泊二食',
                date: '2020-06-15',
                ctx: '在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。'
            },
            {
                image: '../img/artCard.png',
                head: '../img/artCard1.png',
                tag: '住宿推薦',
                title: '原來京站樓上長這樣？',
                title2: '開箱五星級行政豪華客房一泊二食',
                date: '2020-06-15',
                ctx: '在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。'
            },
            {
                image: '../img/artCard.png',
                head: '../img/artCard1.png',
                tag: '住宿推薦',
                title: '原來京站樓上長這樣？',
                title2: '開箱五星級行政豪華客房一泊二食',
                date: '2020-06-15',
                ctx: '在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。'
            },
            {
                image: '../img/artCard.png',
                head: '../img/artCard1.png',
                tag: '住宿推薦',
                title: '原來京站樓上長這樣？',
                title2: '開箱五星級行政豪華客房一泊二食',
                date: '2020-06-15',
                ctx: '在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。'
            },
            {
                image: '../img/artCard.png',
                head: '../img/artCard1.png',
                tag: '住宿推薦',
                title: '原來京站樓上長這樣？',
                title2: '開箱五星級行政豪華客房一泊二食',
                date: '2020-06-15',
                ctx: '在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。'
            },
            {
                image: '../img/artCard.png',
                head: '../img/artCard1.png',
                tag: '住宿推薦',
                title: '原來京站樓上長這樣？',
                title2: '開箱五星級行政豪華客房一泊二食',
                date: '2020-06-15',
                ctx: '在日本旅行的時候最喜歡住在靠近JR車站或者地鐵站附近的飯店，而到台灣台北旅行，最方便的地點莫過於是住在台北車站或者西門附近的飯店，台北車站是五鐵共構的大車站......。'
            }],
            cardsDisplay: [],
            pageSize: 4,
            currentPage: 1,

        }
    },
    methods: {
        updatePage(page) {
            // console.log(page);
            this.currentPage = page
            this.cardsDisplay = this.cards
            const startIdx = (this.currentPage - 1) * this.pageSize
            const endIdx = startIdx + this.pageSize
            this.cardsDisplay = this.cards.slice(startIdx, endIdx);
        },
    },
    mounted() {
        this.cardsDisplay = this.cards
    },
}
</script>

<style lang="scss">
.artWrap {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
    width: 900px;

    h1 {
        text-align: center;
        margin-top: 30px;
        // grid-area: 1/1/2/3;
    }

    .artGrid {

        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(2, 1fr);
        gap: 30px;
        padding: 0 50px;
        justify-items: center;


        .artCard {
            .card-h {
                border: 1px solid #aaa;
                width: 100%;
                height: 350px;
                overflow: auto;

                .img {
                    .head {
                        overflow: auto;
                    }
                }
            }
        }

        #page {
            grid-area: 4/1/5/3;
        }
    }

}

@media screen and (max-width:414px) {
    .artWrap {
        width: 100%;

        .artGrid {
            grid-template-columns: repeat(1, 1fr);

            .artCard {
                .card-h {
                    // margin:  5px auto;
                    // overflow:auto;
                    // margin: 5px 0;
                    height: 520px;
                    margin: 0;

                }
            }
        }
    }

}
</style>