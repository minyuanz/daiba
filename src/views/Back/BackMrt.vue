<template>
    <div class="backUI">
        <BackSliderAC/>
        <BackMrt/>
    </div>
</template>

<script>
import BackSliderAC from '@/components/back/BackSliderAC.vue'
import BackMrt from '@/components/back/BackMrt.vue'
export default {
    components:{
        BackSliderAC,
        BackMrt
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
