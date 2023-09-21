<template>
    <div class="BackNews">
        <div class="NewsSearch">
            商品編號查詢:
            <input type="text">
            <button class ="NewsSearchBtn">查詢</button>
        </div>
        <div class="NewsTitle">
            <p>編號</p>
            <p>類別</p>
            <p>消息標題</p>
            <p>發布日期</p>
            <p>編輯</p>
        </div>
        <div class="NewsInfro"  v-for="item  in item "  :key="item.pord_id">
            <p>{{ item.prod_id }}</p>
            <p>{{ item.prod_name }}</p>
            <p>{{ item.prod_price }}</p>
            <p>{{ item.prod_date }}</p>
            <div class="edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
        </div>
        <div class="addSta">
            <button>新增消息</button>
        </div>
    </div>
</template>

<script>
import BackProTest from "@/testdata/BackProTest.json"
export default {
    data() {
        return {
            item:BackProTest,
            items: BackProTest.map((item) => ({...item,isChecked: false,})), 

        }
    }
}
</script>

<style lang="scss">
.BackNews {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
    width: 900px;
    padding: 50px;
    .NewsSearch{
    padding: 10px; 
    .NewsSearchBtn{
    width: 80px;
    height: 28px;
    margin-left: 10px;
    }
    }
    .NewsTitle {
        display: flex;
        justify-content: space-evenly;
        background-color: #ddd;
        padding: 5px 0;

        p {
            width: 100%;
            text-align: center;
        }
    }

    .NewsInfro {
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