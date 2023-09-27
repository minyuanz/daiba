<template>
    <div class="CartWrap">
      <div class="CartSpeedBox">
        <div class="course">
          <section>
            <h4 class="SpeedNo unwork">1</h4>
            <h4 class="SpeedText ">購 物 車</h4>
          </section>
          <div></div>
          <section>
            <h4 class="SpeedNo unwork">2</h4>
            <h4 class="SpeedText">付款運送</h4>
          </section>
          <div></div>
          <section>
            <h4 class="SpeedNo success">3</h4>
            <h4 class="SpeedText">訂單完成</h4>
          </section>
        </div>
      </div>
      <div class="Doneprobox">
        <i class="fa-solid fa-circle-check icon-size"></i>
        <p>購買完成</p>
      </div>
      <div class="DoneBtnBox">
        <div class="btn_m" @click="gotoShopping">返回商店</div>
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

    .Doneprobox{
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
    .DoneBtnBox{
      width: 100%;
      display: flex;
      justify-content: center;
      align-items:center;
      padding: 20px;
      .btn_m{
        color:map-get($color , success) ;
        line-height: 36px;
        border: 1px solid map-get($color , success);
      }
      .btn_m:hover{
        color:#fff;
        line-height: 36px;
        background-color:map-get($color , success);
      }
    }
  }
  </style>
  