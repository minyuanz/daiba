<template>
  <div class="about">

  </div>

</template>

<style lang="scss">


</style>

<script>

export default {
  methods: {

  },
  computed: {

  },
  mounted() {

  },
};
</script>

<!-- <script>
import gsap from "gsap"; // 确保正确引入GSAP库

export default {
  mounted() {
    // 在组件挂载后初始化GSAP动画
    gsap.set(".box2", { transformOrigin: "50% 50%" });

    // 创建一个无限循环的动画
    function bounceImage() {
      gsap.to(".box2", {
        x: () => gsap.utils.random(0, 1000, 60), // 随机水平位移
        y: () => gsap.utils.random(0, 200, 5), // 随机垂直位移
        rotation: () => gsap.utils.random(-45, 45), // 随机旋转角度
        duration: 2, // 持续时间
        ease: "power2.inOut",
        onComplete: bounceImage, // 完成后再次调用此函数
      });
    }

    bounceImage(); // 开始动画
  },
};
</script> -->
