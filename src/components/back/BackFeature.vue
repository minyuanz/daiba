<template>
  <div class="backFeature" v-if="addToggle" v-show="!editMode">
    <div class="feaSearch">
      <label for="">請選擇分類：</label>
      <select v-model="selectFeatureAll">
        <option value="ALL">全部</option>
        <option v-for="(feature, index) in selectedFeatures" :key="index">
          {{ feature }}
        </option>
      </select>
      <button class="btnsearch" @click="filterOptions()">查詢</button>
    </div>
    <div class="feaTitle">
      <p>捷運站</p>
      <p>標題</p>
      <p>推薦分類</p>
      <p>編輯</p>
    </div>
    <div
      class="feaInfo"
      v-for="(feature, index) in filteredFeature"
      :key="index"
    >
      <p>{{ feature.sta_name }}</p>
      <p>{{ feature.special_title }}</p>
      <p>{{ feature.fea_name }}</p>

      <div class="edit">
        <button @click="startEditMode(feature)">
          <i class="fa-solid fa-pen-to-square"></i>
          編輯
        </button>
      </div>
    </div>
    <div class="addSta">
      <button @click="addToggle = !addToggle">新增推薦</button>
    </div>
  </div>

  <!-------- 新增 -------->
  <div class="backFeaAdd" v-else>
    <form @submit.prevent="addFeature" enctype="multipart/form-data">
      <div class="feaHead">
        <div class="mainTitle">
          <label for="">文章標題</label>
          <input type="text" v-model="formData.special_title" />
        </div>
        <div class="mainPic">
          <label for="">版頭圖片</label>
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
        <div class="backFeaCtx">
          <label for="">文章簡介</label>
          <textarea
            class="custom-input"
            v-model="formData.special_des"
          ></textarea>
        </div>
        <div class="selectTAg">
          <label for="">捷運站：</label>
          <select name="sta_name" v-model="formData.sta_name">
            <option value="">請選擇捷運站</option>
            <option
              v-for="station in mrtStations"
              :value="station.sta_name"
              :key="station.id"
            >
              {{ station.sta_name }}
            </option>
          </select>
          <label for="">推薦分類：</label>
          <select name="" id="" v-model="formData.fea_name">
            <option value="景點">景點</option>
            <option value="美食">美食</option>
            <option value="住宿">住宿</option>
          </select>
        </div>
      </div>
      <div class="backFeaInfo">
        <div class="uploadPic">
          <label for="">圖片一</label>
          <div class="pic">
            <p>＋</p>
            <input
              type="file"
              name="image2"
              @change="handleFileChange($event, 1, 'add')"
            />
            <img :src="pics[1].imageURL" v-show="pics[1].fix" />
          </div>
          <textarea
            class="custom-input"
            v-model="formData.special_ctx1"
          ></textarea>
        </div>
        <div class="uploadPic">
          <label for="">圖片二 </label>
          <div class="pic">
            <p>＋</p>
            <input
              type="file"
              name="image3"
              @change="handleFileChange($event, 2, 'add')"
            />
            <img :src="pics[2].imageURL" v-show="pics[2].fix" />
          </div>
          <textarea
            class="custom-input"
            v-model="formData.special_ctx2"
          ></textarea>
        </div>
        <div class="uploadPic">
          <label for="">圖片三 </label>
          <div class="pic">
            <p>＋</p>
            <input
              type="file"
              name="image4"
              @change="handleFileChange($event, 3, 'add')"
            />
            <img :src="pics[3].imageURL" v-show="pics[3].fix" />
          </div>
          <textarea
            class="custom-input"
            v-model="formData.special_ctx3"
          ></textarea>
        </div>
        <div class="uploadPic">
          <label for="">圖片四 </label>
          <div class="pic">
            <p>＋</p>
            <input
              type="file"
              name="image5"
              @change="handleFileChange($event, 4, 'add')"
            />
            <img :src="pics[4].imageURL" v-show="pics[4].fix" />
          </div>
          <textarea
            class="custom-input"
            v-model="formData.special_ctx4"
          ></textarea>
        </div>
      </div>
      <!-- <div class="backFeaCtx">
        <label for="">詳細資訊</label>
        <textarea
          class="custom-input"
          v-model="formData.special_ctx5"
        ></textarea>
      </div> -->
      <div>
        <label for="">地址：</label>
        <input type="text" v-model="formData.special_address" />
      </div>
      <div>
        <label for="">電話：</label>
        <input type="text" v-model="formData.special_tel" />
      </div>
      <div>
        <label for="">營業時間：</label>
        <input type="text" v-model="formData.special_time" />
      </div>
      <div>
        <label for="">公休時間：</label>
        <input type="text" v-model="formData.special_rest" />
      </div>
      <div class="btn">
        <button @click="addToggle = !addToggle">取消新增</button>
        <button type="submit">確認新增</button>
      </div>
    </form>
  </div>

  <!-------- 修改 -------->
  <div class="backFeaAdd" v-if="editMode">
    <form @submit.prevent="updateFeature" enctype="multipart/form-data">
      <div class="feaHead">
        <div class="mainTitle">
          <label for="">文章標題</label>
          <input type="text" v-model="editFeature.special_title" />
        </div>
        <div class="mainPic">
          <label for="">版頭圖片</label>
          <div class="pic">
            <p>＋</p>
            <img
              :src="`${this.$store.state.imgURL}` + editFeature.special_pic1"
              v-if="editFeature.special_pic1 !== '' ? true : false"
            />
            <input
              type="file"
              name="image1"
              @change="handleFileChange($event, 0, 'edit')"
            />
            <img :src="originalpics[0].imageURL" v-show="originalpics[0].fix" />
          </div>
        </div>
        <div class="backFeaCtx">
          <label for="">文章簡介</label>
          <textarea
            class="custom-input"
            v-model="editFeature.special_des"
          ></textarea>
        </div>
        <div class="selectTAg">
          <label for="">捷運站：</label>
          <input type="text" v-model="editFeature.sta_name" />
          <label for="">推薦分類：</label>
          <select name="" id="" v-model="editFeature.fea_name">
            <option value="景點">景點</option>
            <option value="美食">美食</option>
            <option value="住宿">住宿</option>
          </select>
        </div>
      </div>
      <div class="backFeaInfo">
        <div class="uploadPic">
          <label for="">圖片一</label>
          <div class="pic">
            <p>＋</p>
            <img
              :src="$imgUrl(editFeature.special_pic2)"
              v-if="editFeature.special_pic2 !== '' ? true : false"
            />
            <input
              type="file"
              name="image2"
              @change="handleFileChange($event, 1, 'edit')"
            />
            <img :src="originalpics[1].imageURL" v-show="originalpics[1].fix" />
          </div>
          <textarea
            class="custom-input"
            v-model="editFeature.special_ctx1"
          ></textarea>
        </div>
        <div class="uploadPic">
          <label for="">圖片二 </label>
          <div class="pic">
            <p>＋</p>
            <img
              :src="$imgUrl(editFeature.special_pic3)"
              v-if="editFeature.special_pic3 !== '' ? true : false"
            />
            <input
              type="file"
              name="image3"
              @change="handleFileChange($event, 2, 'edit')"
            />
            <img :src="originalpics[2].imageURL" v-show="originalpics[2].fix" />
          </div>
          <textarea
            class="custom-input"
            v-model="editFeature.special_ctx2"
          ></textarea>
        </div>
        <div class="uploadPic">
          <label for="">圖片三 </label>
          <div class="pic">
            <p>＋</p>
            <img
              :src="$imgUrl(editFeature.special_pic4)"
              v-if="editFeature.special_pic4 !== '' ? true : false"
            />
            <input
              type="file"
              name="image4"
              @change="handleFileChange($event, 3, 'edit')"
            />
            <img :src="originalpics[3].imageURL" v-show="originalpics[3].fix" />
          </div>
          <textarea
            class="custom-input"
            v-model="editFeature.special_ctx3"
          ></textarea>
        </div>
        <div class="uploadPic">
          <label for="">圖片四 </label>
          <div class="pic">
            <p>＋</p>
            <img
              :src="$imgUrl(editFeature.special_pic5)"
              v-if="editFeature.special_pic5 !== '' ? true : false"
            />
            <input
              type="file"
              name="image5"
              @change="handleFileChange($event, 4, 'edit')"
            />
            <img :src="originalpics[4].imageURL" v-show="originalpics[4].fix" />
          </div>
          <textarea
            class="custom-input"
            v-model="editFeature.special_ctx4"
          ></textarea>
        </div>
      </div>
      <!-- <div class="backFeaCtx">
        <label for="">詳細資訊</label>
        <textarea
          class="custom-input"
          v-model="editFeature.special_ctx5"
        ></textarea>
      </div> -->
      <div>
        <label for="">地址：</label>
        <input type="text" v-model="editFeature.special_address" />
      </div>
      <div>
        <label for="">電話：</label>
        <input type="text" v-model="editFeature.special_tel" />
      </div>
      <div>
        <label for="">營業時間：</label>
        <input type="text" v-model="editFeature.special_time" />
      </div>
      <div>
        <label for="">公休時間：</label>
        <input type="text" v-model="editFeature.special_rest" />
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
      addToggle: true,
      selectFeatureAll: "ALL",
      filteredFeature: [],
      selectedFeatures: [],
      picURL: "",
      fix: false,
      show: false,
      editMode: false, // 編輯模式的開啟與否
      editFeature: null, // 當前編輯的
      mode: "add",
      pics: [
        //新增圖片站存
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
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
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
      ],
      features: [],
      formData: {
        special_title: "",
        sta_name: "",
        fea_name: "",
        special_des: "",
        // imageURL: null,
        special_pic1: null,
        special_pic2: null,
        special_pic3: null,
        special_pic4: null,
        special_pic5: null,
        special_ctx1: "",
        special_ctx2: "",
        special_ctx3: "",
        special_ctx4: "",
        special_ctx5: "",
        special_address: "",
        special_tel: "",
        special_time: "",
        special_rest: "",
      },
    };
  },
  created() {
    this.fetchData();
    axios
      .get(this.$apiUrl("GetMrtStations.php"))
      .then((response) => {
        this.mrtStations = response.data;
      })
      .catch((error) => {
        console.error("獲取捷運站數據失敗：", error);
      });
  },
  methods: {
    fetchData() {
      axios
        .get(this.$apiUrl("BackFeatureM.php"))
        .then((response) => {
          this.features = response.data; // 更新數據到 features
          this.filteredFeature = this.features;

          const featuresValue = this.features.map(
            (feature) => feature.fea_name
          );
          this.selectedFeatures = [...new Set(featuresValue)];
        })
        .catch((error) => {
          console.error("數據傳輸失敗：", error);
        });
    },
    startEditMode(formData) {
      this.editMode = true; // 用v-show進入編輯模式
      // this.addToggle = false;
      this.editFeature = { ...formData }; // 複製數據進入編輯
    },
    cancelEdit() {
      //取消編輯並清空圖片
      this.editMode = false;
      this.originalpics = [
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
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
        { imageURL: null, fix: false },
        { imageURL: null, fix: false },
      ];
    },
    filterOptions() {
      const selectedFeature = this.selectFeatureAll;
      if (selectedFeature === "景點") {
        this.filteredFeature = this.features.filter(
          (features) => features.fea_name === selectedFeature
        );
      } else if (selectedFeature === "ALL") {
        this.filteredFeature = this.features;
      } else if (selectedFeature === "美食") {
        this.filteredFeature = this.features.filter(
          (features) => features.fea_name === selectedFeature
        );
      }
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
            this.formData[`special_pic${index + 1}`] = file;
          } else if (mode === "edit") {
            this.editFeature[`special_pic${index + 1}`] = file;
          }
        }
      }
      if (mode === "add") {
        this.pics[index].fix = true;
      } else if (mode === "edit") {
        this.originalpics[index].fix = true; // 使用 originalpics 數據
      }
    },
    // handleFileChange(e, index) {
    //   const files = e.target.files; // 獲取所有所選文件

    //   for (let i = 0; i < files.length; i++) {
    //     const file = files[i];
    //     const reader = new FileReader();
    //     reader.onload = () => {
    //       // 當讀取完成時觸發
    //       this.pics[index].picURL = reader.result; // 將 Data URL 賦值給圖片的 src
    //     };

    //     if (file) {
    //       reader.readAsDataURL(file); // 讀取文件內容，以 Data URL 形式
    //       this.pics[index].imageURL = file; // 讀取文件內容，以 Data URL 形式
    //     }
    //   }
    //   this.pics[index].fix = true;
    // },
    FileChange(e) {
      console.log(e.target.files[0].name);
      const file = e.target.files[0]; // 獲取所有所選文件
      const reader = new FileReader();
      let URL = "../../img/";
      let fileName = file.name;

      console.log(file);
      console.log(reader);

      reader.onload = () => {
        // 當讀取完成時觸發
        this.picURL = reader.result; // 將 Data URL 賦值給圖片的 src
      };

      if (file) {
        reader.readAsDataURL(file);
        this.formData.imageURL = file; // 讀取文件內容，以 Data URL 形式
      }
      this.show = true;
    },

    addFeature() {
      // 建立數據資料夾好發給PHP做處理新增
      const formData = new FormData();
      formData.append("special_title", this.formData.special_title);
      formData.append("fea_name", this.formData.fea_name);
      formData.append("sta_name", this.formData.sta_name);
      formData.append("special_des", this.formData.special_des);
      formData.append("special_pic1", this.formData.special_pic1);
      formData.append("special_pic2", this.formData.special_pic2);
      formData.append("special_pic3", this.formData.special_pic3);
      formData.append("special_pic4", this.formData.special_pic4);
      formData.append("special_pic5", this.formData.special_pic5);
      formData.append("special_ctx1", this.formData.special_ctx1);
      formData.append("special_ctx2", this.formData.special_ctx2);
      formData.append("special_ctx3", this.formData.special_ctx3);
      formData.append("special_ctx4", this.formData.special_ctx4);
      formData.append("special_ctx5", this.formData.special_ctx5);
      formData.append("special_address", this.formData.special_address);
      formData.append("special_tel", this.formData.special_tel);
      formData.append("special_time", this.formData.special_time);
      formData.append("special_rest", this.formData.special_rest);

      axios
        .post(this.$apiUrl("CreatFeature.php"), formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.status === 200) {
            //檢查http  來判別php新增與否
            alert("已成功新增");
          } else {
            alert("新增失敗");
          }
        })
        .catch((error) => {
          console.error("新增請求失敗：", error);
        });
      location.reload();
    },
    updateFeature() {
      // 建立數據資料夾好發給PHP做處理新增
      const formData = new FormData();
      formData.append("special_title", this.editFeature.special_title);
      formData.append("fea_name", this.editFeature.fea_name);
      formData.append("sta_name", this.editFeature.sta_name);
      formData.append("special_des", this.editFeature.special_des);
      formData.append("special_pic1", this.editFeature.special_pic1);
      formData.append("special_pic2", this.editFeature.special_pic2);
      formData.append("special_pic3", this.editFeature.special_pic3);
      formData.append("special_pic4", this.editFeature.special_pic4);
      formData.append("special_pic5", this.editFeature.special_pic5);
      formData.append("special_ctx1", this.editFeature.special_ctx1);
      formData.append("special_ctx2", this.editFeature.special_ctx2);
      formData.append("special_ctx3", this.editFeature.special_ctx3);
      formData.append("special_ctx4", this.editFeature.special_ctx4);
      formData.append("special_ctx5", this.editFeature.special_ctx5);
      formData.append("special_id", this.editFeature.special_id);
      formData.append("special_address", this.editFeature.special_address);
      formData.append("special_tel", this.editFeature.special_tel);
      formData.append("special_time", this.editFeature.special_time);
      formData.append("special_rest", this.editFeature.special_rest);

      axios
        .post(this.$apiUrl("UpdateFeature.php"), formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.status === 200) {
            //檢查http  來判別php新增與否
            alert("已成功更新");
            this.editMode = false; // 退出编辑模式
            // 清空編輯圖片顯示的圖片
            this.editFeature.special_pic1 = null;
            this.editFeature.special_pic2 = null;
            this.editFeature.special_pic3 = null;
            this.editFeature.special_pic4 = null;
            this.editFeature.special_pic5 = null;
            location.reload();
          } else {
            alert("更新失敗");
          }
        })
        .catch((error) => {
          console.error("更新請求失敗：", error);
        });
    },
  },
};
</script>

