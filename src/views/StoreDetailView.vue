<template>
  <div class="DetailWrap">
    <div class="DetailBox">
      <div class="DetailPicBox">
        <div class="DetailMainPic">
          <img  :src=$imgUrl(selectedImage) alt="">
          <div class="DigLikeBox" @click="addToCollect">
            <i class="fa-regular fa-heart" style="cursor: pointer;"></i>
          </div>
        </div>
        <div class="DetailPic">
          <img @click="selectImage(foundObject.prod_img1)" :src=$imgUrl(foundObject.prod_img1)
            alt="">
          <img @click="selectImage(foundObject.prod_img2)" :src=$imgUrl(foundObject.prod_img2)
            alt="">
          <img @click="selectImage(foundObject.prod_img3)" :src=$imgUrl(foundObject.prod_img3)
            alt="">
          <img @click="selectImage(foundObject.prod_img4)" :src=$imgUrl(foundObject.prod_img4)
            alt="">
        </div>
      </div>
      <div class="DetailDigBox">
        <div class="top">
          <h2 class="Digtitle">{{ foundObject.prod_name }}</h2>
          <div class="DigPrice">NT.{{ foundObject.prod_price }}</div>
          <div class="DigDes">{{ foundObject.prod_des1 }}</div>
          <div class="DigCountBox">
            數量
            <button @click="decrementCount">-</button>
            {{ count }}
            <button @click="incrementCount">+</button>
          </div>
          <div class="DigInStore" @click="addToCart(foundObject)">加入購物車</div>
        </div>
        <div class="DigSDES">
          商品訊息:
          {{ foundObject.prod_des2 }}
        </div>
      </div>
    </div>
    <div class="OtherDetailBox">
      <div class="OtherDetailTitle">
        <h3>你可能會喜歡</h3>
      </div>
      <div class="OtherDetailCardbox">
        <router-link v-for="product in randomProducts" :key="product.prod_id" :to="'/storeDetail/' + product.prod_id"
          class="OtherDetailCard">
          <div class="DetailCardImg">
            <img  :src=$imgUrl(product.prod_img1) alt="">
          </div>
          <div class="DetailCardDes">
            <h4 class="CardDesTitle">{{ product.prod_name }}</h4>
            <p class="CardDesPrice">NT${{ product.prod_price }}</p>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
