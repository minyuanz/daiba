<template>
  <div class="backMrt" v-if="addToggle" v-show="!editMode">
    <div class="mrtSearch">
      <label for="">請選擇捷運線：</label>
      <select name="mrtLine" id="mrtLine" v-model="selectMrtId">
        <option value="ALL">全部</option>
        <option v-for="mrtId in selectedMrtLine" :key="mrtId" :value="mrtId">
          {{ mrtId }}
        </option>
      </select>
      <button class="btnsearch" @click="filterOptions()">查詢</button>
    </div>
    <div class="mrtTitle">
      <p>捷運站編號</p>
      <p>捷運站代碼1</p>
      <p>捷運站代碼2</p>
      <p>站名</p>
      <p>編輯</p>
      <!-- <p>刪除</p> -->
    </div>
    <div class="mrtInfo" v-for="(addMrt, index) in filteredMrtIds" :key="index">
      <p>{{ addMrt.sta_id }}</p>
      <p>{{ addMrt.mrt_code1 }}</p>
      <p>{{ addMrt.mrt_code2 }}</p>
      <p>{{ addMrt.sta_name }}</p>
      <div class="edit" @click="startEditMode(addMrt)">
        <button>
          <i class="fa-solid fa-pen-to-square"></i>
          編輯
        </button>
      </div>
      <!-- <div class="del" @click="deleteMode(addMrt.sta_id)">
        <i class="fa-solid fa-circle-xmark fa-xl"></i>
      </div> -->
    </div>
    <div class="addSta">
      <button @click="addToggle = !addToggle">新增捷運站</button>
    </div>
  </div>
  <div class="backMrtAdd" v-else>
    <form @submit="addnewMrt" enctype="multipart/form-data">
      <p>你正在新增車站：</p>
      <div class="addInfo">
        <div class="pic">
          <!-- <img src="https://picsum.photos/200/200/?random=10" /> -->
          <!-- <button>上傳圖片</button> -->
          <img :src="picURL" alt="" style="width: 200px; height: 200px" />
          <input type="file" @change="FileChange" />
        </div>
        <div class="txt">
          <div>
            <label for="">位於捷運線：</label>
            <select name="" id="" v-model="newMrt.mrt_id1">
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
            <select name="" id="" v-model="newMrt.mrt_id2">
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
        <textarea class="custom-input" v-model="newMrt.sta_describe"></textarea>
        <!-- <input type="text" class="custom-input"> -->
        <!-- <span class="count">0/100字</span> -->
      </div>
      <div class="btn">
        <button @click="cancelAdd">取消新增</button>
        <button @click="addNewMrt">確認新增</button>
      </div>
    </form>
  </div>

  <div class="backMrtAdd" v-if="editMode">
    <form @submit="addnewMrt" enctype="multipart/form-data">
      <p>你正在新增車站：</p>
      <div class="addInfo">
        <div class="pic">
          <!-- <img src="https://picsum.photos/200/200/?random=10" /> -->
          <!-- <button>上傳圖片</button> -->
          <img
            :src="`${this.$store.state.imgURL}` + currentEditMrt.sta_pictor"
            v-if="currentEditMrt.sta_pictor !== '' ? true : false"
            style="width: 200px; height: 200px"
          />
          <input type="file" @change="FileUpdate" name="image" />
          <img
            :src="picURL"
            alt=""
            v-show="show"
            style="width: 200px; height: 200px; position: absolute"
          />
        </div>
        <div class="txt">
          <div>
            <label for="">位於捷運線：</label>
            <select name="" id="" v-model="currentEditMrt.mrt_id1">
              <option value="BL">BL</option>
              <option value="BR">BR</option>
              <option value="G">G</option>
              <option value="O">O</option>
              <option value="R">R</option>
            </select>
          </div>
          <div>
            <label for="">捷運站編號：</label>
            <input type="text" v-model="currentEditMrt.mrt_code1" />
          </div>
          <div>
            <label for="">位於捷運線：</label>
            <select name="" id="" v-model="currentEditMrt.mrt_id2">
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
              v-model="currentEditMrt.mrt_code2"
            />
          </div>
          <div>
            <label for="">捷運站名稱：</label>
            <input type="text" v-model="currentEditMrt.sta_name" />
          </div>
        </div>
      </div>
      <div class="addCtx">
        <span>捷運站描述</span>
        <textarea
          class="custom-input"
          v-model="currentEditMrt.sta_describe"
        ></textarea>
      </div>
      <div class="btn">
        <button @click="cancelEdit">取消編輯</button>
        <button @click="updateMrt">確認編輯</button>
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
      mrtId: "",
      selectedMrtLine: [],
      selectMrtId: "ALL",
      filteredMrtIds: [],
      show: false,
      currentEditMrt: "",
      mrts: [],
      addToggle: true,
      admins: [],
      sta: BackMrt,
      newMrt: {
        // sta_id: "",
        mrt_code1: "", //捷運站編號
        mrt_code2: "", //捷運站編號2
        sta_name: "", //捷運站名稱
        mrt_id1: "", //位於捷運線
        mrt_id2: "", //位於捷運線2
        sta_pictor: "",
        sta_describe: "",
      },
      picURL: "",
      products: [],
      pics: [{ imageURL: null, fix: false }],
      isSwitchOn: false,
      editMode: false,
    };
  },

  created() {
    this.fetchData();
  },

  methods: {
    filterOptions() {
      const selectedLine = this.selectMrtId;
      if (selectedLine === "BL") {
        this.filteredMrtIds = this.mrts.filter(
          (mrts) =>
            mrts.mrt_id1 === selectedLine || mrts.mrt_id2 === selectedLine
        );
      } else if (selectedLine === "ALL") {
        this.filteredMrtIds = this.mrts;
      } else if (selectedLine === "BR") {
        this.filteredMrtIds = this.mrts.filter(
          (mrts) =>
            mrts.mrt_id1 === selectedLine || mrts.mrt_id2 === selectedLine
        );
      } else if (selectedLine === "R") {
        this.filteredMrtIds = this.mrts.filter(
          (mrts) =>
            mrts.mrt_id1 === selectedLine || mrts.mrt_id2 === selectedLine
        );
      } else if (selectedLine === "O") {
        this.filteredMrtIds = this.mrts.filter(
          (mrts) =>
            mrts.mrt_id1 === selectedLine || mrts.mrt_id2 === selectedLine
        );
      } else if (selectedLine === "G") {
        this.filteredMrtIds = this.mrts.filter(
          (mrts) =>
            mrts.mrt_id1 === selectedLine || mrts.mrt_id2 === selectedLine
        );
      }
    },

    async handleSubmit(event) {
      event.preventDefault(); // 阻止默認的提交行爲
      // 處理表單提交邏輯
      await this.addNewMrt(); // 確保非同步請求完成
      // 可以在這裡進行狀態更改
      this.addToggle = false;
    },

    cancelAdd(){
      this.addToggle = !this.addToggle;
      this.newMrt.sta_describe = '';
      this.newMrt.mrt_code1 = '';
      this.newMrt.mrt_code2 = '';
      this.newMrt.sta_name = '';
      this.newMrt.mrt_id1 = '';
      this.newMrt.mrt_id2 = '';
      this.newMrt.sta_pictor = '';
    },

    cancelEdit() {
      this.editMode = false; //取消編輯並清空圖片
      this.show = false;
      this.picURL = "";
    },

    // deleteMode(itemId) {
    //   if (confirm("確定要刪除這個項目嗎？")) {
    //     // 發送 DELETE 請求到後端
    //     axios
    //       .delete(
    //         `http://localhost/dai/public/phps/deleteMrt.php?itemId=${itemId}`
    //       )
    //       .then((response) => {
    //         if (response.data.success) {
    //           // 刪除成功的處理邏輯
    //           console.log(response.data.msg);
    //         } else {
    //           // 刪除失敗的處理邏輯
    //           console.log(response.data.msg);
    //         }
    //       })
    //       .catch((error) => {
    //         console.error("刪除請求失敗：", error);
    //       });
    //   }
    // },

    startEditMode(newMrt) {
      this.editMode = true; // 用v-show進入編輯模式
      // this.addToggle = false;
      this.currentEditMrt = { ...newMrt }; // 複製數據進入編輯
    },
    FileChange(e) {
      console.log(e.target.files[0].name);
      const file = e.target.files[0]; // 獲取所有所選文件
      const reader = new FileReader();
      let URL = "../../img/";
      let fileName = file.name;

      console.log(file);
      console.log(reader);

      // this.formData.imageURL = `${URL}${fileName}`;
      reader.onload = () => {
        // 當讀取完成時觸發
        this.picURL = reader.result; // 將 Data URL 賦值給圖片的 src
      };

      if (file) {
        reader.readAsDataURL(file); // 讀取文件內容，以 Data URL 形式
        this.newMrt.sta_pictor = file;
      }
      this.newMrt.fix = true;
    },
    FileUpdate(e) {
      console.log(e.target.files[0].name);
      const file = e.target.files[0]; // 獲取所有所選文件
      const reader = new FileReader();

      // console.log(file);
      // console.log(reader);

      reader.onload = () => {
        // 當讀取完成時觸發
        this.picURL = reader.result; // 將 Data URL 賦值給圖片的 src
      };

      if (file) {
        reader.readAsDataURL(file); // 讀取文件內容，以 Data URL 形式
        this.currentEditMrt.sta_pictor = file;
      }
      this.show = true;
    },

    fetchData() {
      // $apiUrl('mrt.php')
      axios
        .get(this.$apiUrl('mrt.php'))
        .then((response) => {
          this.mrts = response.data;
          // console.log(this.mrts);
          this.filteredMrtIds = this.mrts;
          // console.log(this.filteredMrtIds);
          const mrtIds = this.mrts.map((mrt) => mrt.mrt_id1);
          this.selectedMrtLine = [...new Set(mrtIds)];
        })
        .catch((error) => {
          console.error("數據傳輸失敗：", error);
        });
    },
    updateMrt() {
      const formData = new FormData();
      formData.append("news_imageURL", this.currentEditMrt.sta_pictor);
      formData.append("sta_id", this.currentEditMrt.sta_id);
      formData.append("mrt_code1", this.currentEditMrt.mrt_code1);
      formData.append("mrt_code2", this.currentEditMrt.mrt_code2);
      formData.append("mrt_id1", this.currentEditMrt.mrt_id1);
      formData.append("sta_name", this.currentEditMrt.sta_name);
      formData.append("mrt_id2", this.currentEditMrt.mrt_id2);
      // formData.append("sta_pictor", this.currentEditMrt.imageURL);
      formData.append("mrt_id2", this.currentEditMrt.mrt_id2);
      formData.append("sta_describe", this.currentEditMrt.sta_describe);

      // $apiUrl('updateMrt.php')
      fetch(this.$apiUrl('updateMrt.php'), {
        method: "post",
        body: formData,
      })
        .then((res) => res.json())
        .then((res) => {
          if (!res.error) {
            alert(res.msg);
            this.editMode = false; // 退出编辑模式
            // this.currentEditProduct.sta_pictor = null;
            // location.reload();
          }
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => {
          location.reload();
        });
    },
    addNewMrt() {
      const formData = new FormData();
      // formData.append("sta_id ", this.newMrt.sta_id);
      formData.append("mrt_code1", this.newMrt.mrt_code1);
      formData.append("mrt_code2", this.newMrt.mrt_code2);
      formData.append("sta_name", this.newMrt.sta_name);
      formData.append("mrt_id1", this.newMrt.mrt_id1);
      formData.append("mrt_id2", this.newMrt.mrt_id2);
      formData.append("news_imageURL", this.newMrt.sta_pictor);
      // formData.append("news_imageURL", this.newMrt.sta_pictor);
      formData.append("sta_describe", this.newMrt.sta_describe);

      // $apiUrl('CreatMrt.php')
      fetch(this.$apiUrl('CreatMrt.php'), {
        method: "post",
        body: formData,
      })
        // .then((res) => res.json())
        // .then((res) => {
        //   if (!res.error) {
        //     console.log("成功响应:", res);
        //     alert(res.msg); // 弹出成功提醒
        //     this.addToggle = false; // 关闭新增站的页面
        //   } else {
        //     console.log("失败响应:", res);
        //   }
        // })
        // .catch(function (error) {
        //   console.log("请求失败:", error);
        // });
        .then((res) => res.json())
        .then((res) => {
          if (!res.error) {
            alert(res.msg);
            this.addToggle = false;
            // location.reload();
          }
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => {
          location.reload();
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
  height: 900px;
  overflow-y: scroll;

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
    padding: 10px 0;
    border-bottom: 1px solid #aaa;

    // .del {
    //   svg {
    //     padding: 5%;
    //     cursor: pointer;
    //     transition: all 0.3s;

    //     &:hover {
    //       color: crimson;
    //     }
    //   }
    // }

    .edit {
      button {
        border: 2px solid #666;
        background-color: transparent;
        cursor: pointer;
        border-radius: 5px;
        padding: 5%;
        transition: all 0.3s;

        &:hover {
          border: 2px solid #333;
          background-color: #ddd;
        }
      }
    }

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
  height: 900px;

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

      input {
        inset: 0;
        margin: auto;
        width: 60%;
      }

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
