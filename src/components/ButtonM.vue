<template>
  <div class="medium">
    <button class="btn_m" @mouseover="changeButtonColor" :style="{ backgroundColor: buttonColor }"
                          @mouseleave="resetButtonColor">{{ HTMLInner }}</button>
  </div>
</template>

<script>
export default {
  props:{
    HTMLInner:{
      type: String,
      default:""
    }
  },
  data() {
    return {
      randomColor: ["#32c8e1", "#9164cd", "#4bc887", "#fff04b", "#ffbb33", "#dc4b55", "#a67c52"],
      buttonColor: "", // Initial button color
      defaultColor:"#fff"
    };
  },
  methods: {
    changeButtonColor() {
      const num = this.randomNo();
      this.buttonColor = this.randomColor[num];
    },
    resetButtonColor(){
      this.buttonColor = this.defaultColor
    },
    randomNo() {
      return Math.floor(Math.random() * this.randomColor.length);
    }
  }
};
</script>

<style scoped lang="scss">
@import "../assets/scss/main.scss";
.medium{
  width: 300px;
  height: 40px;
  button{
    line-height: 21px;
  }
}
</style>