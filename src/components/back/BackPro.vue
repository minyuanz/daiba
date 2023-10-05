<template>
  <div class="BackPro" v-if="addToggle">
    <div class="ProSearch">
      商品編號查詢:
      <input type="text" />
      <button class="ProSearchBtn">查詢</button>
    </div>
    <div class="ProTitle">
      <p>商品編號</p>
      <p>商品名稱</p>
      <p>金額</p>
      <p>編輯</p>
      <p>上架/下架</p>
    </div>
    <div class="ProInfro" v-for="product in products" :key="product.prod_id">
      <p>{{ product.prod_id }}</p>
      <p>{{ product.prod_name }}</p>
      <p>{{ product.prod_price }}</p>
      <div class="edit">
        <i class="fa-solid fa-pen-to-square"></i>
      </div>
      <div class="upcheck">
        <label class="ios-switch">
          <input
            type="checkbox"
            :checked="product.prod_status === '1'"
            @change="toggleProductStatus(product)"
          />
          <span
            class="slider"
            :style="{
              backgroundColor:
                product.prod_status === '1' ? '#4CAF50' : '#565656',
            }"
          ></span>
        </label>
      </div>
    </div>
    <div class="addSta">
      <button @click="addToggle = !addToggle">新增商品</button>
    </div>
  </div>
  <div class="proAdd" v-else>
    <div class="proInfo">
      <p>新增商品資訊</p>
      <div class="name">
        <label>商品名稱：</label>
        <input type="text" />
      </div>
      <div class="price">
        <label for="">商品價格：</label>
        <input type="text" />
      </div>
    </div>
    <div class="proTag">
      <p>新增商品標籤</p>
      <label for="">商品分類：</label>
      <select name="" id="">
        <option value="food">food</option>
      </select>
      <label for="">捷運站：</label>
      <select name="" id="">
        <option value="BL">BL</option>
      </select>
    </div>
    <div class="proPic">
      <p class="title">商品照</p>
      <p class="title">(第一張為商品版頭)</p>
      <div class="picArea">
        <div class="uploadPic" v-for="(pic, index) in pics" :key="index">
          <div class="pic">
            <p>＋</p>
            <input type="file" @change="handleFileChange($event, index)" />
            <img :src="pic.imageURL" v-show="pic.fix" />
          </div>
        </div>
        <!-- <button>+</button> -->
      </div>
    </div>
    <div class="proCtx">
      <label for="">商品描述</label>
      <textarea class="custom-input"></textarea>
      <!-- <input type="text"> -->
    </div>
    <div class="proMore">
      <label for="">商品資訊</label>
      <textarea class="custom-input"></textarea>
      <!-- <input type="text"> -->
    </div>
    <div class="btn">
      <button @click="addToggle = !addToggle">取消新增</button>
      <button @click="addToggle = !addToggle">確認新增</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
// import BackProTest from "@/testdata/BackProTest.json"
export default {
  data() {
    return {
      products: [],
      // item: BackProTest,
      isSwitchOn: false,
      // items: BackProTest.map((item) => ({ ...item, isChecked: false, })),
      addToggle: true,
      pics: [
        {
          imageURL: null,
          fix: false,
        },
        {
          imageURL: null,
          fix: false,
        },
        {
          imageURL: null,
          fix: false,
        },
        {
          imageURL: null,
          fix: false,
        },
      ],
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    handleFileChange(e, index) {
      const files = e.target.files; // 獲取所有所選文件

      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = () => {
          // 當讀取完成時觸發
          this.pics[index].imageURL = reader.result; // 將 Data URL 賦值給圖片的 src
        };
        // this.pics[index].imageURL = true;
        //
        if (file) {
          reader.readAsDataURL(file); // 讀取文件內容，以 Data URL 形式
        }
      }
      this.pics[index].fix = true;
    },
    fetchData() {
      axios
        .get("http://localhost/dai/public/phps/ProductM.php")
        .then((response) => {
          this.products = response.data; // 更新數據到 products
        })
        .catch((error) => {
          console.error("數據傳輸失敗：", error);
        });
    },
    toggleProductStatus(product) {
      product.prod_status = product.prod_status === "1" ? "0" : "1";
      axios
        .post("http://localhost/dai/public/phps/ContralProductsich.php", {
          prod_id: product.prod_id,
          prod_status: product.prod_status,
        })
        .then((response) => {
          // 檢查
          if (response.data.success) {
            // console.log('商品狀態已更新');
            alert("商品狀態更新成功");
          } else {
            // console.error('商品狀態更新失敗');
            alert("商品狀態更新失敗");
            // 如果失敗回歸原本狀態
            product.prod_status = product.prod_status === "1" ? "0" : "1";
          }
        })
        .catch((error) => {
          console.error("更新失敗：", error);
          alert("更新失敗");
          // 如果失敗回歸原本狀態
          product.prod_status = product.prod_status === "1" ? "0" : "1";
        });
    },
  },
};
</script>