// import ProTest from "@/testdata/ProTest.json"
import axios from 'axios';
export default {
  data() {
    return {
      foundObject: "",
      randomProducts: [],
      count: 1,
      value: 0,
      selectedImage: "",
      allProducts: [],
      // member: this.$store.state.memInfo
    };
  },

  methods: {
    //產生隨機卡片
    generateRandomProducts() {
      const currentProductId = this.foundObject.prod_id;
      const filteredProducts = this.allProducts.filter(item => item.prod_id !== currentProductId);
      const shuffled = filteredProducts.slice().sort(() => 0.5 - Math.random());
      this.randomProducts = shuffled.slice(0, 4);
    },
    decrementCount() {
      if (this.count > 1) {
        this.count -= 1;
      }
    },
    incrementCount() {
      this.count += 1;
    },
    addToCart(product) {
      console.log('addToCart called with product:', product);
      console.log('count:', this.count);
      this.$store.dispatch('addToCart', { ...product, count: this.count });
      alert("已加入購物車");
      this.count = 1;
    },
    selectImage(imageSrc) {
      this.selectedImage = imageSrc;
    },
    addToCollect() {
      // console.log(111);
      let user = localStorage.getItem('user')
      let userinfo = JSON.parse(user)
      console.log(userinfo);

      if (!user) {
        alert('請先登入')
        this.$router.push('/login')
      } else {
        // if(){
        // }
        const formData = new FormData();
        formData.append("mem_id", userinfo.mem_id);
        formData.append("prod_id", this.foundObject.prod_id);

        fetch(this.$apiUrl('addToCollect.php'), {
          method: 'post',
          body: formData
        })
          .then(res => res.json())
          .then((res) => {
            if (!res.error) {
              alert(res.msg);
              // this.menu()
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    }
  },
  mounted() {
    const idToFind = this.$route.params.id;
    axios.get(this.$apiUrl('ProductM.php'))
      .then((response) => {
        this.allProducts = response.data;
        this.foundObject = this.allProducts.find(item => item.prod_id === idToFind);
        this.selectedImage = this.foundObject.prod_img1;
        this.generateRandomProducts();
      })
      .catch((error) => {
        console.error('傳輸數據失敗：', error);
      });
  },
  watch: {
    // 觀察路徑的變化更改數據 因為mounted只能一次  所以用 watch
    $route(to, from) {
      const idToFind = to.params.id;
      this.foundObject = this.allProducts.find((item) => item.prod_id === idToFind);
      this.selectedImage = this.foundObject.prod_img1;
      //更新後 再更新一次隨機清單
      this.generateRandomProducts();
    },
  },
};
</script>

<style lang="scss">
.DetailWrap {
  max-width: 1200px;
  padding: 2.5rem 1.5rem;
  margin: auto;
  width: 100%;

  .DetailBox {
    display: flex;
    width: 100%;
    gap: 3rem;

    .DetailPicBox {
      display: flex;
      flex-wrap: wrap;
      width: 50%;

      .DetailMainPic {
        position: relative;
        height: 500PX;
        width: 100%;

        img {
          width: 100%;
          height: 500px;
        }

        .DigLikeBox {
          position: absolute;
          font-size: 36px;
          bottom: 1rem;
          right: 1rem;
          color: #eee;
        }
      }

      .DetailPic {
        cursor: pointer;
        margin: 20px 0px;
        width: 20%;
        display: flex;

        img {
          margin: 0 10px 0 0;
          height: 100%;
          width: 100%;
        }
      }
    }

    .DetailDigBox {
      // display: flex;
      // flex-wrap: wrap;
      width: 50%;

      // gap: 2rem;
      .top {
        display: flex;
        flex-direction: column;
        height: 500px;
        justify-content: space-between;

        .Digtitle {
          margin: 0 auto;
          width: 100%;
          border-bottom: 2px solid black;
          font-size: map-get($map: $fontsizes, $key: h2);
        }

        .DigPrice {
          width: 100%;
          font-size: map-get($map: $fontsizes, $key: h3);
          color: red;
          margin: 20px 0 20px 0;
        }

        .DigDes {
          width: 100%;
          font-size: map-get($map: $fontsizes, $key: p);
          line-height: 1.8rem;
          // margin-bottom: 20px;
        }

        .DigCountBox {
          width: 50%;
          font-size: 21px;
          display: flex;
          align-items: center;

          button {
            height: 30px;
            width: 30px;
            margin: 30px;
            font-size: map-get($map: $fontsizes, $key: p);
            border-radius: 50%;
          }
        }

        .DigInStore {
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: map-get($map: $fontsizes, $key: h3);
          width: 100%;
          border-radius: $border-radius;
          height: 50px;
          color: white;
          background-color: rgb(236, 85, 112);
          cursor: pointer;
        }
      }

      .DigSDES {
        width: 100%;
        line-height: 2;
        margin-top: 20px;
      }
    }

  }

  .OtherDetailBox {
    margin-top: 2rem;
    width: 100%;

    .OtherDetailTitle {
      text-align: center;
      letter-spacing: 5px;
      padding-bottom: 25px;
      border-bottom: 3px solid black;
    }

    .OtherDetailCardbox {
      width: 100%;
      display: flex;
      gap: 1rem;
      margin: 1rem auto;

      .OtherDetailCard {
        border: #eee 5px solid;
        padding: 10px;
        width: 25%;

        .DetailCardImg {
          width: 100%;
          height: 240px;

          img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }

      }

      .DetailCardDes {
        width: 100%;

        .CardDesTitle {
          margin-top: .5rem;
          font-size: map-get($map: $fontsizes, $key: h4);
        }
      }
    }
  }
}

@media screen and (max-width: 414px) {
  .DetailWrap {
    width: 90%;
    padding: 0;
    margin: auto;

    .DetailBox {
      display: block;
      width: 100%;

      .DetailPicBox {
        display: flex;
        gap: .5rem;
        flex-wrap: wrap;
        width: 100%;
        margin: 0;

        .DetailMainPic {
          height: 400PX;
          width: 100%;

          img {
            width: 100%;
            height: 400PX;
          }
        }

        .DetailPicBox {
          width: 100%;

          .DetailPic {
            width: 25%;
            cursor: pointer;
            height: 100px;

            img {
              margin: 0;
              padding: 0;
              height: 100px;
              width: 100%;
            }
          }
        }
      }

      .DetailDigBox {
        margin: 30px auto;
        display: block;
        width: 100%;
        text-align: center;

        .top {
          height: 355px;
          display: block;

          .Digtitle {
            margin: 2rem auto;
          }

          .DigPrice {
            margin-bottom: 2rem;
          }

          .DigDes {
            margin-bottom: 20px;
          }

          .DigCountBox {
            margin: 20px auto;
            inset: 0;
            width: 65%;
            font-size: map-get($map: $fontsizes, $key: h3);
            display: flex;
            justify-content: space-between;
            align-items: center;

            button {
              height: 35px;
              width: 35px;
              margin: 20px 10px;
              font-size: map-get($map: $fontsizes, $key: h3);
              border-radius: 50%;
            }
          }
        }

        .DigDes {
          margin: 0 0 20px 0;
        }
      }

    }

    .OtherDetailBox {
      overflow-x: scroll;
      scroll-behavior: smooth;
      /* 增加滑動效果 */
      -webkit-overflow-scrolling: touch;
      /* ios滑動效果 */
      scroll-snap-type: x mandatory;
      width: 100%;

      .OtherDetailTitle {
        text-align: center;
        letter-spacing: 5px;
        padding-bottom: 25px;
        border-bottom: 3px solid black;

        p {
          font-size: map-get($map: $fontsizes, $key: h3);
        }
      }

      .OtherDetailCardbox {
        display: flex;
        width: 80%;
        margin: 2rem auto;
        gap: 10px;

        .OtherDetailCard {
          flex: 0 0 auto;
          width: 100%;
          box-sizing: border-box;
          padding: 10px;

          .DetailCardImg {
            width: 100%;

            img {
              width: 100%;
            }
          }
        }
      }
    }
  }
}
</style>  

