<template>
    <div class="wrapper">
      
  <!-- :style="{
  backgroundImage: `url(${memberBackground})`}" -->
        <SliderAC/>
    </div>


</template>
  
  
  <script>
  import SliderAC from '@/components/SliderAC.vue';
  // import memberBackground from '@/assets/images/member/memberPagesbgi.svg';
  export default {
    data () {
        return {
            // memberBackground
        }
    },
    components: {
      SliderAC,
    }
  }
  </script>
<style>
.wrapper{
    /* width: 100%;
    height: 100vh;
    z-index: -1;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: -10% 10%; */
}


</style>
  