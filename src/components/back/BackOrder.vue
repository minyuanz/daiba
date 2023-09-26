<template>
    <div class="BackOrder">
        <div class="OrderSearch">
            訂單編號查詢:
            <input type="text">
            <button class ="OrderSearchBtn">查詢</button>
        </div>
        <div class="OrderTitle">
            <p>訂單編號</p>
            <p>會員編號</p>
            <p>金額</p>
            <p>物流狀態</p>
            <p>訂單詳情</p>
        </div>
        <div class="OrderInfro"  v-for="item  in item "  :key="item.pord_id">
            <p>{{ item.prod_id }}</p>
            <p>{{ item.prod_name }}</p>
            <p>{{ item.price }}</p>
            <div class="edit">
                <select name="" id="">
                    <option value="">備貨中</option>
                    <option value="">配送中</option>
                    <option value="">配送完成</option>
                </select>
            </div>
            <div >
                <button class="DetailBtn">訂單詳情</button>
            </div>
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
.BackOrder {
    margin-top: 3rem;
    border: 1px solid #aaa;
    background-color: #fff;
    width: 900px;
    padding: 50px;
    .OrderSearch{
    padding: 10px; 
    .OrderSearchBtn{
    width: 80px;
    height: 28px;
    margin-left: 10px;
    }
    }
    .OrderTitle {
        display: flex;
        justify-content: space-evenly;
        background-color: #ddd;
        padding: 5px 0;

        p {
            width: 100%;
            text-align: center;
        }
    }

    .OrderInfro {
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
    }
    .DetailBtn{
       width: 80px;
       height: 26px;
    }
}
</style>