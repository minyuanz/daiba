<template>
    <div class="backUI">
        <BackSliderAC/>
        <BackPermission/>
    </div>
</template>

<script>
import BackSliderAC from '@/components/back/BackSliderAC'
import BackPermission from '@/components/back/BackPermission'
export default {
    components:{
        BackSliderAC,
        BackPermission
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