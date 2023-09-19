<template>
    <div class="backUI">
        <BackSliderAC/>
        <BackPro/>
    </div>
</template>

<script>
import BackSliderAC from '@/components/back/BackSliderAC'
import BackPro from '@/components/back/BackPro'
export default {
    components:{
        BackSliderAC,
        BackPro
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