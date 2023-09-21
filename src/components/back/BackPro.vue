<template>
    <div class="BackPro">
        <div class="ProSearch">
            商品編號查詢:
            <input type="text">
            <button class ="ProSearchBtn">查詢</button>
        </div>
        <div class="ProTitle">
            <p>商品編號</p>
            <p>商品名稱</p>
            <p>金額</p>
            <p>編輯</p>
            <p>上架/下架</p>
        </div>
        <div class="ProInfro"  v-for="item  in item "  :key="item.pord_id">
            <p>{{ item.prod_id }}</p>
            <p>{{ item.prod_name }}</p>
            <p>{{ item.price }}</p>
            <div class="edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="upcheck">
                <label class="ios-switch">
                <input type="checkbox" v-model="item.isChecked" />
                <span class="slider"></span>
                </label>
            </div>
        </div>
        <div class="addSta">
            <button>新增商品</button>
        </div>
    </div>
</template>

<script>
import BackProTest from "@/testdata/BackProTest.json"
export default {
    data() {
        return {
            item:BackProTest,
            isSwitchOn: false,
            items: BackProTest.map((item) => ({...item,isChecked: false,})), 

        }
    }
}
</script>

<style lang="scss">
.BackPro {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
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
</style>