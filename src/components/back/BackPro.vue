<template>
  <div class="BackPro" v-if="addToggle" v-show="!editMode">
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
        <button @click="startEditMode(product)">編輯</button>
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
    <form @submit.prevent="addNewProduct" enctype="multipart/form-data">
      <div class="proInfo">
        <p>新增商品資訊</p>
        <div class="name">
          <label>商品名稱：</label>
          <input type="text" id="prodName" v-model="newProduct.prod_name" />
        </div>
        <div class="price">
          <label for="">商品價格：</label>
          <input type="text" id="prodPrice" v-model="newProduct.prod_price" />
        </div>
      </div>
      <div class="proTag">
        <p>新增商品標籤</p>
        <label for="">商品分類：</label>
        <select id="prodType" v-model="newProduct.prod_type">
          <option value="food">美食</option>
          <option value="viewpoint">景點</option>
          <option value="stay">住宿</option>
        </select>
        <label for="">捷運站：</label>
        <select id="staId" v-model="newProduct.sta_id">
          <option value="BL">BL</option>
        </select>
      </div>
      <div class="proPic">
        <p class="title">商品照</p>
        <p class="title">(第一張為商品版頭)</p>
        <div class="picArea">
          <div class="uploadPic">
            <div class="pic">
              <p>＋</p>
              <input
                type="file"
                name="image1"
                @change="handleFileChange($event, 0, 'add')"
              />
              <img :src="pics[0].imageURL" v-show="pics[0].fix" />
            </div>
          </div>
          <div class="uploadPic">
            <div class="pic">
              <p>＋</p>
              <input
                type="file"
                name="image2"
                @change="handleFileChange($event, 1, 'add')"
              />
              <img :src="pics[1].imageURL" v-show="pics[1].fix" />
            </div>
          </div>
          <div class="uploadPic">
            <div class="pic">
              <p>＋</p>
              <input
                type="file"
                name="image3"
                @change="handleFileChange($event, 2, 'add')"
              />
              <img :src="pics[2].imageURL" v-show="pics[2].fix" />
            </div>
          </div>
          <div class="uploadPic">
            <div class="pic">
              <p>＋</p>
              <input
                type="file"
                name="image4"
                @change="handleFileChange($event, 3, 'add')"
              />
              <img :src="pics[3].imageURL" v-show="pics[3].fix" />
            </div>
          </div>
          <!-- <button>+</button> -->
        </div>
      </div>
      <div class="proCtx">
        <label for="">商品描述</label>
        <textarea
          class="custom-input"
          v-model="newProduct.prod_des1"
        ></textarea>
        <!-- <input type="text"> -->
      </div>
      <div class="proMore">
        <label for="">商品資訊</label>
        <textarea
          class="custom-input"
          v-model="newProduct.prod_des2"
        ></textarea>
        <!-- <input type="text"> -->
      </div>
      <div class="btn">
        <button @click="addToggle = !addToggle">取消新增</button>
        <button type="submit">確認新增</button>
      </div>
    </form>
  </div>
  <div class="proAdd" v-if="editMode">
    <form @submit.prevent="updateProduct" enctype="multipart/form-data">
      <div class="proInfo">
        <p>編輯商品資訊</p>
        <div class="name">
          <label>商品名稱：</label>
          <input
            type="text"
            id="prodName"
            v-model="currentEditProduct.prod_name"
          />
        </div>
        <div class="price">
          <label for="">商品價格：</label>
          <input
            type="text"
            id="prodPrice"
            v-model="currentEditProduct.prod_price"
          />
        </div>
      </div>
      <div class="proTag">
        <p>更改商品標籤</p>
        <label for="">商品分類：</label>
        <select id="prodType" v-model="currentEditProduct.prod_type">
          <option value="Souvenir">伴手禮</option>
          <option value="memento">紀念品</option>
        </select>
        <label for="">捷運站：</label>
        <select id="staId" v-model="currentEditProduct.sta_id">
          <option value="BL">BL</option>
        </select>
      </div>
      <div class="proPic">
        <p class="title">商品照</p>
        <p class="title">(第一張為商品版頭)</p>
        <div class="picArea">
          <div class="uploadPic">
            <div class="pic">
              <p>＋</p>
              <img
                :src="
                  `${this.$store.state.imgURLp}` + currentEditProduct.prod_img1
                "
                v-if="currentEditProduct.prod_img1 !== '' ? true : false"
              />
              <input
                type="file"
                name="image1"
                @change="handleFileChange($event, 0, 'edit')"
              />
              <img
                :src="originalpics[0].imageURL"
                v-show="originalpics[0].fix"
              />
            </div>
          </div>
          <div class="uploadPic">
            <div class="pic">
              <p>＋</p>
              <img
                :src="
                  `${this.$store.state.imgURLp}` + currentEditProduct.prod_img2
                "
                v-if="currentEditProduct.prod_img2 !== '' ? true : false"
              />
              <input
                type="file"
                name="image2"
                @change="handleFileChange($event, 1, 'edit')"
              />
              <img
                :src="originalpics[1].imageURL"
                v-show="originalpics[1].fix"
              />
            </div>
          </div>
          <div class="uploadPic">
            <div class="pic">
              <p>＋</p>
              <img
                :src="
                  `${this.$store.state.imgURLp}` + currentEditProduct.prod_img3
                "
                v-if="currentEditProduct.prod_img3 !== '' ? true : false"
              />
              <input
                type="file"
                name="image3"
                @change="handleFileChange($event, 2, 'edit')"
              />
              <img
                :src="originalpics[2].imageURL"
                v-show="originalpics[2].fix"
              />
            </div>
          </div>
          <div class="uploadPic">
            <div class="pic">
              <p>＋</p>
              <img
                :src="
                  `${this.$store.state.imgURLp}` + currentEditProduct.prod_img14
                "
                v-if="currentEditProduct.prod_img4 !== '' ? true : false"
              />
              <input
                type="file"
                name="image4"
                @change="handleFileChange($event, 3, 'edit')"
              />
              <img
                :src="originalpics[3].imageURL"
                v-show="originalpics[3].fix"
              />
            </div>
          </div>
          <!-- <button>+</button> -->
        </div>
      </div>
      <div class="proCtx">
        <label for="">商品描述</label>
        <textarea
          class="custom-input"
          v-model="currentEditProduct.prod_des1"
        ></textarea>
        <!-- <input type="text"> -->
      </div>
      <div class="proMore">
        <label for="">商品資訊</label>
        <textarea
          class="custom-input"
          v-model="currentEditProduct.prod_des2"
        ></textarea>
        <!-- <input type="text"> -->
      </div>
      <div class="btn">
        <button @click="cancelEdit">取消編輯</button>
        <button type="submit">確認編輯</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      newProduct: {
        prod_name: "",
        prod_price: "",
        prod_type: "food",
        sta_id: "BL",
        prod_des1: "",
        prod_des2: "",
        prod_img1: null,
        prod_img2: null,
        prod_img3: null,
        prod_img4: null,
      },
      products: [],
      pics: [
        //新增圖片站存
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
      ],
      originalpics: [
        //編輯圖片站存
        { imageURL: null, fix: false }, //`${this.$store.state.imgURL}` + currentEditProduct.prod_img1, fix: false
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
      ],
      isSwitchOn: false,
      addToggle: true,
      editMode: false, // 編輯模式的開啟與否
      currentEditProduct: null, // 當前編輯的商品
      mode: "add",
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    startEditMode(product) {
      this.editMode = true; // 用v-shoW進入編輯模式
      this.currentEditProduct = { ...product }; // 複製數據進入編輯
    },
    updateProduct() {
      const formData = new FormData();

      formData.append("prod_id", this.currentEditProduct.prod_id);
      formData.append("prod_name", this.currentEditProduct.prod_name);
      formData.append("prod_price", this.currentEditProduct.prod_price);
      formData.append("prod_type", this.currentEditProduct.prod_type);
      formData.append("sta_id", this.currentEditProduct.sta_id);
      formData.append("prod_des1", this.currentEditProduct.prod_des1);
      formData.append("prod_des2", this.currentEditProduct.prod_des2);
      formData.append("prod_img1", this.currentEditProduct.prod_img1); // 添加圖片（如果需要的话）
      formData.append("prod_img2", this.currentEditProduct.prod_img2);
      formData.append("prod_img3", this.currentEditProduct.prod_img3);
      formData.append("prod_img4", this.currentEditProduct.prod_img4);

      axios
        .post("http://localhost/dai/public/phps/UpdateProduct.php", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.status === 200) {
            alert("商品已成功更新");
            this.editMode = false; // 退出编辑模式
            // 清空編輯圖片顯示的圖片
            this.currentEditProduct.prod_img1 = null;
            this.currentEditProduct.prod_img2 = null;
            this.currentEditProduct.prod_img3 = null;
            this.currentEditProduct.prod_img4 = null;
          } else {
            alert("商品更新失败");
          }
        })
        .catch((error) => {
          console.error("更新商品请求失败：", error);
        });
    },

    handleFileChange(e, index, mode) {
      const files = e.target.files;
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = () => {
          if (mode === "add") {
            this.pics[index].imageURL = reader.result;
          } else if (mode === "edit") {
            this.originalpics[index].imageURL = reader.result; // 使用 originalpics 數據
          }
        };

        if (file) {
          reader.readAsDataURL(file);
          if (mode === "add") {
            this.newProduct[`prod_img${index + 1}`] = file;
          } else if (mode === "edit") {
            this.currentEditProduct[`prod_img${index + 1}`] = file;
          }
        }
      }
      if (mode === "add") {
        this.pics[index].fix = true;
      } else if (mode === "edit") {
        this.originalpics[index].fix = true; // 使用 originalpics 數據
      }
    },
    cancelEdit() {
      //取消編輯並清空圖片
      this.editMode = false;
      this.originalpics = [
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
      ];
    },
    cancelAdd() {
      //取消新增並清空圖片
      this.addToggle = true; //
      this.pics = [
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
      ];
    },
    fetchData() {
      axios
        .get("http://localhost/dai/public/phps/BackProductM.php")
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
    addNewProduct() {
      const formData = new FormData();
      formData.append("prod_name", this.newProduct.prod_name);
      formData.append("prod_price", this.newProduct.prod_price);
      formData.append("prod_type", this.newProduct.prod_type);
      formData.append("sta_id", this.newProduct.sta_id);
      formData.append("prod_des1", this.newProduct.prod_des1);
      formData.append("prod_des2", this.newProduct.prod_des2);
      formData.append("prod_img1", this.newProduct.prod_img1);
      formData.append("prod_img2", this.newProduct.prod_img2);
      formData.append("prod_img3", this.newProduct.prod_img3);
      formData.append("prod_img4", this.newProduct.prod_img4);

      axios
        .post("http://localhost/dai/public/phps/CreatProduct.php", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.status === 200) {
            //檢查http  來判別php新增與否
            alert("商品已成功新增");
            this.pics = [
              { imageURL: null, fix: false },
              { imageURL: null, fix: false },
              { imageURL: null, fix: false },
              { imageURL: null, fix: false },
            ];
            // 下面為新增成功後 清空表單
            this.newProduct = {
              prod_name: "",
              prod_price: "",
              prod_type: "food",
              sta_id: "BL",
              prod_des1: "",
              prod_des2: "",
              prod_img1: null,
              prod_img2: null,
              prod_img3: null,
              prod_img4: null,
            };
          } else {
            alert("商品新增失敗");
          }
        })
        .catch((error) => {
          console.error("新增商品請求失敗：", error);
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
  height: 900px;
  overflow-y: scroll;

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
