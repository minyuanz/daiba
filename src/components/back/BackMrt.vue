<template>
  <div class="backMrt" v-if="addToggle">
    <div class="mrtSearch">
      <label for="">請選擇捷運線：</label>
      <select name="" id="">
        <option value="BL">BL</option>
        <option value="BR">BR</option>
        <option value="G">G</option>
        <option value="O">O</option>
        <option value="R">R</option>
      </select>
      <button class="btnsearch">查詢</button>
    </div>
    <div class="mrtTitle">
      <p>捷運站編號</p>
      <p>捷運站代碼1</p>
      <p>捷運站代碼2</p>
      <p>站名</p>
      <p>編輯</p>
      <p>刪除</p>
    </div>
    <div class="mrtInfo" v-for="addMrt in mrts">
      <p>{{ addMrt.sta_id }}</p>
      <p>{{ addMrt.mrt_code1 }}</p>
      <p>{{ addMrt.mrt_code2 }}</p>
      <p>{{ addMrt.sta_name }}</p>
      <div class="edit">
        <i class="fa-solid fa-pen-to-square"></i>
      </div>
      <div class="del">
        <i class="fa-solid fa-circle-xmark"></i>
      </div>
    </div>
    <div class="addSta">
      <button @click="addToggle = !addToggle">新增捷運站</button>
    </div>
  </div>
  <div class="backMrtAdd" v-else>
    <form @submit.prevent="addnewMrt" enctype="multipart/form-data">
      <p>你正在新增車站：</p>
      <div class="addInfo">
        <div class="pic">
          <!-- <img src="https://picsum.photos/200/200/?random=10" /> -->
          <!-- <button>上傳圖片</button> -->
          <input type="file" />
        </div>
        <div class="txt">
          <div>
            <label for="">位於捷運線：</label>
            <select name="" id="">
              <option value="BL">BL</option>
              <option value="BR">BR</option>
              <option value="G">G</option>
              <option value="O">O</option>
              <option value="R">R</option>
            </select>
          </div>
          <div>
            <label for="">捷運站編號：</label>
            <input type="text" v-model="newMrt.mrt_code1" />
          </div>
          <div>
            <label for="">位於捷運線：</label>
            <select name="" id="">
              <option value="noline">若無轉乘線則免填</option>
              <option value="BL">BL</option>
              <option value="BR">BR</option>
              <option value="G">G</option>
              <option value="O">O</option>
              <option value="R">R</option>
            </select>
          </div>
          <div>
            <label for="">捷運站編號：</label>
            <input
              type="text"
              placeholder="若無轉乘線則免填"
              v-model="newMrt.mrt_code2"
            />
          </div>
          <div>
            <label for="">捷運站名稱：</label>
            <input type="text" v-model="newMrt.sta_name" />
          </div>
        </div>
      </div>
      <div class="addCtx">
        <span>捷運站描述</span>
        <textarea class="custom-input"></textarea>
        <!-- <input type="text" class="custom-input"> -->
        <!-- <span class="count">0/100字</span> -->
      </div>
      <div class="btn">
        <button @click="addToggle = !addToggle">取消新增</button>
        <button @click="addNewMrt">確認新增</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import BackMrt from "@/testdata/BackMrt.json";
