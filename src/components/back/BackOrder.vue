<template>
  <div>
    <div class="BackOrder" v-if="!showOrderDetailsPage">
      <div class="OrderSearch">
        訂單編號查詢:
        <input type="text" v-model="searchKeyword" @input="filterOrders" />
      </div>
      <div class="OrderTitle">
        <p>訂單編號</p>
        <p>會員編號</p>
        <p>金額</p>
        <p>物流狀態</p>
        <p>訂單詳情</p>
      </div>
      <div class="OrderInfro" v-for="order in filteredOrders">
        <p>{{ order.ord_id }}</p>
        <p>{{ order.mem_id }}</p>
        <p>{{ order.ord_price }}</p>
        <div class="edit">
          <select v-model="order.ord_status" @change="updateOrderStatus(order)">
            <option value="0">備貨中</option>
            <option value="1">配送中</option>
            <option value="2">配送完成</option>
          </select>
        </div>
        <div>
          <button class="DetailBtn" @click="showOrderDetails(order)">
            訂單詳情
          </button>
        </div>
      </div>
    </div>
    <div class="BackDetail" v-if="showOrderDetailsPage">
      <h1>訂單詳情</h1>
      <div>
        <p>訂單編號:</p>
        {{ selectedOrder.ord_id }}
      </div>
      <div>
        <p>會員編號:</p>
        {{ selectedOrder.mem_id }}
      </div>
      <div>
        <p>下單日期:</p>
        {{ selectedOrder.ord_date }}
      </div>
      <div>
        <p>訂單地址:</p>
        {{ selectedOrder.ord_address }}
      </div>
      <div>
        <p>信用卡號:</p>
        {{ selectedOrder.ord_credit }}
      </div>
      <div>
        <p>收件電話:</p>
        {{ selectedOrder.ord_phone }}
      </div>
      <div>
        <p>收件姓名:</p>
        {{ selectedOrder.ord_name }}
      </div>
      <div>
        <p>都件地址:</p>
        {{ selectedOrder.ord_address }}
      </div>
      <div>
        <p>訂單金額:</p>
        {{ selectedOrder.ord_price }}
      </div>
      <h1>訂單明細</h1>
      <div class="BackDetailM">
        <div class="BackDetailT">
          <p>商品圖片</p>
          <p>商品名稱</p>
          <p>價格</p>
          <p>數量</p>
        </div>
        <div
          class="BackDetailD"
          v-for="detail in selectedOrder.details"
          :key="detail.prod_id"
        >
          <img :src="$imgUrl(detail.prod_img1)" alt="" />
          <p>{{ detail.prod_name }}</p>
          <p>NT {{ detail.buy_price }}</p>
          <p>{{ detail.orderdetail_count }}</p>
        </div>
      </div>
      <button @click="showOrderDetailsPage = false">返回</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      orders: [],
      selectedOrder: null,
      showOrderDetailsPage: false,
      searchKeyword: "",
    };
  },
  mounted() {
    axios.get(this.$apiUrl("BackOrderM.php")).then((response) => {
      this.orders = response.data;
    });
  },
  methods: {
    showOrderDetails(order) {
      const apiUrl = this.$apiUrl(
        `BackOrderDetailM.php?orderId=${order.ord_id}`
      );
      axios.get(apiUrl).then((response) => {
        this.selectedOrder = {
          ...order,
          details: response.data,
        };
        this.showOrderDetailsPage = true;
      });
    },
    updateOrderStatus(order) {
      const newStatus = order.ord_status;
      const orderId = order.ord_id;
      axios
        .post(
          this.$apiUrl("UpdateOrderStatus.php"),
          {
            orderId: orderId,
            newStatus: newStatus,
          },
          {
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
          }
        )
        .then((response) => {
          if (response.data.success) {
            alert("訂單狀態已更新");
          } else {
            alert("訂單狀態更新失敗");
          }
        })
        .catch((error) => {
          alert("請求失敗");
        });
    },
  },
  computed: {
    filteredOrders() {
      // 使用搜索關鍵字過濾訂單
      if (this.searchKeyword) {
        return this.orders.filter((order) =>
          order.ord_id.toString().includes(this.searchKeyword)
        );
      } else {
        return this.orders; // 如果搜索關鍵字為空，則顯示所有訂單
      }
    },
  },
};
</script>

<style lang="scss">
.BackOrder {
  margin-top: 3rem;
  border: 1px solid #aaa;
  background-color: #fff;
  width: 900px;
  padding: 50px;
  height: 900px;
  overflow-y: scroll;

  .OrderSearch {
    padding: 10px;
    .OrderSearchBtn {
      width: 80px;
      height: 28px;
      margin-left: 10px;
    }
  }
  .OrderTitle {
    display: flex;
    justify-content: space-evenly;
    background-color: #ddd;
    padding: 5px 0;

    p {
      width: 100%;
      text-align: center;
    }
  }

  .OrderInfro {
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
  }
  .DetailBtn {
    // width: 80px;
    // height: 26px;
    border: 2px solid #666;
    background-color: transparent;
    cursor: pointer;
    border-radius: 5px;
    padding: 5%;
    transition: all 0.3s;

    &:hover {
      // border: 2px solid #333;
      background-color: #ddd;
    }
  }
}
.BackDetail {
  max-height: 900px;
  margin-top: 3rem;
  border: 1px solid #aaa;
  background-color: #fff;
  width: 900px;
  overflow-y: scroll;
  display: flex;
  flex-wrap: wrap;
  text-align: center;
  h1 {
    width: 100%;
    text-align: center;
    background-color: #aaa;
  }
  div {
    width: 45%;
    height: 40px;
    margin: 10px 0;
    display: flex;
    align-items: center;
    p {
      font-weight: bold;
      background-color: #aaa;
      width: 100px;
      text-align: center;
      margin-inline: 1rem;
    }
  }
  .BackDetailM {
    height: auto;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    .BackDetailT {
      width: 100%;
      display: flex;
      text-align: center;
      justify-content: center;
      p {
        background-color: #fff;
        width: 25%;
      }
      div {
        margin: auto;
      }
    }
    .BackDetailD {
      background-color: #fff;
      width: 100%;
      display: flex;
      // flex-wrap: wrap;
      height: 100px;
      justify-content: center;
      align-items: center;
      p {
        width: 25%;
        background-color: #fff;
      }
      img {
        width: 25%;
        height: 100px;
        margin-inline: 1rem;
      }
    }
  }
  button {
    width: 50px;
    height: 50px;
    margin: auto;
  }
}
</style>
