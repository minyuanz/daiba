<template>
    <div class="backUI">
        <BackSliderAC/>
        <Backmember/>
    </div>
</template>

<script>
import BackSliderAC from '@/components/back/BackSliderAC.vue'
import Backmember from '@/components/back/Backmember.vue'
export default {
    components:{
        BackSliderAC,
        Backmember
    },
    data() {
        return {

        }
    },
}
</script>

<style lang="scss">
@import "@/assets/scss/component/slider";
    .backUI{
        // border: 1px solid red;
        width: 1200px;
        margin: auto;
        display: flex;
    }
</style>
