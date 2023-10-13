<template>
  <div class="ShopWrap">
    <div class="ShopSpeedBox">
      <div class="course">
        <section>
          <h4 class="SpeedNo unwork">1</h4>
          <h4 class="SpeedText ">購 物 車</h4>
        </section>
        <div></div>
        <section>
          <h4 class="SpeedNo info">2</h4> 
          <h4 class="SpeedText">付款運送</h4>
        </section>
        <div></div>
        <section>
          <h4 class="SpeedNo unwork">3</h4>
          <h4 class="SpeedText">訂單完成</h4>
        </section>
      </div>
    </div>
    <div class="ShopProBOX">
      <div class="ShopProTitle" @click="">合計:NT: {{ cartTotal }}</div>

      <div class="ShopProCardBox">
        <div class="ShopProCardTitle">
          <div>圖片</div>
          <div>資料</div>
          <div>單價</div>
          <div>數量</div>
          <div>小計</div>
        </div>
        <div v-for="(product, index) in cartItems" :key="index" class="ShopProCardDetail">
          <div class="CardDetailImg">
            <img :src="`${this.$store.state.imgURLp}` +  product.prod_img1" alt="">
          </div>
          <div class="CardDetailTitle">{{ product.prod_name }}</div>
          <div class="CardDetailPrice">NT${{ product.prod_price }}</div>
          <div class="CardDetailCount">
            <p>{{ product.count }}</p>
          </div>
          <div class="CardDetailTotal">NT${{ product.prod_price * product.count }}</div>
        </div>
      </div>
    </div>
    <div class="ShopPayBox">
      <div class="PayTItle">付款方式</div>
      <div class="checking">
        <div class="PayCredit"><input  type="radio" name="Pay" value="信用卡付款"  v-model="selectedPayment">信用卡付款</div>
        <transition name="slide-fade">
            <form class="ShopCredCard" v-if="selectedPayment === '信用卡付款'" >
            <div class="form-group" >
              <label for="creditCardNumber">信用卡號碼</label>
              <input
                type="text"
                id="creditCardNumber"
                name="creditCardNumber"
                placeholder="信用卡號碼"
                v-model="creditCardNumber"
              />
            </div>
            <div class="form-group">
              <label for="expirationDate">有效日期</label>
              <input
                type="text"
                id="expirationDate"
                name="expirationDate"
                placeholder="MM/YY"
                v-model="expirationDate"
              />
            </div>
            <div class="form-group">
              <label for="securityCode">安全碼</label>
              <input
                type="text"
                id="securityCode"
                name="securityCode"
                placeholder="卡片安全碼"
                v-model="securityCode"
              />
            </div>
          </form>
        </transition>
        <div class="PayCash"><input  type="radio" name="Pay" value="貨到付款"  v-model="selectedPayment">貨到付款</div>
      </div>
     
      
    </div>
    <div class="ShopDelBox">
      <div class="DelTitle">運送方式</div>
      <div class="DelComent">
        <div > 收件人姓名:<input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="請輸入收件人姓名" v-model="ord_name" /></div> 
        <div > 收件人電話:<input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="09XXXXXXXX" v-model="ord_phone" /></div> 
        <div > 收件人信箱:<input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="請輸入信箱" v-model="ord_email" /></div> 
        <div > 收件人地址:<input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="清輸入地址" v-model="ord_address" /></div> 
      </div>
    </div>
    <div class="pointBox">
      <div class="title">使用點數</div>
      <div class="pointRemain">
        <p>{{member}}，您尚有:{{point}}點，是否使用點數:</p>
        <div class="usePoint"><input id="use" type="radio" name="point" value="usePoint" v-model="SelectionPointUse"><label for="use">使用點數折抵</label></div>
        <div class="withoutPoint"><input id="noUse" type="radio" name="withoutPoint" value="nope" v-model="SelectionPointUse"><label for="noUse">不使用點數折抵</label></div>
      </div>
    </div>
    <div class="ShopSumBox">
      <div >
      <p>折扣後小計:</p> 
      <p class="SumBoxNo">NT${{ cartTotal }}</p>
      </div>
      <div >
      <p>運費:</p> 
      <p class="SumBoxNo">NT$150</p>
      </div>
      <div>
      <p>商品金額總計:</p> 
      <p class="SumBoxNoex">NT${{ cartTotal +150 }}</p>
      </div>
      <div >
      <p></p> 
      <p class="SumBoxNoex">(含運費)</p>
      </div>
    </div>
    <div class="ShopBtmBox">
      <div class="btn_s" @click="gotoCart">上一頁</div>
      <div class="btn_s" @click="gotoShoppingDone">訂單確認</div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      member:'會員',
      point:20,
      selectedPayment: '' ,
      creditCardNumber: '',
      expirationDate: '',
      securityCode: '',
      SelectionPointUse:'',
      ord_name: '', // 訂單姓名
      ord_phone: '', // 訂單電話
      ord_email: '', // 訂單信箱
      ord_address: '', // 訂單地址
    };
  },
  computed: {
    cartItems() {
      return this.$store.state.cart; 
    },
    cartTotal() {
      return this.$store.getters.cartTotal; 
    },
  },
  methods: {
    gotoCart(){
      this.$router.push("/Cart"); 
    },
    gotoShoppingDone() {
      // 發送的數據
      const orderDetails = this.cartItems.map(product => ({//此唯一單單的明細
      prod_id: product.prod_id,
      orderdetail_count: product.count,
      buy_price: product.prod_price * product.count,
      }));
      const user = localStorage.getItem('user');
      const mem_id = JSON.parse(user).mem_id;
      const orderData = {
        mem_id: mem_id, //用戶id
        cartTotal: this.cartTotal, // 購物車總價
        ord_name: this.ord_name, // 收件人源
        ord_phone: this.ord_phone, // 收件電話
        ord_email: this.ord_email, // 收件信箱
        ord_address: this.ord_address, // 收件地址
        selectedPayment: this.selectedPayment, // 付款方式
        creditCardNumber: this.creditCardNumber, // 信用卡號
        expirationDate: this.expirationDate, // 有效期限
        securityCode: this.securityCode, // 安全碼
        SelectionPointUse: this.SelectionPointUse, // 是否使用折扣
        orderDetails: orderDetails,
      };
      fetch('http://localhost/dai/public/phps/CreatOrderandDetail.php', {
        method: 'POST',
        body: JSON.stringify(orderData),
        headers: {
          'Content-Type': 'application/json',
        },
      })
        .then(response => response.json())
        .then(data => {
          // 回傳訊息
        console.log(data);
              // 清空購物車
        this.$store.commit('clearCart');
        alert('訂單送出成功');
        this.$router.push('/shoppingDone');
        })
        .catch(error => {
          console.error(error);
        });
    },
    cartTotal() {
      return this.$store.getters.cartTotal;
    },
  },
};
</script>