export default {
  data() {
    return {
      mrts: [],
      addToggle: true,
      admins: [],
      sta: BackMrt,
      newMrt: {
        sta_id: "",
        mrt_code1: "",
        mrt_code2: "",
        sta_name: "",
        mrt_id1: "",
        mrt_id2: "",
        sta_pictor: "",
        sta_describe: "",
      },
      products: [],
      pics: [{ imageURL: null, fix: false }],
      isSwitchOn: false,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    handleFileChange(e, index) {
      const files = e.target.files;
      const file = files[i];
      const reader = new FileReader();
      reader.onload = () => {
        this.pics[index].imageURL = reader.result;
      };

      if (file) {
        reader.readAsDataURL(file);
        this.newMrt[`prod_img${index + 1}`] = file;
      }

      this.pics[index].fix = true;
    },
    fetchData() {
      axios
        .get("http://localhost/dai/public/phps/mrt.php")
        .then((response) => {
          this.mrts = response.data;
        })
        .catch((error) => {
          console.error("數據傳輸失敗：", error);
        });
    },
    toggleProductStatus(product) {
      product.prod_status = product.prod_status === "1" ? "0" : "1";
      axios
        .post("http://localhost/dai/public/phps/mrt.php", {
          prod_id: product.prod_id,
          prod_status: product.prod_status,
        })
        .then((response) => {
          if (response.data.success) {
            alert("商品狀態更新成功");
          } else {
            alert("商品狀態更新失敗");
            product.prod_status = product.prod_status === "1" ? "0" : "1";
          }
        })
        .catch((error) => {
          console.error("更新失敗：", error);
          alert("更新失敗");
          product.prod_status = product.prod_status === "1" ? "0" : "1";
        });
    },
    addNewMrt() {
      const formData = new FormData();
      formData.append("sta_id ", this.newMrt.sta_id);
      formData.append("mrt_code1", this.newMrt.mrt_code1);
      formData.append("mrt_code2", this.newMrt.mrt_code2);
      formData.append("sta_name", this.newMrt.sta_name);
      formData.append("mrt_id1 ", this.newMrt.mrt_id1);
      formData.append("mrt_id2", this.newMrt.mrt_id2);
      formData.append("sta_pictor", this.newMrt.sta_pictor);
      formData.append("sta_describe	", this.newMrt.sta_describe);

      axios
        .post("http://localhost/dai/public/phps/CreatMrt.php", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.data.success) {
            alert("商品已成功新增");
            // 清空表单字段
            this.newMrt = {
              sta_id: "",
              mrt_code1: "",
              mrt_code2: "",
              sta_name: "",
              mrt_id1: "",
              mrt_id2: "",
              sta_pictor: "",
              sta_describe: "",
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
.backMrt {
  margin-top: 3rem;
  border: 1px solid #aaa;
  background-color: #fff;
  width: 900px;
  padding: 50px;

  .mrtSearch {
    // border: 1px solid red;
    margin: 10px 0;
    display: flex;
    align-items: center;

    select {
      height: 30px;
    }

    .btnsearch {
      // border: 1px solid red;
      margin: 0 10px;
      padding: 0px 30px;
      height: 30px;
    }
  }

  .mrtTitle {
    // border: 1px solid red;
    display: flex;
    justify-content: space-evenly;
    background-color: #ddd;
    padding: 5px 0;

    p {
      // border: 1px solid red;
      width: 100%;
      text-align: center;
    }
  }

  .mrtInfo {
    // border: 1px solid red;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 5px 0;
    border-bottom: 1px solid #aaa;

    div,
    p {
      // border: 1px solid red;
      width: 100%;
      text-align: center;
    }
  }

  .addSta {
    margin-top: 50px;
    text-align: center;
    // border: 1px solid red;

    button {
      padding: 10px 30px;
    }
  }
}

.backMrtAdd {
  border: 1px solid #aaa;
  background-color: #fff;
  // border-radius: 20px;
  width: 900px;
  padding: 50px;
  margin-top: 3rem;

  .addInfo {
    // border: 1px solid red;
    display: flex;
    justify-content: space-evenly;
    margin-top: 30px;

    .pic {
      display: flex;
      flex-direction: column;
      align-items: center;
      // border: 1px solid red;

      img {
        border-radius: 50%;
        width: 100%;
        vertical-align: bottom;
      }

      button {
        margin-top: 30px;
        padding: 10px 20px;
      }
    }

    .txt {
      div {
        // border: 1px solid red;
        margin: 20px 0;
        display: flex;
        align-items: center;
        input {
          width: 220px;
        }
        select {
          // border: 1px solid red;
          width: 220px;
        }
      }
    }
  }
  .addCtx {
    // border: 1px solid #333;
    margin-top: 30px;
    span {
      display: block;
      text-align: center;
      background-color: #ddd;
      border: 1px solid #333;
    }
    .custom-input {
      border: 1px solid #333;
      border-top: 1px solid transparent;
      height: 200px;
      width: 100%;
      padding: 10px;
      // line-height: 200px;
    }
    .count {
      border: 1px solid transparent;
      background-color: #fff;
      text-align: right;
      color: #ddd;
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
