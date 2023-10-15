<template>
  <div class="backMember">
    <div class="memberSearch">
      <label for="">會員編號查詢：</label>
      <input type="text" v-model="search" />
      <button class="btnsearch">查詢</button>
    </div>
    <div class="memberTitle">
      <p>會員編號</p>
      <p>會員信箱</p>
      <p>姓名</p>
      <p>電話</p>
      <!-- <p></p> -->
      <p>狀態</p>
    </div>
    <div class="memberInfo" v-for="member in members">
      <p>{{ member.mem_id }}</p>
      <p>{{ member.mem_email }}</p>
      <p>{{ member.mem_name }}</p>
      <p>{{ member.mem_phone }}</p>
      <!-- <button class="findd">查閱</button> -->
      <div class="toggle">
        <label class="ios-switch">
          <input
            type="checkbox"
            :checked="member.mem_status === '1'"
            @change="togglePermission(member)"
          />
          <span
            class="slider"
            :style="{
              backgroundColor:
                member.mem_status === '1' ? '#4CAF50' : '#565656',
            }"
          ></span>
        </label>
        <!-- <label class="switch">
                    <input type="checkbox" v-model="info.status">
                    <span class="slider round"></span>
                </label> -->
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      members: [],
    };
  },
  mounted() {
    axios
      .get(`${this.$apiUrl("BackMemberM.php")}`)
      .then((response) => {
        this.members = response.data;
      })
      .catch((error) => {
        console.error("獲取數據失敗：", error);
      });
  },
  methods: {
    togglePermission(member) {
      // 更改狀態
      member.mem_status = member.mem_status === "1" ? "0" : "1";
      axios
        .post(`${this.$apiUrl("ContralMemberAC.php")}`, {
          mem_id: member.mem_id,
          mem_status: member.mem_status,
        })
        .then((response) => {
          // 檢查
          if (response.data.success) {
            console.log("權限已更新");
            alert("權限已更新成功");
          } else {
            console.error("權限更新失败");
            alert("權限更新失敗");
            // 如果失敗則保持原本渲染的狀態
            member.mem_status = member.mem_status === "1" ? "0" : "1";
          }
        })
        .catch((error) => {
          console.error("更新請求失敗：", error);
          alert("更新請求失敗");
          // 如果失敗則保持原本渲染的狀態
          member.mem_status = member.mem_status === "1" ? "0" : "1";
        });
    },
  },
};
</script>

<style lang="scss">
.backMember {
  margin-top: 3rem;
  border: 1px solid #aaa;
  background-color: #fff;
  width: 900px;
  padding: 50px;
  height: 900px;
  overflow-y: scroll;

  .memberSearch {
    // border: 1px solid red;
    margin: 10px 0;
    display: flex;
    align-items: center;

    input {
      height: 30px;
    }

    .btnsearch {
      // border: 1px solid red;
      margin: 0 10px;
      padding: 0px 30px;
      height: 30px;
    }
  }

  .memberTitle {
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

  .memberInfo {
    // border: 1px solid red;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 5px 0;
    border-bottom: 1px solid #aaa;
    .toggle {
      .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 28px;
        // border: 1px solid red;
      }

      .switch input {
        opacity: 0;
        width: 0;
        height: 0;
      }

      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
      }

      .slider:before {
        content: "";
        position: absolute;
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
      }

      input:checked + .slider {
        background-color: #f32121;
      }

      input:focus + .slider {
        box-shadow: 0 0 1px #f32121;
      }

      input:checked + .slider:before {
        transform: translateX(26px);
      }

      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }

      .slider.round:before {
        border-radius: 50%;
      }
    }

    .toggle,
    button,
    p {
      // border: 1px solid red;
      width: 16%;
      text-align: center;
    }
    .toggle {
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
  }
}
</style>
