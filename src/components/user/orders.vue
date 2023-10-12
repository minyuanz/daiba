<template>
    <div class="orderWrap">
        <div class="content">
            <h1> 訂單查詢 </h1>
            <div class="orderGrid">
                <div class="orderTitle">
                    <p>訂單編號</p>
                    <!-- <p>商品名稱</p> -->
                    <p>總金額</p>
                    <p>訂單狀態</p>
                </div>
                <div class="orderList" v-for=" (order, index) in ordersDisplay"
                    @click="ordersDisplay[index].isShow = !ordersDisplay[index].isShow">
                    <div class="order">
                        <p>{{ order.no }}</p>
                        <!-- <p>{{ order.name }}</p> -->
                        <p> NT {{ order.total }}</p>
                        <p>{{ order.status }}</p>
                    </div>
                    <div class="orderInfo" v-show="orders[index].isShow">
                        <div class="infoTitle">
                            <p>商品名稱</p>
                            <p>單價</p>
                            <p>數量</p>
                        </div>
                        <div class="infoCtx">
                            <p>{{ order.name }}</p>
                            <p>NT {{ order.price }}</p>
                            <p>{{ order.count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Page :total="orders.length" size="small" :page-size="pageSize" @on-change="updatePage" id="page" />
    </div>
</template>

<script>
export default {
    data() {
        return {
            orders: [{
                no: '1',
                total: 777,
                status: '備貨中',
                name: '台灣紀念酒杯',
                price: 123,
                count: 1,
                isShow: false,
            },
            {
                no: '2',
                total: 777,
                status: '備貨中',
                name: '台灣紀念酒杯',
                price: 123,
                count: 1,
                isShow: false,
            },
            {
                no: '3',
                total: 777,
                status: '備貨中',
                name: '台灣紀念酒杯',
                price: 123,
                count: 1,
                isShow: false,
            },
            {
                no: '4',
                total: 777,
                status: '備貨中',
                name: '台灣紀念酒杯',
                price: 123,
                count: 1,
                isShow: false,
            }],
            ordersDisplay: [],

            pageSize: 4,
            currentPage: 1,
        }
    },
    methods: {
        updatePage(page) {
            // console.log(page);
            this.currentPage = page
            this.ordersDisplay = this.orders
            const startIdx = (this.currentPage - 1) * this.pageSize
            const endIdx = startIdx + this.pageSize
            this.ordersDisplay = this.orders.slice(startIdx, endIdx);
        },
    },
    mounted() {
        this.ordersDisplay = this.orders
    },
}
</script>

<style lang="scss">
.orderWrap {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
    width: 900px;

    .content::-webkit-scrollbar {
        width: 15px;
    }

    .content::-webkit-scrollbar-track {
        box-shadow: #aaa;
    }

    .content::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #ccc;
        cursor: pointer;
    }
    .content{
        height: 90%;
        overflow-y: scroll;
        h1 {
            text-align: center;
            margin: 30px 0;
        }

        .orderGrid {
            .orderTitle {
                border: 1px solid #aaa;
                background-color: #e6e6e6;
                // border-radius: 20px;
                width: 80%;
                padding: 10px 0;
                margin: auto;
                display: flex;


                p {
                    // border: 1px solid red;
                    width: 100%;
                    text-align: center;
                }
            }

            .orderList {
                border: 1px solid #aaa;
                border-top: transparent;
                background-color: #ebebeb;
                width: 80%;
                margin: 0 auto;
                padding: 5px 0;
                cursor: pointer;

                .order {
                    display: flex;
                    // border: 1px solid red;
                    p {
                        // border: 1px solid red;
                        width: 100%;
                        text-align: center;
                    }
                }

                .orderInfo {
                    background-color: #fff;
                    // border: 1px solid red;
                    margin: 10px 0;

                    .infoTitle,
                    .infoCtx {
                        width: 100%;
                        margin: auto;
                        display: flex;
                        justify-content: space-between;
                        p {
                            // border: 1px solid red;
                            width: 100%;
                            text-align: center;
                        }
                    }
                }
            }
        }
    }

    #page {
        text-align: center;
    }
}

@media screen and (max-width:414px) {
    .orderWrap {
        border: 1px solid #aaa;
        background-color: #fff;
        border-radius: 20px;
        width: 900px;

        .orderGrid {
            .orderList {
                .orderInfo {

                    .infoTitle,
                    .infoCtx {
                        width: 100%;

                    }
                }
            }
        }
    }
}
</style>