<template>
  <div class="ShopWrap">
    <div class="ShopSpeedBox">
      <div class="SpeedNo">
      <span class="SpeedNoF">1</span>
      <span>2</span>
      <span>3</span>
      </div>
      <div class="SpeedText">
      <div>購物車</div>
      <div>付款運送</div>
      <div>訂單完成</div>
    </div>
    </div>
    <div class="ShopProBOX">
      <div class="ShopProTitle" @click="">合計:NT:2300</div>

      <div class="ShopProCardBox">
        <div class="ShopProCardTitle">
          <div>商品資料</div>
          <div>單價</div>
          <div>數量</div>
          <div>小計</div>
        </div>
        <div v-for="card in 3" class="ShopProCardDetail">
          <div class="CardDetailImg">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlsDygW5l6-urgSirZ28w1yJgNOy7sF4VJqQ&usqp=CAU" alt="">
          </div>
          <div class="CardDetailTitle">吃的蛋糕</div>
          <div class="CardDetailPrice">NT$320</div>
          <div class="CardDetailCount">
            <p>{{ 1 }}</p>
          </div>
          <div class="CardDetailTotal">NT$320</div>
          <div class="CardDetailDelet"></div>
        </div>
      </div>
    </div>
    <div class="ShopPayBox">
      <div class="PayTItle">付款方式</div>
      <div class="PayCredit"><input  type="radio" name="Pay" value="信用卡付款"  v-model="selectedPayment">信用卡付款</div>
      <div class="PayCash"><input  type="radio" name="Pay" value="貨到付款"  v-model="selectedPayment">貨到付款</div>
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
    </div>
    <div class="ShopDelBox">
      <div class="DelTitle">運送方式</div>
      <div class="DelComent">
        <div > 收件人姓名:<input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="請輸入收件人姓名"/></div> 
        <div > 收件人電話:<input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="09XXXXXXXX"/></div> 
        <div > 收件人信箱:<input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="請輸入信箱"/></div> 
        <div > 收件人地址:<input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="清輸入地址"/></div> 
      </div>
    </div>
    <div class="ShopSumBox">
      <div class="SumCac">
        <div class="SumCacTex">
          <p>折扣後小計</p>
          <p>運費</p>
        </div>
        <div class="SumCacPrice">
          <p>NT${{250 }}</p>
          <p>NT${{250 }}</p>
        </div>
      </div>
      <div class="SumTol">
        <div class="SumCacTex">
          <p>商品金額統計</p>
        </div>
        <div class="SumCacPrice">
          <p>NT${{  }}</p>
          <p>(含運費)</p>
        </div>
      </div>
    </div>
    <div class="ShopBtmBox">
      <div class="ShopBtnBack" @click="gotoCart">上一頁</div>
      <div class="ShopBtnBackNex" @click="gotoShoppingDone">訂單確認</div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      selectedPayment: '' ,
      creditCardNumber: '',
      expirationDate: '',
      securityCode: '',
    };
  },
  methods: {
    gotoCart(){
      this.$router.push("/Cart"); 
    },
    gotoShoppingDone(){
      this.$router.push("/ShoppingDone"); 
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
    .SpeedNo{
      position: relative;
      width: 100%;
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      span{
        display: flex;
        align-items: center;
        justify-content: center;
        font-size:map-get($map: $fontsizes, $key: h3);
        text-align: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: gray;
      }
    }
    .SpeedText{
      position: relative;
      width: 100%;
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      margin: auto;
      div{
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size:map-get($map: $fontsizes, $key: h3);
        text-align: center;
      }
    }
    

  }
  .ShopProBOX{
    position: relative;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    background-color: rgb(234, 233, 233);
    width: 100%;
    .ShopProTitle{
      position: relative;
      padding: 30px;
      font-size:map-get($map: $fontsizes, $key: h3);
      text-align: center;
      &::after{
        content: ">";
        width: 30px;
        height: 30px;
        position: absolute;
        transform: rotate(90deg);
        font-weight:bold;
        font-size:map-get($map: $fontsizes, $key: h2);
        cursor: pointer;
      }
    }
    .ShopProCardBox{
      display: flex;
      flex-wrap: wrap;
      width: 100%;
      font-size:map-get($map: $fontsizes, $key: h4);
      background-color: white;
      border-bottom: 1px solid gray;
      margin: auto;
      .ShopProCardTitle{
        width: 100%;
        display: flex;
        margin: auto;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding: 10px 0;
        div{
          width: 16%;
        }
      }
      .ShopProCardDetail{
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        width: 100%;
        display: flex;
        margin: auto;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding: 10px 0;
        div{
          width: 16%;
        }
        .CardDetailImg{
          img{
            width: 100%;
            height:150px;
          }
        }
        .CardDetailTitle{}
        .CardDetailPrice{}
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
    margin: 20px 0;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    div{
      padding: 30px 10px;
    }
    .PayTItle{
      padding: 10px 20px;
      background-color: rgb(234, 233, 233); ;
    }
    label {
    display: block;
    font-weight: bold;
    input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
    }
  }
  }
  .ShopDelBox{
    margin: 20px 0;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    div{padding: 30px 10px;}
    .DelTitle{
      padding: 10px 20px;
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
  .ShopSumBox{
    padding: 50px;
    display: flex;
    flex-wrap: wrap;
    background-color: rgb(234, 233, 233);
    align-items: flex-end; 
    .SumCac{
      justify-content: flex-end;
      display: flex;
      width: 100%;
      .SumCacTex{

      }
      .SumCacPrice{
        padding-left: 20%;
      }
    }
    .SumTol{
      display: flex;
      flex-wrap: wrap;
      width: 100%;
    }
  }  
  .ShopBtmBox{
    width: 100%;
    display: flex;
    justify-content: right;
    align-items: end;
    padding: 20px;
    .ShopBtnBack{
      text-align: center;
      cursor: pointer;
      border: 1px solid red;
      border-radius: $border-radius;
      font-size:map-get($map: $fontsizes, $key: h3);
      padding: 10px 40px;
    }
    .ShopBtnBackNex{
      margin-left: 10px;
      text-align: center;
      cursor: pointer;
      background-color: rgb(236, 85, 112);
      border: 1px solid red;
      border-radius: $border-radius;
      font-size:map-get($map: $fontsizes, $key: h3);
      padding: 10px 40px;
    }
  }
}
</style>
