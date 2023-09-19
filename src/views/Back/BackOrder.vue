<template>
    <div class="backUI">
        <BackSliderAC/>
        <BackOrder/>
    </div>
</template>

<script>
import BackSliderAC from '@/components/back/BackSliderAC'
import BackOrder from '@/components/back/BackOrder'
export default {
    components:{
        BackSliderAC,
        BackOrder
    },
    data() {
        return {

        }
    },
}
</script>

<style lang="scss">
    .backUI{
        // border: 1px solid red;
        width: 1200px;
        margin: auto;
        display: flex;
    }
</style>