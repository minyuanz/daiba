<template>
  <div class="about">

  </div>

  <div class="animate">
    <div class="circle">
      <svg
        ref="svgElement"
        xmlns="http://www.w3.org/2000/svg"
        width="40%"
        height="40%"
        viewBox="0 0 107 190"
        enable-background="new 0 0 107 190"
      >
        <circle
          fill="none"
          id="circle"
          stroke-dasharray="0 610 610 0"
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
          dur="1.5s"
          begin="1.2s"
          fill="freeze"
        />

        <!-- <animate
          attributeType="XML"
          xlink:href="#circle"
          id="circleanimate2"
          attributeName="stroke-dashoffset"
          from="610"
          to="0"
          dur="1s"
          begin="1.5s"
          fill="freeze"
        />   -->
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
  <div class="animateLineGroup">
        <div class="left">
          <div class="thick"></div>
          <div class="dark1 slim"></div>
          <div class="dark2 slim"></div>
          <div class="dark3 slim"></div>
          <div class="dark4 slim"></div>
          <div class="dark5 slim"></div>
          <div class="dark6 slim"></div>
          <div class="dark7 slim"></div>
          <div class="dark8 slim"></div>
          <div class="dark9 slim"></div>
        </div>
        <div class="right">
          <div class="dark9 slim"></div>
          <div class="dark8 slim"></div>
          <div class="dark7 slim"></div>
          <div class="dark6 slim"></div>
          <div class="dark5 slim"></div>
          <div class="dark4 slim"></div>
          <div class="dark3 slim"></div>
          <div class="dark2 slim"></div>
          <div class="dark1 slim"></div>
          <div class="thick"></div>
        </div>
  </div>




  <!-- <div class="box2"> -->
  <!-- <img
      class="boximg"
      src="https://img.lovepik.com/free-png/20210919/lovepik-cute-pig-image-png-image_400807463_wh1200.png"
      alt=""
    /> -->
  <!-- </div> -->
  <!-- <div class="Test1"></div> -->
</template>

<style lang="scss">
body {
  // position: relative;
  // overflow: hidden;

  .animate {
    position: fixed;
    top: 0;
    width: 100%;
    height: 100vh;
    backdrop-filter: blur(5px);
    background-color: #fff;
    opacity: 1;
    transition: opacity 1s ease;

    .row-line {
      height: 300px;
      position: absolute;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      inset: 0;
      margin: auto;

      .r-line {
        height: 70px;
        width: 200vw;
        // opacity: 0.7;
        border-radius: 50px;
      }
    }

    .col-line { 
      width: 300px;
      position: absolute;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      inset: 0;
      margin: auto;

      .c-line {
        width: 70px;
        height: 200vh;
        // opacity: 0.7;
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
      margin: auto;
      // transform: rotateZ(90deg);
      // opacity: 0.7;
    }
  }
}
.animateLineGroup{
    width: 100%;
    display: flex;
    justify-content: space-between;      
    position: relative;
    // overflow: hidden;
    .left{
        width: 18.75%;
        display: flex;
        justify-content: space-between;
        position: absolute;
        animation: fadeInLeft 3.5s ease-out 0s ;
      }
    .right{
      width: 18.75%;
        display: flex;
        right: 0;
        justify-content: space-between;
        position: absolute;
        animation: fadeInRight 3.5s ease-out 0s ;
    }
        .thick{
          width: 20%;
          height: 100vh;
          background-color: #000;
        }
        .slim{
          width: 6%;
        }
        .dark1{
          background-color: #1A1A1A;
        }
        .dark2{
          background-color: #323232;
        }
        .dark3{
          background-color: #4C4C4C;
        }
        .dark4{
          background-color: #666666;
        }
        .dark5{
          background-color: #808080;
        }
        .dark6{
          background-color: #9A9A9A;
        }
        .dark7{
          background-color: #B4B4B4;
        }
        .dark8{
          background-color: #CCCCCC;
        }
        .dark9{
          background-color: #E6E6E6;
        }

  }
@keyframes fadeInLeft{
    0%{ left: -100%;}
  100%{ left: 0;}
}
@keyframes fadeInRight{
    0%{ right: -100%;}
  100%{ right: 0;}
}
@keyframes fadeOut {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
// .fadeInLeft{
//   animation: fadeInLeft 2.5s ease-out 0s ;
// }
.fadeOut {
  animation: fadeOut 1.5s ease-in 0s; /* Apply the fadeOut animation */
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

// .Test1 {
//   width: 900px;
//   height: 400px;
//   background-image: url("../../public/img/register.png");
// }
</style>

<script>
import gsap from "gsap";

export default {
  methods: {
    // addClass(){
    //   document.document.querySelector('left').addClass('fadeInLeft')
    // }
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
  },
  computed: {
    // addClass(){
    //   const lineGroupElement = document.querySelector(".animateLineGroup");
    //   if(lineGroupElement) {
    //     lineGroupElement.style.display='flex'
    //     lineGroupElement.classList.add("fadeInLeft")} 
    // }
  },
  mounted() {
    setTimeout(() => {
      const circleElement = document.querySelector(".animate");
      if (circleElement) {
        circleElement.style.display = "none";
      }
    }, 4500);

    setTimeout(() => {
      const animateElement = document.querySelector(".animate");
      if (animateElement) {
        animateElement.classList.add("fadeOut");
      }
    }, 3000);

      
    gsap.fromTo(
      ".chocolate",
      {
        x: "150%",
      },
      {
        x: "-150%",
        duration: 1,
        delay: 0,
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
        delay: .2,
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
        delay: .4,
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
        delay:.6,
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
        delay: .8,
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
        delay: 1,
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
