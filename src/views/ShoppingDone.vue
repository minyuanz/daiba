<template>
    <div class="CartWrap">
      <div class="CartSpeedBox">
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
      <div class="CartProBOX">
        購物完成介面
      </div>
      <div class="CartBtmBox">
        <div class="CartBtnBack" @click="gotoShopping">上一頁</div>
        <div class="CartBtnBackNex" @click="">訂單確認</div>
      </div>
    </div>
  </template>
  
  
  <script>
  export default {
    data() {
      return {
        count: 1,
      };
    },
    methods: {
      decrementCount() {
        if (this.count > 1) {
          this.count -= 1;
        }
      },
      incrementCount() {
        this.count += 1;
      },
      gotoShopping(){
      this.$router.push("/Shopping"); 
    },
    },
  };
  </script>
  
  
  
  <style lang="scss">
  .CartWrap{
    position: relative;
    max-width: 1200px;
    padding: 2.5rem 1.5rem;
    margin: auto;
    width: 100%;
    .CartSpeedBox{
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
    .CartBtmBox{
      width: 100%;
      display: flex;
      justify-content: right;
      align-items: end;
      padding: 20px;
      .CartBtnBack{
        text-align: center;
        cursor: pointer;
        border: 1px solid red;
        border-radius: $border-radius;
        font-size:map-get($map: $fontsizes, $key: h3);
        padding: 10px 40px;
      }
      .CartBtnBackNex{
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
  