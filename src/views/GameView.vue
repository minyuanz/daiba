
<template>
  <div class="gameWrapper">
    <div class="home">
      <transition name="fade" mode="out-in">
        <img :src="currentMessage.image" alt="">

      </transition>
    </div>
    <img src="../assets/images/game/gameLogo.png" alt="gameLogo" class="gameLogo">
    <button class="start btn_s" @click="closeName = !closeName">start</button>
    <div class="name" v-show="closeName">
      <p>請輸入ID</p>
      <input type="text" maxlength="8" v-model="userName">
      <button class="btn_s" @click="closeName = !closeName">OK</button>
    </div>



  </div>












  <div>
    <transition name="fade" mode="out-in">
      <div :key="currentMessage.id" class="message-container">
        <img :src="currentMessage.image" alt="Character Image" class="character-image" />
        <p>{{ currentMessage.text }}</p>
      </div>
    </transition>
    <!-- <button @click="nextMessage">下一句</button> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      messages: [
        { id: 1, text: "一", image: require("@/assets/images/game/station_AM.jpg") },
        { id: 2, text: "二", image: "./img/news4.png" },
        // 添加更多的对话消息
      ],
      currentMessageIndex: 0,
      userName: '',
      closeName:false,
    };
  },
  computed: {
    currentMessage() {
      return this.messages[this.currentMessageIndex];
    },
  },
  methods: {
    nextMessage() {
      if (this.currentMessageIndex < this.messages.length - 1) {
        this.currentMessageIndex++;
      }
    },

  },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.message-container {
  display: flex;
  align-items: center;
}

.character-image {
  width: 100px;
  height: 100px;
  margin-right: 10px;
}
</style>
