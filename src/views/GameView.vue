<template>
  <div class="about">
    <h1>This is an game page</h1>
  </div>

  <div class="animate">
    <div class="circle">
      <svg
        ref="svgElement"
        xmlns="http://www.w3.org/2000/svg"
        width="80%"
        height="80%"
        viewBox="0 0 107 190"
        enable-background="new 0 0 107 190"
      >
        <circle
          fill="none"
          id="circle"
          stroke-dasharray="0 610 610 0"
          stroke-dashoffset="610"
          class="stat-outline-circle"
          stroke="#fff04b"
          stroke-width="8"
          stroke-miterlimit="10"
          cx="53"
          cy="56"
          r="48"
        ></circle>

        <animate
          attributeType="XML"
          xlink:href="#circle"
          id="circleanimate"
          attributeName="stroke-dashoffset"
          from="0"
          to="610"
          dur="1s"
          begin="0s"
          fill="freeze"
        />

        <animate
          attributeType="XML"
          xlink:href="#circle"
          id="circleanimate2"
          attributeName="stroke-dashoffset"
          from="610"
          to="0"
          dur="1s"
          begin="4s"
          fill="freeze"
        />
      </svg>
    </div>

    <div class="animateLine">
      <div class="row-line">
        <div class="r-line chocolate"></div>
        <div class="r-line success"></div>
        <div class="r-line danger"></div>
      </div>

      <div class="col-line">
        <div class="c-line info"></div>
        <div class="c-line tangerine"></div>
        <div class="c-line grap"></div>
      </div>
    </div>
  </div>

  <!-- <div class="box2"> -->
  <!-- <img
      class="boximg"
      src="https://img.lovepik.com/free-png/20210919/lovepik-cute-pig-image-png-image_400807463_wh1200.png"
      alt=""
    /> -->
  <!-- </div> -->
  <div class="Test1"></div>
</template>

<style lang="scss">
body {
  // position: relative;
  // overflow: hidden;

  .animate {
    .row-line {
      position: absolute;

      .r-line {
        height: 70px;
        width: 150vw;
        opacity: 0.7;
        margin-block: 3%;
        border-radius: 50px;
      }
    }

    .col-line {
      position: absolute;
      display: flex;
      flex-direction: row;
      justify-content: center;
      left: 0;
      right: 0;
      margin-inline: auto;

      .c-line {
        width: 70px;
        height: 150vh;
        opacity: 0.7;
        margin-inline: 3%;
        border-radius: 50px;
      }
    }

    .circle {
      position: absolute;
      display: flex;
      justify-content: center;
      top: 0;
      left: 0;
      right: 0;
      margin-inline: auto;
      opacity: 0.7;
    }
  }
}

// .box2 {
//   width: 300px;
//   height: 300px;
//   background-color: #3498db;

//   .boximg {
//     position: absolute;
//     width: 100%;
//     height: auto;
//   }
// }

.Test1 {
  width: 900px;
  height: 400px;
  background-image: url("../../public/img/register.png");
}
</style>

<script>
import gsap from "gsap";

export default {
  // methods: {
  //   hideCircle() {
  //     gsap.to(this.$refs.circleElement, {
  //       opacity: 0,
  //       delay: 0,
  //       duration: 0.1,
  //       onComplete: () => {
  //         this.$refs.circleElement.style.display = "none";
  //       },
  //     });
  //   },
  // },

  mounted() {
    setTimeout(() => {
      const circleElement = document.querySelector(".circle");
      if (circleElement) {
        circleElement.style.display = "none";
      }
    }, 5000);

    gsap.fromTo(
      ".chocolate",
      {
        x: "150%",
      },
      {
        x: "-150%",
        duration: 1,
        delay: 1,
      }
    );

    gsap.fromTo(
      ".success ",
      {
        x: "150%",
      },
      {
        x: "-150%",
        duration: 1,
        delay: 1.1,
      }
    );

    gsap.fromTo(
      ".danger",
      {
        x: "150%",
      },
      {
        x: "-150%",
        duration: 1,
        delay: 1.2,
      }
    );

    gsap.fromTo(
      ".info ",
      {
        y: "150%",
      },
      {
        y: "-160%",
        duration: 1,
        delay: 1.5,
      }
    );

    gsap.fromTo(
      ".tangerine  ",
      {
        y: "150%",
      },
      {
        y: "-160%",
        duration: 1,
        delay: 1.6,
      }
    );

    gsap.fromTo(
      ".grap   ",
      {
        y: "150%",
      },
      {
        y: "-160%",
        duration: 1,
        delay: 1.7,
      }
    );
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
