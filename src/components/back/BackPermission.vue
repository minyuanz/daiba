<template>
    <div class="BackPro" v-if="addToggle">
        <div class="ProSearch">
            商品編號查詢:
            <input type="text">
            <button class ="ProSearchBtn">查詢</button>
        </div>
        <div class="ProTitle">
            <p>管理編號</p>
            <p>管理帳號</p>
            <p>權限等級</p>
            <p>權限開關</p>
        </div>
        <div class="ProInfro" v-for="admin in admins" :key="admin.admin_id">
            <p>{{ admin.admin_id }}</p>
            <p>{{ admin.admin_acc }}</p>
            <p>{{ admin.admin_lv }}</p>
            <div class="upcheck">
                <label class="ios-switch">
                    <input type="checkbox" :checked="admin.admin_sich === '1'" @change="togglePermission(admin)" />
                    <span class="slider" :style="{ backgroundColor: admin.admin_sich === '1' ? '#4CAF50' : '#565656' }"></span>
                </label>
            </div>
        </div>
        <div class="addSta">
            <button @click="addToggle = !addToggle">創建帳號</button>
        </div>
    </div>
    <div class="BackPerAdd" v-else >
        <form class="PerBOX">
            <div class="PerAddTITLE">新增管理員帳號:</div>
            <div>
                <label for="">管理員帳號：</label>
                <input type="text" id="admin_acc" v-model="newAdmin.admin_acc" />
            </div>
            <div>
                <label for="">管理員密碼：</label>
                <input type="password" id="admin_pas" v-model="newAdmin.admin_pas" />
            </div>
            <div class="btn">
                <button @click="addToggle = !addToggle">取消新增</button>
                <button @click="addAdmin">確認新增</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
// import BackProTest from "@/testdata/BackProTest.json"
export default {
    data() {
        return {
            addToggle:true,
            // item:BackProTest,
            isSwitchOn: false,
            // items: BackProTest.map((item) => ({...item,isChecked: false,})), 
            admins: [],
            newAdmin: {
                admin_acc: "",
                admin_pas: ""
            },
        }
    },
    created() {
    this.fetchData(); 
    },
    methods: {
    addAdmin() {
      const { admin_acc, admin_pas } = this.newAdmin;
      const usernamePattern = /^[a-zA-Z0-9]{1,15}$/;
      const passwordPattern = /^[a-zA-Z0-9]{1,15}$/;

      if (!usernamePattern.test(admin_acc)) {
        alert('管理員帳號必須是英文字母和數字，最多15個字符。');
        return;
      }

      if (!passwordPattern.test(admin_pas)) {
        alert('管理員密碼必須是英文字母和數字，最多15個字符。');
        return;
      }

      const formData = new FormData();
      formData.append("admin_acc", admin_acc);
      formData.append("admin_pas", admin_pas);

      fetch(`http://localhost/dai/public/phps/CreatPermissionAC.php`, {
        method: "post",
        body: formData
      })
        .then(res => res.json())
        .then((res) => {
          if (!res.error) {
            // 如果正確 清空表單
            this.newAdmin.admin_acc = "";
            this.newAdmin.admin_pas = "";
            // 切换回 addToggle
            this.addToggle = !this.addToggle;
            alert( res.msg);
          } else {
            alert('新增失敗：' + res.msg);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
        fetchData() {
            console.log('Fetching data...'); //測試顯示數據
            axios.get('http://localhost/dai/public/phps/PremissonM.php')
            .then((response) => {
            this.admins = response.data; // 更新數據到 admins
        })
            .catch((error) => {
            console.error('數據傳輸失敗：', error);
        });
},
togglePermission(admin) {
  // 更改狀態
  admin.admin_sich = admin.admin_sich === '1' ? '0' : '1';
  axios.post('http://localhost/dai/public/phps/ContralPermissionAC.php', {
    admin_id: admin.admin_id,
    admin_sich: admin.admin_sich,
  })
  .then((response) => {
    // 檢查
    if (response.data.success) {
      console.log('權限已更新');
      alert('權限已更新成功');
    } else {
      console.error('權限更新失败');
      alert('權限更新失敗');
      // 如果失敗則保持原本渲染的狀態
      admin.admin_sich = admin.admin_sich === '1' ? '0' : '1';
    }
  })
  .catch((error) => {
    console.error('更新請求失敗：', error);
    alert('更新請求失敗');
    // 如果失敗則保持原本渲染的狀態
    admin.admin_sich = admin.admin_sich === '1' ? '0' : '1';
  });
},
    }
}
</script>

<style lang="scss">
.BackPro {
    margin-top: 3rem;
    border: 1px solid #aaa;
    background-color: #fff;
    width: 900px;
    padding: 50px;
    .ProSearch{
    padding: 10px; 
    .ProSearchBtn{
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
  background-color: #4CAF50;
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
.BackPerAdd{
    border: 1px solid #aaa;
    background-color: #fff;
    // border-radius: 20px;
    width: 900px;
    padding: 50px;
    margin-top: 3rem;
    display: flex;
    justify-content: center;
    align-items: center;
    .PerBOX{
        align-items: center;
        justify-content: center;
        display: flex;
        flex-wrap: wrap;
        width: 70%;
        background-color: #ddd;
        .PerAddTITLE{
            width: 100%;
            text-align: center;
            font-size: 40px;
        }
        div{
            line-height: 2;
            padding: 30px;
            button{
                width: 200px;
                margin: 20px;
            }
        }
    }
}
</style>