<style lang="scss">
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

.backFeature {
  margin-top: 3rem;
  border: 1px solid #aaa;
  background-color: #fff;
  width: 900px;
  padding: 50px;
  height: 900px;
  overflow-y: scroll;

  .feaSearch {
    // border: 1px solid red;
    margin: 10px 0;
    display: flex;
    align-items: center;
    .btnsearch {
      // border: 1px solid red;
      margin: 0 10px;
      padding: 0px 30px;
      height: 30px;
    }
    select {
      height: 30px;
      margin-right: 30px;
      width: 100px;
      text-align: center;
    }
  }

  .feaTitle {
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

  .feaInfo {
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

.backFeaAdd {
  border: 1px solid #aaa;
  background-color: #fff;
  // border-radius: 20px;
  width: 900px;
  height: 900px;
  padding: 50px;
  overflow: auto;
  margin-top: 3rem;

  .feaHead {
    // border: 1px solid red;
    .mainTitle {
      text-align: center;
      display: flex;
      flex-direction: column;

      label {
        display: block;
        text-align: center;
        background-color: #ddd;
        font-size: 24px;
        font-weight: bold;
        padding: 5px 0;
      }

      input {
        margin-top: 30px;
        padding: 5px 0;
        border: 1px solid #aaa;
      }
    }

    .mainPic {
      // border: 1px solid red;
      text-align: center;
      display: flex;
      flex-direction: column;
      margin-top: 30px;

      label {
        display: block;
        text-align: center;
        background-color: #ddd;
        font-size: 24px;
        font-weight: bold;
        padding: 5px 0;
      }

      .pic {
        border: 1px solid #aaa;
        margin-top: 30px;
        position: relative;

        p {
          font-size: 24px;
          line-height: 200px;
        }

        input {
          border: 1px solid red;
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
          opacity: 0;
          z-index: 9;
        }

        img {
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
        }
      }
    }

    .secTitle {
      // border: 1px solid red;
      margin-top: 30px;
      display: flex;
      flex-direction: column;
      text-align: center;

      label {
        display: block;
        text-align: center;
        background-color: #ddd;
        font-size: 24px;
        font-weight: bold;
        padding: 5px 0;
      }

      input {
        border: 1px solid #aaa;
        margin-top: 30px;
        padding: 5px 0;
      }
    }

    .selectTAg {
      // border: 1px solid red;
      display: flex;
      align-items: center;
      justify-content: space-evenly;
      margin-top: 30px;

      // label {
      //   // width: 15%;
      // }

      select {
        width: 200px;
      }
    }
  }

  .backFeaInfo {
    margin-top: 50px;
    padding-top: 30px;
    border-top: 1px dashed #aaa;

    .uploadPic {
      // border: 1px solid red; text-align: center;
      text-align: center;
      display: flex;
      flex-direction: column;
      margin-top: 50px;

      label {
        display: block;
        text-align: center;
        background-color: #ddd;
        font-size: 24px;
        font-weight: bold;
        padding: 5px 0;
      }

      .pic {
        border: 1px dashed #aaa;
        margin-top: 30px;
        position: relative;

        p {
          // font-size: 24px;
          line-height: 200px;
        }

        input {
          border: 1px solid red;
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
          opacity: 0;
          z-index: 9;
        }

        img {
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
        }
      }

      .custom-input {
        border: 1px solid #333;
        // border-top:1px solid transparent;
        margin-top: 1rem;
        height: 200px;
        width: 100%;
        padding: 10px;
        // line-height: 200px;
      }
    }
  }

  .backFeaCtx {
    display: flex;
    flex-direction: column;
    text-align: center;
    margin-top: 50px;

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
      margin-top: 1rem;
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
