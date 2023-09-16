<template>
  <div class="mrtTitle">
    <h1>捷運推薦</h1>
  </div>

  <section class="mrtLineCheck">
    <div class="mrtPic">
      <div class="pic mrtGrayStyle border-brownline">
        <img src="../../public/img/brown.jpeg" alt="brownline" />
      </div>
      <div class="pic mrtGrayStyle border-yellowline">
        <img src="../../public/img/yellow.jpeg" alt="yellowline" />
      </div>

      <div class="mrtMainLine">
        <div
          class="pic border-redline"
          @click="showTag('red')"
          @mouseenter="activate('red')"
          @mouseleave="deactivate('red')"
          :class="{ active: isActive.red }"
        >
          <img src="../../public/img/red.jpeg" alt="redline" />
        </div>
        <div
          class="pic border-blueline"
          @click="showTag('blue')"
          @mouseenter="activate('blue')"
          @mouseleave="deactivate('blue')"
          :class="{ active: isActive.blue }"
        >
          <img src="../../public/img/blue.jpeg" alt="blueline" />
        </div>
        <div
          class="pic border-greenline"
          @click="showTag('green')"
          @mouseenter="activate('green')"
          @mouseleave="deactivate('green')"
          :class="{ active: isActive.green }"
        >
          <img src="../../public/img/green.jpeg" alt="greenline" />
        </div>
        <div
          class="pic border-orangeline"
          @click="showTag('orange')"
          @mouseenter="activate('orange')"
          @mouseleave="deactivate('orange')"
          :class="{ active: isActive.orange }"
        >
          <img src="../../public/img/orange.jpeg" alt="orangeline" />
        </div>
        <div
          class="pic border-brownline"
          @click="showTag('brown')"
          @mouseenter="activate('brown')"
          @mouseleave="deactivate('brown')"
          :class="{ active: isActive.brown }"
        >
          <img src="../../public/img/brown.jpeg" alt="brownline" />
        </div>
        <div
          class="pic border-yellowline"
          @click="showTag('yellow')"
          @mouseenter="activate('yellow')"
          @mouseleave="deactivate('yellow')"
          :class="{ active: isActive.yellow }"
        >
          <img src="../../public/img/yellow.jpeg" alt="yellowline" />
        </div>
      </div>
      <div class="pic mrtGrayStyle border-redline">
        <img src="../../public/img/red.jpeg" alt="redline" />
      </div>
      <div class="pic mrtGrayStyle border-blueline">
        <img src="../../public/img/blue.jpeg" alt="blueline" />
      </div>
    </div>

    <div v-if="MB" class="mrtTag">
      <div
        class="title-tag"
        v-for="(color, index) in selectColor"
        :key="color"
        :class="({ active: selectColor === color }, color)"
        v-show="showAll || selectColor == color"
      >
        {{ upperCaseColorsMB[index] }}
      </div>
    </div>

    <div v-if="PC" class="mrtTag">
      <div
        class="title-tag"
        v-for="(color, index) in selectColor"
        :key="color"
        :class="({ active: selectColor === color }, color)"
        v-show="showAll || selectColor == color"
      >
        {{ upperCaseColorsPC[index] }}
      </div>
    </div>
  </section>

  <div class="mrtBanner">
    <div class="swiper" id="mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for=" in 20">
          <img
            src="../../public/img/mrtArrow.png"
            alt=""
            @load="initializeSwiper"
          />
        </div>
      </div>
    </div>
  </div>

  <div class="mrtBanner">
    <div class="swiper" id="mySwiper2">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for=" in 20">
          <img
            src="../../public/img/mrtArrow.png"
            alt=""
            @load="initializeSwiper"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swiper from "swiper/bundle";

export default {
  data() {
    return {
      selectColor: ["red", "blue", "green", "orange", "brown", "yellow"],
      showAll: true,
      src: "../../public/img/mrtArrow.jpg",
      PC: false,
      MB: false,
      isActive: {
        red: false,
        blue: false,
        green: false,
        orange: false,
        brown: false,
        yellow: false,
      },
    };
  },

  mounted() {
    const swiper = new Swiper(".swiper", {
      direction: "vertical",
      speed: 3000,
      loop: true,
      autoHeight: true,
      slidesPerView: "auto",
      spaceBetween: 0,
      observer: true,
      observerParents: true,
      disableOnInteraction: false,
      autoplay: {
        delay: 0,
        pauseOnMouseEnter: false,
        disableOnInteraction: false,
      },
    });
    this.WindowWidth();
    window.addEventListener("resize", this.WindowWidth);
  },
  methods: {
    activate(color) {
      this.isActive[color] = true;
    },
    deactivate(color) {
      this.isActive[color] = false;
    },
    showTag(color) {
      if (window.innerWidth <= 768) {
        this.selectColor = color;
        this.showAll = false;
      } else {
        this.selectColor = [
          "red",
          "blue",
          "green",
          "orange",
          "brown",
          "yellow",
        ];
        this.showAll = true;
      }
    },

    WindowWidth() {
      if (window.innerWidth <= 768) {
        this.MB = true;
        this.PC = false;
      } else {
        this.PC = true;
        this.MB = false;
      }
    },
  },

  computed: {
    upperCaseColorsMB() {
      return this.selectColor.map((color) =>
        color.toUpperCase().substring(0, 2)
      );
    },
    upperCaseColorsPC() {
      return this.selectColor.map((color) => color.toUpperCase());
    },
  },
};
</script>

<style>
.active {
  animation: flash 350ms linear;
}

.title-tag:hover ~ .pic.active {
  animation: flash 350ms linear;
}

@keyframes flash {
  0% {
    filter: brightness(100%);
  }
  20% {
    filter: brightness(150%);
  }
  40% {
    filter: brightness(100%);
  }
  60% {
    filter: brightness(150%);
  }
  80% {
    filter: brightness(100%);
  }
  100% {
    filter: brightness(150%);
  }
}
</style>