<style lang="scss">
.BackPro {
  margin-top: 3rem;
  border: 1px solid #aaa;
  background-color: #fff;
  // border-radius: 20px;
  width: 900px;
  padding: 50px;
  margin-top: 3rem;

  .ProSearch {
    padding: 10px;

    .ProSearchBtn {
      width: 80px;
      height: 28px;
      margin-left: 10px;
    }
  }

  .ProTitle {
    display: flex;
    justify-content: space-evenly;
    background-color: #ddd;
    padding: 5px 0;

    p {
      width: 100%;
      text-align: center;
    }
  }

  .ProInfro {
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

    .ios-switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 30px;
      background-color: #ccc;
      border-radius: 15px;
    }

    .ios-switch input {
      display: none;
    }

    .ios-switch .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #565656;
      border-radius: 15px;
      transition: 0.4s;
    }

    .ios-switch input:checked + .slider {
      background-color: #4caf50;
    }

    .ios-switch .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 2px;
      bottom: 2px;
      background-color: white;
      border-radius: 50%;
      transition: 0.4s;
    }

    .ios-switch input:checked + .slider:before {
      transform: translateX(30px);
    }
  }

  .addSta {
    margin-top: 50px;
    text-align: center;

    button {
      padding: 10px 30px;
    }
  }
}

.proAdd {
  border: 1px solid #aaa;
  background-color: #fff;
  width: 900px;
  height: 900px;
  overflow: auto;
  padding: 50px;
  margin-top: 3rem;

  .proInfo {
    // border: 1px solid red;
    p {
      text-align: center;
      background-color: #ddd;
      font-size: 24px;
      font-weight: bold;
      padding: 5px 0;
    }

    .name,
    .price {
      margin: 10px 0;

      label {
        // font-size: 24px;
        // font-weight: bold;
      }
    }
  }

  .proTag {
    margin-top: 30px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    align-items: center;

    p {
      text-align: center;
      background-color: #ddd;
      font-size: 24px;
      font-weight: bold;
      padding: 5px 0;
      width: 100%;
      margin-bottom: 30px;
    }

    label {
      // font-size: 24px;
      // font-weight: bold;
    }

    select {
      width: 200px;
      // font-size: 24px;
      // font-weight: bold;
    }
  }

  .proPic {
    margin-top: 30px;

    .title {
      text-align: center;
      background-color: #ddd;
      font-size: 24px;
      font-weight: bold;
      padding: 5px 0;
      width: 100%;
    }

    .picArea {
      border: 1px solid #aaa;
      display: flex;
      align-items: center;
      // justify-content: center;
      flex-wrap: wrap;

      .uploadPic {
        // border: 1px solid red; text-align: center;
        text-align: center;
        display: flex;
        flex-direction: column;
        // margin-top: 10px;
        margin: 10px 20px;

        .pic {
          border: 1px dashed #aaa;
          // margin-top: 30px;
          position: relative;
          width: 100px;

          p {
            font-size: 24px;
            line-height: 100px;
            // width: 100px;
          }

          input {
            // border: 1px solid red;
            position: absolute;
            inset: 0;
            // width: 100px;
            width: 100%;
            height: 100%;
            opacity: 0;
            z-index: 9;
          }

          img {
            position: absolute;
            inset: 0;
            // width: 100px;
            width: 100%;
            height: 100%;
          }
        }
      }

      button {
        width: 20px;
        height: 20px;
        margin-left: 55px;
      }
    }
  }

  .proCtx {
    margin-top: 30px;

    label {
      display: block;
      text-align: center;
      background-color: #ddd;
      font-size: 24px;
      font-weight: bold;
      padding: 5px 0;
    }

    .custom-input {
      border: 1px solid #333;
      // border-top:1px solid transparent;
      height: 200px;
      width: 100%;
      padding: 10px;
      // line-height: 200px;
    }
  }

  .proMore {
    margin-top: 30px;

    label {
      display: block;
      text-align: center;
      background-color: #ddd;
      font-size: 24px;
      font-weight: bold;
      padding: 5px 0;
    }

    .custom-input {
      border: 1px solid #333;
      // border-top:1px solid transparent;
      height: 200px;
      width: 100%;
      padding: 10px;
      // line-height: 200px;
    }
  }

  .btn {
    // border: 1px solid red;
    margin-top: 30px;
    text-align: right;

    button {
      margin-left: 20px;
      padding: 10px 20px;
    }
  }
}
</style>
