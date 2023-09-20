
<template>
  <!-- 遊戲首頁 -->
  <transition name="fade" mode="out-in">
    <div class="gameHome" v-show="home">
      <div class="home">
        <img src="@/assets/images/game/station_AM.jpg" alt="home">
      </div>
      <img src="../assets/images/game/gameLogo.png" alt="gameLogo" class="gameLogo">
      <button class="start btn_s" @click="closeName = !closeName">start</button>
      <div class="name" v-show="closeName">
        <p>請輸入ID</p>
        <input type="text" maxlength="8" v-model="userName">
        <button class="btn_s" @click="checkName">OK</button>
      </div>
    </div>
  </transition>

  <!-- 遊戲內容 -->
  <transition name="fade" mode="out-in">
    <div class="gameInner">
      <img :src="currentMessage.image" alt="Character Image" class="character-image" />
      <div class="speechBalloon">
        <p>{{ currentMessage.text }}</p>
        <span>▼</span>
      </div>
    </div>

  </transition>


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
        { id: 1, text: "在一個寧靜的城市中，你想著要去旅行，但卻不知去向，突然聽到了遠處傳來的低沉隆隆聲，彷彿你的冒險即將開始，你抬頭望向遠處，發現一輛神秘的電車正等待著你的到來。你將迎著這趟神秘的旅行搭上車了，不知道它將帶領你前往何方......", image: require("@/assets/images/game/station_AM2.jpg") },
        { id: 2, text: "二", image: require("@/assets/images/game/station_AM2.jpg") },
      ],
      currentMessageIndex: 0,
      userName: '',
      closeName: false,
      home: true,
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
    checkName() {
      if (this.userName !== '') {
        this.home = false
        this.closeName = false
      } else {
        alert('請輸入您的名字')
      }
    }

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

