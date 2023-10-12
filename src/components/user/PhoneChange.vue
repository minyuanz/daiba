<template>
    <div class="phonechange">
        <h1>更改手機號碼</h1>
        <div class="changebox">
            <div class="phone">
                <label for="">手機號碼</label>
                <!-- <input type="text"> -->
                <span>{{ member.mem_phone }}</span>
            </div>
            <div class="changePhone">
                <label for="">新手機號碼</label>
                <input type="text" v-model="changePhone">
            </div>
            <div class="accurance">
                <button class="btn_l" @click="updatePhone">確認更改</button>
                <button class="btn_l btn_undo" @click="menu">返回</button>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            changePhone: '',
            member: this.$store.state.memInfo

        }
    },
    methods: {
        menu() {
            this.$emit('toggle-change')
        },
        updatePhone() {
            if (this.changePhone == '') {
                alert("請輸入手機")
            } else {
                // 建立數據資料夾好發給PHP做處理新增
                const formData = new FormData();
                formData.append("mem_phone", this.changePhone);
                formData.append("mem_id", this.member.mem_id);
                fetch('http://localhost/dai/public/phps/UpdateMemberPhone.php', {
                    method: 'post',
                    body: formData
                })
                    .then(res => res.json())
                    .then((res) => {
                        if (!res.error) {
                            alert(res.msg);
                            this.menu()
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
}
</script>

<style lang="scss">
.phonechange {
    border: 1px solid #aaa;
    background-color: #fff;
    border-radius: 20px;
    width: 900px;

    h1 {
        text-align: center;
        margin-top: 50px;
    }

    .changebox {
        width: 400px;
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        gap: 3rem;
        inset: 0;
        margin: 5rem auto;


        .phone {

            label {
                font-size: map-get($map , small);
                display: inline-block;
            }

            span {
                font-size: map-get($map , small);
                display: inline-block;
                width: 100%;
                text-align: center;
            }

            // text-align: center;
        }

        label,
        input {
            font-size: map-get($map , small);
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        input {
            border: transparent;
            border-bottom: 1px solid #aaa;
        }

        button {
            margin: .5rem 0;
        }
    }


}

@media screen and (max-width:414px) {
    .phonechange {
        height: 670px;

        .changebox {
            width: 80%;

            .phone {
                label {
                    width: 35%;
                }

                span {
                    width: 65%;
                }
            }

            .changePhone {
                display: flex;

                label {
                    width: 35%;
                }

                input {
                    width: 65%;
                }
            }
        }
    }
}
</style>