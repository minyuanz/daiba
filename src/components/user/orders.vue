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
                <div class="orderList" v-for="order in ordersDisplay" :key="order.ord_id" @click="loadOrderDetails(order.ord_id)">
                    <div class="order">
                        <p>{{ order.ord_id }}</p>
                        <p>NT {{ order.ord_price }}</p>
                        <p>{{ getOrderStatusText(order.ord_status) }}</p>
                    </div>
                    <div class="orderInfo" v-show="order.isShow">
                        <div class="infoTitle">
                            <p>商品圖片</p>
                            <p>商品名稱</p>
                            <p>價格</p>
                            <p>數量</p>
                        </div>
                        <div class="infoCtx" v-for="detail in order.details" :key="detail.prod_id">
                            <img :src="`${this.$store.state.imgURLp}` +  detail.prod_img1" alt="">
                            <p>{{ detail.prod_name }}</p>
                            <p>NT {{ detail.buy_price }}</p>
                            <p>{{ detail.orderdetail_count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Page :total="orders.length" size="small" :page-size="pageSize" @on-change="updatePage" id="page" />
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            orders: [],
            ordersDisplay: [],
            pageSize: 4,
            currentPage: 1,
        }
    },
    methods: {
    fetchOrders(memberId) {
    axios.get(`http://localhost/dai/public/phps/MemberOrderM.php?memberId=${memberId}`)
      .then((response) => {
        this.orders = response.data; 
        this.updatePage(1); 
      })
      .catch((error) => {
        console.error("獲取失敗", error);
      });
  },
  loadOrderDetails(orderId) {
  axios
    .get(`http://localhost/dai/public/phps/MemberOrderDerailM.php?orderId=${orderId}`)
    .then((response) => {
      const orderIndex = this.orders.findIndex(order => order.ord_id === orderId);
      if (orderIndex !== -1) {
        this.orders[orderIndex].details = response.data;
         this.toggleOrderInfo(this.orders[orderIndex]);
      }
    })
    .catch((error) => {
      console.error("請求訂單明細失敗", error);
    });
},
    updatePage(page) {
      this.currentPage = page;
      const startIdx = (this.currentPage - 1) * this.pageSize;
      const endIdx = startIdx + this.pageSize;
      this.ordersDisplay = this.orders.slice(startIdx, endIdx);
    },
    toggleOrderInfo(order) {
        order.isShow = !order.isShow;
        },
    loadPreviousPage() {//上一  頁
        if (this.currentPage > 1) {
            this.updatePage(this.currentPage - 1);
        }
        },
    loadNextPage() {//下一頁
        const maxPage = Math.ceil(this.orders.length / this.pageSize);
        if (this.currentPage < maxPage) {
            this.updatePage(this.currentPage + 1);
        }
        },
    getOrderStatusText(status) {
        status = parseInt(status, 10);
        switch (status) {
            case 0:
            return "準備中";
            case 1:
            return "運送中";
            case 3:
            return "完成配送";
            default:
            return "請聯繫客服";
        }
        },
    },
    mounted() {//渲染
    const memId = this.$store.state.memInfo.mem_id;
    if (memId) {
      this.fetchOrders(memId);
    }
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
                        img{
                            width:100%;
                            height:100px ;
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