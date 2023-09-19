<template>
    <div class="backUI">
        <BackSliderAC/>
        <BackContri/>
    </div>
</template>

<script>
import BackSliderAC from '@/components/back/BackSliderAC'
import BackContri from '@/components/back/BackContri'
export default {
    components:{
        BackSliderAC,
        BackContri
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