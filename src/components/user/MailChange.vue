<template>
    <div class="mailchange">
        <h1>更改信箱</h1>
        <div class="changebox">
            <div class="mail">
                <label for="">信箱</label>
                <span>{{ email }}</span>
            </div>
            <div class="changeMail">
                <label for="">新信箱</label>
                <input type="text" v-model="changemail">
            </div>
            <div class="accurance">
                <button class="btn_l">確認更改</button>
                <button class="btn_l btn_undo" @click="menu">返回</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            changemail: '',
        }
    },
    // inject: [
    //     'email'
    // ],
    props: {
        email: {
            type: String
        }
    },
    methods: {
        menu() {
            this.$emit('toggle-change')
        }
    }
}
</script>

<style lang="scss">
.mailchange {
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

        .mail {

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
    .mailchange {
        height: 670px;

        .changebox {
            width: 80%;

            .mail {
                label {
                    width: 35%;
                }

                span {
                    width: 65%;
                }
            }

            .changeMail {
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