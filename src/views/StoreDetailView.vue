<template>
    <div class="DetailWrap" >
      <div class="DetailBox">
        <div class="DetailPicBox">
            <div class="DetailMainPic"><img :src="selectedImage" alt=""></div>
            <div class="DetailPic"  @click="selectImage(item.src)">
              <img v-if="foundObject.prod_img1" :src="foundObject.prod_img1" alt="">
              <img v-if="foundObject.prod_img2" :src="foundObject.prod_img1" alt="">
              <img v-if="foundObject.prod_img3" :src="foundObject.prod_img1" alt="">
              <img v-if="foundObject.prod_img4" :src="foundObject.prod_img1" alt="">
            </div>
        </div>
        <div class="DetailDigBox">
            <h2 class="Digtitle">{{ foundObject.pord_name }}</h2>
            <div class="DigPrice">NT.{{ foundObject.pord_price }}</div>
            <div class="DigDes">{{ foundObject.pord_bdes }}</div>
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
            <div class="DigInStore"  @click="addToCart(foundObject)">加入購物車</div>
            <div class="DigSDES">
                商品訊息:
                {{ foundObject.pord_bdes2 }}
            </div>
        </div>
      </div>
      <div class="OtherDetailBox">
        <div class="OtherDetailTitle">
          <p>你可能會喜歡</p>
        </div>
        <div class="OtherDetailCardbox">
          <router-link v-for="product in randomProducts" :key="product.pord_id" :to="'/storeDetail/' + product.pord_id" class="OtherDetailCard" @click="generateRandomProducts">
            <div class="DetailCardImg">
              <img :src="product.prod_img1" alt="">
            </div>
            <div class="DetailCardDes">
              <h4 class="CardDesTitle">{{ product.pord_name }}</h4>
              <p class="CardDesPrice">NT${{ product.pord_price }}</p>
            </div>
          </router-link>
        </div>  
      </div>
    </div>
</template>

<script>
import ProTest from "@/testdata/ProTest.json"
export default {
  data() {
    return {
      foundObject:"",
      randomProducts: [], 
      selectedImage: 'https://img.shoplineapp.com/media/image_clips/5f7ecf347257270029e5c2dc/original.jpg?1602146100', 
      count: 1,
      value: 0,
    };
  },

  methods: {
    //產生隨機卡片
    generateRandomProducts() {
      const currentProductId = this.foundObject.pord_id;
      const filteredProducts = ProTest.filter(item => item.pord_id !== currentProductId);
      const shuffled = filteredProducts.slice().sort(() => 0.5 - Math.random());
      this.randomProducts = shuffled.slice(0, 4);//切出四張
    },
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
    console.log('addToCart called with product:', product);
  console.log('count:', this.count);
    this.$store.dispatch('addToCart', { product, count: this.count });
    alert("已加入購物車");
  },
  },
  mounted() {
    const idToFind = this.$route.params.id;
    this.foundObject = ProTest.find(item => item.pord_id === idToFind);
    //隨機
    this.generateRandomProducts();
  },
  watch: {
    // 觀察路徑的變化更改數據 因為mounted只能一次  所以用 watch
    $route(to, from) {
      const idToFind = to.params.id;
      this.foundObject = ProTest.find((item) => item.pord_id === idToFind);
      //更新後 在更新一次隨機清單
      this.generateRandomProducts();
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
@media screen and (max-width: 414px){
  .DetailWrap{
  max-width: 414px;
  padding: 2.5rem 1.5rem;
  margin: auto;
  width: 100%;
  .DetailBox{
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    .DetailPicBox{
    display: flex;
    flex-wrap: wrap;
     width: 100%;
     margin: 0;
     .DetailMainPic{
        height:400PX;
        width:100%;
        img{
            width: 100%;
        }
     }
     .DetailPic{
        cursor: pointer;
        margin: 0;
        width: 25%;
        img{
            height: 100%;
            width: 100%;
        }
     }
    }
    .DetailDigBox{
        margin: 30px 10px;
        text-align: center;
        display: flex;
        flex-wrap: wrap;
        width: 100%;
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
        margin: 20px 0px;
        width: 50%;
        font-size:map-get($map: $fontsizes, $key: h3);
        display: flex;
        justify-content: center;
        align-items: center;
        button{
            height: 20px;
            width: 20px;
            margin:20px 10px;
            font-size:map-get($map: $fontsizes, $key: p);
            border-radius: 50%;
        }
     }
     .DigLikeBox{
        display: flex;
        justify-content: end;
        align-items: center;
        width: 50%;
        font-size:map-get($map: $fontsizes, $key: h4)
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
      overflow: hidden;
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
        display: flex;
      flex-wrap: nowrap; 
      overflow-x: auto; 
      width: 100%; 
      margin: auto;
      scroll-behavior: smooth; /* 增加滑動效果 */
      -webkit-overflow-scrolling: touch; /* ios滑動效果 */
      scroll-snap-type: x mandatory; 
      gap: 10px; 
        .OtherDetailCard{
          flex: 0 0 auto; 
      width: 100%; 
      box-sizing: border-box; 
      padding: 10px;
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
}
</style>  

