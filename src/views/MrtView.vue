<template>
  <MrtTop />
  <MrtMain />
</template>
<script>
import MrtTop from "@/components/MrtTop.vue";
import MrtMain from "@/components/MrtMain.vue";
import Swiper from "swiper/bundle";
import { pushScopeId } from "vue";
export default {
  components: {
    MrtTop,
    MrtMain,
  },
};
</script>