<style lang="scss">
.slide-fade-enter-active, .slide-fade-leave-active {
  transition: all 0.5s ease; 
}
.slide-fade-enter, .slide-fade-leave-to  {
  height: 0; 
  opacity: 0; 
  transform: translateY(20px);
}
.ShopWrap{
  position: relative;
  max-width: 1200px;
  padding: 2.5rem 1.5rem;
  margin: auto;
  width: 100%;
  .ShopSpeedBox{
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    .course{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 3rem 0;
        div{
          width: calc(35% - 90px);
          height: 2px;
          background-color:#bbb;
          margin-bottom: 20px;
        }
        section{
          text-align: center;
          .SpeedNo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: #5555 1px solid;
            inset: 0;
            margin: 1rem auto ;
            color: #fff;
            line-height: 58px;
          }
          .SpeedText {
            color: #555;
            width: 72px;
          }
        }
      }

  }
  .ShopProBOX{
    position: relative;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 15px;
    background-color: rgb(234, 233, 233);
    width: 100%;
    .ShopProTitle{
      position: relative;
      padding: 30px;
      font-size:map-get($map: $fontsizes, $key: h3);
      text-align: center;
      // &::after{
      //   content: ">";
      //   width: 30px;
      //   height: 30px;
      //   position: absolute;
      //   transform: rotate(90deg);
      //   font-weight:bold;
      //   font-size:map-get($map: $fontsizes, $key: h2);
      //   cursor: pointer;
      // }
    }
    .ShopProCardBox{
      display: flex;
      flex-wrap: wrap;
      width: 100%;
      font-size:map-get($map: $fontsizes, $key: h4);
      background-color: white;
      margin: auto;
      .ShopProCardTitle{
        width: 100%;
        display: flex;
        margin: auto;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding: 10px 15px;
        div{
          width: 20%;
        }
      }
      .ShopProCardDetail{
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 4px;
        width: 100%;
        display: flex;
        margin: auto;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding: 10px 5px;
        div{
          width: 20%;
        }
        .CardDetailImg{
          img{
            width: 100%;
            height:150px;
            vertical-align: top;
            object-fit: cover;
          }
        }
        .CardDetailTitle{
          padding: 0 1rem;
        }
        .CardDetailCount{
          display: flex;
          margin: 0;
          align-items: center;
          justify-content: center;
        }
        .CardDetailTotal{}
      }
    }

  }
  .ShopPayBox{
    margin: 3rem 0;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 15px;
    .PayTItle{
      padding: 10px 20px;
      background-color: rgb(234, 233, 233); ;
    }
    .checking{
      padding: 1rem 10px;
      div{
        padding: 1rem 10px;
        display: flex;
        gap: 1.2rem;
        label {
          display: block;
          font-weight: bold;
          width: 60px;
          line-height: 21px;
          text-align: right;
          margin-left: 2.3rem;
          input[type="text"] {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 3px;
          font-size: 16px;
          }
      }
    }
  }
  }
  .ShopDelBox{
    margin: 20px 0;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 15px;
    div{padding: 20px 10px;}
    .DelTitle{
      padding: 1rem 20px;
      background-color: rgb(234, 233, 233); 
    }
    .DelComent{
      display: flex;
      flex-wrap: wrap;
      div{
        line-height: 2;
        width: 100%;
        input{
          margin-left: 20px;
          width: 30%;
        }
      }
    }
  }
  .pointBox{
    margin: 20px 0;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 15px;
    div{padding: 20px 10px;}  
    .title{
      padding: 1rem 20px;
      background-color: rgb(234, 233, 233); 
    }
    .pointRemain{
      padding: 1rem 10px;
      div,p{
        padding: 1rem 10px;
        display: flex;
        gap: 1.2rem;

          label {
            display: block;
            width: 100%;
            line-height: 21px;
            text-align: left;
          }
        }
    }
  }
  .ShopSumBox{
    padding: 30px 10px;
    display: flex;
    flex-wrap: wrap;
    background-color: rgb(234, 233, 233);
    justify-content: flex-end;
    div{
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      width: 100%;
      justify-content:flex-end;
      p{
        width: 115px;
       line-height: 2;
       text-align: right;
      }
      .SumBoxNo{
        width: 95px;
        font-size:map-get($map: $fontsizes, $key: h4);
        text-align: left;
      }
      .SumBoxNoex{
        width: 95px;
        font-size:map-get($map: $fontsizes, $key: h4);
        color: map-get($color, $key: danger);
        text-align: left;
      }
    }
  }  

  .ShopBtmBox {
      width: 100%;
      display: flex;
      justify-content: flex-end;
      align-items: end;
      padding: 30px 0;
      .btn_s{
        line-height: 36px;
        border: 1px solid #333;
      }
      .btn_s:last-child {
        line-height: 36px;
        margin-left: 10px;
        background-color: map-get($color, danger);
        text-align: center;
        cursor: pointer;
      }
    }
}
@media screen and (max-width: 414px){
    .ShopWrap{
      .ShopProBOX .ShopProCardBox .ShopProCardTitle{

        justify-content: space-between;
        padding: 10px 5px;
        .proName{
          display: none;
        }
      }
      .ShopSpeedBox .course{
        justify-content: space-around;
      }
      .ShopSumBox{
        width: 100%;

        div{
          // display: block;
          justify-content: flex-start;
          text-align: left;
          gap: 0;
          p{
            text-align: left;
            padding-left: 1rem;
          }
          .SumBoxNo,.SumBoxNoex{
            margin-left: 0rem;
          }
        }

      }
      .ShopBtmBox {
        width: 100%;
        display: block;
        .btn_s{
          width: 100%;
          line-height: 36px;
          border: 1px solid #333;
        }
        .btn_s:last-child {
          margin: 1rem 0;
        }
      }
    }
    
  
  }
</style>
