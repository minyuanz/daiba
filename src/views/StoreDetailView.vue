<template>
    <div class="DetailWrap" >
      <div class="DetailBox">
        <div class="DetailPicBox">
            <div class="DetailMainPic"><img :src="selectedImage" alt=""></div>
            <div class="DetailPic" v-for="(item, index) in images" :key="index" @click="selectImage(item.src)">
            <img :src="item.src" alt="">
            </div>
            <!-- <div class="DetailPic"><img  src="https://img.shoplineapp.com/media/image_clips/5f7ecf347257270029e5c2dc/original.jpg?1602146100" alt=""></div>
            <div class="DetailPic"><img  src="https://cc.tvbs.com.tw/img/program/upload/2023/02/08/20230208173312-e7d780c5.jpg" alt=""  ></div>
            <div class="DetailPic"><img src="https://i2.wp.com/gwan.tw/wp-content/uploads/2022/10/20221020004311_53.jpg" alt="" ></div>
            <div class="DetailPic"><img class="DetailPic" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlsDygW5l6-urgSirZ28w1yJgNOy7sF4VJqQ&usqp=CAU" alt="" ></div> 
            -->
        </div>
        <div class="DetailDigBox">
            <h2 class="Digtitle">阿罵復古袋子</h2>
            <div class="DigPrice">NT.200</div>
            <div class="DigDes">說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明</div>
            <div class="DigCountBox">
                數量
                <button @click="decrementCount">-</button>
                {{ count }}
                <button  @click="incrementCount">+</button>  
            </div>
            <div class="DigLikeBox">
                <i class="fa-regular fa-heart" style="cursor: pointer;"></i>
                加入收藏
            </div>
            <div class="DigInStore">加入購物車</div>
            <div class="DigSDES">
                商品訊息:
                <P>尺寸:</P>
                <P>材質:</P>
                <P>產地:</P>
            </div>
        </div>
      </div>
      <div class="OtherDetailBox">
        <div class="OtherDetailTitle">
          <p>你可能會喜歡</p>
        </div>
        <div class="OtherDetailCardbox">
          <div v-for="(item) in 4" class="OtherDetailCard">
            <div class="DetailCardImg">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlsDygW5l6-urgSirZ28w1yJgNOy7sF4VJqQ&usqp=CAU" alt="">
            </div>
            <div class="DetailCardDes">
              <h4 class="CardDesTitle">謝謝明信片</h4>
              <p class="CardDesPrice">NT$150</p>
            </div>
          </div>
        </div>  
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      selectedImage: 'https://img.shoplineapp.com/media/image_clips/5f7ecf347257270029e5c2dc/original.jpg?1602146100', 
      images: [
        { src: 'https://img.shoplineapp.com/media/image_clips/5f7ecf347257270029e5c2dc/original.jpg?1602146100' },
        { src: 'https://cc.tvbs.com.tw/img/program/upload/2023/02/08/20230208173312-e7d780c5.jpg' },
        { src: 'https://i2.wp.com/gwan.tw/wp-content/uploads/2022/10/20221020004311_53.jpg' },
        { src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlsDygW5l6-urgSirZ28w1yJgNOy7sF4VJqQ&usqp=CAU' },
      ],
      count: 1,
      value: 0,
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
    selectImage(imageSrc) {
      this.selectedImage = imageSrc;
    },
    addToCart(product) {
      this.$store.dispatch('addToCart', product);
    },
  },
};
</script>

<style lang="scss">
.DetailWrap{
  max-width: 1200px;
  padding: 2.5rem 1.5rem;
  margin: auto;
  width: 100%;
  .DetailBox{
    display: flex;
    width: 100%;
    .DetailPicBox{
    display: flex;
    flex-wrap: wrap;
     width: 50%;
     margin: 5%;
     .DetailMainPic{
        height:500PX;
        width:100%;
        img{
            width: 100%;
        }
     }
     .DetailPic{
        cursor: pointer;
        margin: 5%;
        width: 15%;
        img{
            height: 100%;
            width: 100%;
        }
     }
    }
    .DetailDigBox{
        display: flex;
        flex-wrap: wrap;
        width: 50%;
     .Digtitle{
        margin: auto;
        width: 100%;
        border-bottom: 2px solid black;
        font-size:map-get($map: $fontsizes, $key: h2);
     }
     .DigPrice{
        width: 100%;
        font-size:map-get($map: $fontsizes, $key: h3);
        color: red;
        margin: 20px 0 20px 0;
     }
     .DigDes{
        width: 100%;
        font-size:map-get($map: $fontsizes, $key: p);
        margin-bottom: 20px;
     }
     .DigCountBox{
        width: 50%;
        font-size:map-get($map: $fontsizes, $key: p);
        display: flex;
        justify-content: center;
        align-items: center;
        button{
            height: 30px;
            width: 30px;
            margin:30px;
            font-size:map-get($map: $fontsizes, $key: p);
            border-radius: 50%;
        }
     }
     .DigLikeBox{
        display: flex;
        justify-content: end;
        align-items: center;
        width: 50%;
     }
     .DigInStore{
        display: flex;
        align-items: center;
        justify-content: center;
        font-size:map-get($map: $fontsizes, $key: h3);
        width: 100%;
        border-radius: $border-radius;
        height: 50px;
        color: white;
        background-color: rgb(236, 85, 112);
        cursor: pointer;
     }
     .DigSDES{
        width: 100%;
        line-height: 2;
     }
    }
    
  }
  .OtherDetailBox{
      width: 100%;
      .OtherDetailTitle{
        text-align: center;
        letter-spacing: 5px;
        padding-bottom: 25px;
        border-bottom: 3px solid black;
        p{
          font-size:map-get($map: $fontsizes, $key: h3);
        }
      }
      .OtherDetailCardbox{
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        margin: auto;
        .OtherDetailCard{
          padding: 10px;
          width: 25%;
          .DetailCardImg{
            width: 100%;
            img{
              width: 100%;
            }
          }

        }
        .DetailCardDes{
          width: 100%;
          .CardDesTitle{
            width: 50%;
            font-size:map-get($map: $fontsizes, $key: h4);
          }
          .CardDesPrice{
            width: 50%;
          }
        }
      }
    }
}

</style>  

