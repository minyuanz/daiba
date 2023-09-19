<template>
    <div class="backUI">
        <BackSliderAC/>
        <BackFeature/>
    </div>
</template>

<script>
import BackSliderAC from '@/components/back/BackSliderAC'
import BackFeature from '@/components/back/BackFeature'
export default {
    components:{
        BackSliderAC,
        BackFeature
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
