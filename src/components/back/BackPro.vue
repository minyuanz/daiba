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
        <div class="feaInfo" v-for="info in product">
            <p>{{ info.staName }}</p>
            <p>{{ info.Title }}</p>
            <p>{{ info.Fea }}</p>
            <p>{{ info.Date }}</p>
            <div class="edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="del">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>
        <div class="addSta">
            <button>新增推薦</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            product: [{
                prod_id:"",
                mrt_id:"",
                sta_id:"",
                prod_name:"",
                prod_price:"",
                prod_img1:"",
                prod_img2:"",
                prod_img3:"",
                prod_img4:"",
                prod_des1:"",
                prod_des2:"",
                prod_status:"",
                prod_type:"",
            }, {
                staName: '板橋',
                Title: '漢堡',
                Fea: '美食',
                Date: '2023-02-03'
            }, {
                staName: '板橋',
                Title: '漢堡',
                Fea: '美食',
                Date: '2023-02-03'
            },]
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
</style>