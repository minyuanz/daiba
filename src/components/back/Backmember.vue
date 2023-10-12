<template>
    <div class="backMember">
        <div class="memberSearch">
            <label for="">會員編號查詢：</label>
            <input type="text" v-model="search">
            <button class="btnsearch">查詢</button>
        </div>
        <div class="memberTitle">
            <p>狀態</p>
            <p>會員編號</p>
            <p>會員帳號</p>
            <p>姓名</p>
            <p>電話</p>
            <p></p>
        </div>
        <div class="memberInfo" v-for="info in infos">
            <div class="toggle">
                <label class="switch">
                    <input type="checkbox" v-model="info.status">
                    <span class="slider round"></span>
                </label>
            </div>
            <p>{{ info.id }}</p>
            <p>{{ info.acc }}</p>
            <p>{{ info.name }}</p>
            <p>{{ info.phone }}</p>
            <p>查閱</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            search:''
        }
    },
}
</script>


<style lang="scss">
.backMember {
    margin-top: 3rem;
    border: 1px solid #aaa;
    background-color: #fff;
    width: 900px;
    padding: 50px;

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
                transition: .4s;
            }

            .slider:before {
                content: "";
                position: absolute;
                height: 20px;
                width: 20px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                transition: .4s;
            }

            input:checked+.slider {
                background-color: #f32121;
            }

            input:focus+.slider {
                box-shadow: 0 0 1px #f32121;
            }

            input:checked+.slider:before {
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
        p {
            // border: 1px solid red;
            width: 100%;
            text-align: center;
        }
    }
}
</style>