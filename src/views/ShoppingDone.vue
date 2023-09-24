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
        <i class="fa-solid fa-circle-check icon-size"></i>
        <p>購買完成</p>
      </div>
      <div class="CartBtmBox">
        <div class="CartBtnBack" @click="gotoShopping">返回商店</div>
      </div>
    </div>
  </template>
  
  
  <script>
  export default {
    data() {
    },
    methods: {

      incrementCount() {
        this.count += 1;
      },
      gotoShopping(){
      this.$router.push("/store"); 
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

    .CartProBOX{
      border: 1px solid rgb(210, 210, 210);
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: auto;
      .icon-size {
        font-size:map-get($map: $fontsizes, $key: h1);
        color:rgb(27, 216, 49);
      }
      p{
        font-size:map-get($map: $fontsizes, $key: h1);
        padding: 60px;
      }
    }
    .CartBtmBox{
      width: 100%;
      display: flex;
      justify-content: center;
      align-items:center;
      padding: 20px;
      .CartBtnBack{
        color:rgb(27, 216, 49) ;
        text-align: center;
        cursor: pointer;
        border: 1px solid rgb(27, 216, 49);
        border-radius: $border-radius;
        font-size:map-get($map: $fontsizes, $key: h3);
        padding: 10px 40px;
      }
    }
  }
  </style>
  