
<template>
  <!-- 遊戲首頁 -->
  <transition name="fade" mode="out-in">
    <div class="gameHome" v-show="home">
      <div class="home">
        <img src="@/assets/images/game/station_AM.jpg" alt="home">
      </div>
      <img src="../assets/images/game/gameLogo.png" alt="gameLogo" class="gameLogo">
      <ButtonS class="start" :HTMLInner="btninner[0]" @click="closeName = !closeName"/>      
      <!-- <button class="start btn_s" @click="closeName = !closeName">start</button> -->
      <div class="name" v-show="closeName">
        <p>請輸入ID</p>
        <input type="text" maxlength="8" v-model="userName">      
        <ButtonS class="btn_s" :HTMLInner="btninner[1]" @click="checkName"/>      
        <!-- <button class="btn_s" @click="checkName">OK</button> -->
      </div>
    </div>
  </transition>

  <!-- 遊戲內容 -->
  <transition name="fade" mode="out-in">
    <div class="gameInner" @click="nextMessage" v-show="Inner">
      <img :src="currentMessage.image" alt="Character Image" class="character-image" />
      <div class="speechBalloon">
        <p :class="{ 'inputTxt': inputTxt }" :key="txtKey" @transitionend="animationEnd">{{
          currentMessage.text }}</p>
        <span>▼</span>
      </div>
    </div>

  </transition>
</template>

<script>
import ButtonS from '@/components/ButtonS.vue'
export default {
  data() {
    return {
      btninner:["START","OK"],
      messages: [],  //對話內容
      currentMessageIndex: 0, //對話內容索引值
      userName: '', //使用者名稱
      closeName: false, //關閉填寫名稱欄位
      home: true, //遊戲首頁
      Inner: false, //遊戲內頁
      inputTxt: true, //文字打字機動畫
      txtKey: 1, //重新瑄染文字讓動畫可以重跑
    };
  },
  components:{
    ButtonS
  },
  computed: {
    // 帶出當前對話內容索引值
    currentMessage() {
      return this.messages[this.currentMessageIndex];
    },
  },
  created() {
    this.messages = [
      {
        id: 1,
        text: "在一個寧靜的城市中，你想著要去旅行，但卻不知去向，突然聽到了遠處傳來的低沉隆隆聲，彷彿你的冒險即將開始，你抬頭望向遠處，發現一輛神秘的電車正等待著你的到來。你將迎著這趟神秘的旅行搭上車了，不知道它將帶領你前往何方......",
        image: require("@/assets/images/game/station_AM2.jpg"),
      },
      {
        id: 2,
        text: "...",
        image: require("@/assets/images/game/station_AM2.jpg"),
      },
      {
        id: 3,
        text: `${this.userName}突然腦袋一片空白不知不覺的搭上了電車...`,
        image: require("@/assets/images/game/black.jpg"),
      },
      {
        id: 4,
        text: "醒來時自己已經在車上，覺得很不安也很興奮的不知道會往哪裡去",
        image: require("@/assets/images/game/carriage_AM.jpg"),
      },
      {
        id: 5,
        text: "",
        image: require("@/assets/images/game/carriage_AM.jpg")
      },
      {
        id: 6,
        text: "",
        image: require("@/assets/images/game/black.jpg")
      },
    ];
    // this.messages[2].text = `${this.userName}突然腦袋一片空白不知不覺的搭上了電車...`;
    // this.messages[4].text = `${this.userName}找了個空位坐了下來，突然有人走了過來`;
  },
  methods: {
    // 換下一個內容
    nextMessage() {
      if (!this.inputTxt) {
        if (this.currentMessageIndex < this.messages.length - 1) {
          this.currentMessageIndex++;
          // this.inputTxt = true;
          this.inputTxt = true;
          this.txtKey++
        }
      } else {
        this.inputTxt = false;
      }
    },
    checkName() {
      if (this.userName !== '') {
        this.home = false;
        this.closeName = false;
        this.Inner = true;
        this.updateComputedText()
      } else {
        alert('請輸入您的名字');
      }
    },
    // 動畫跑完取消p標籤class
    animationEnd() {
      this.inputTxt = false;
    },
    updateComputedText() {
      this.messages[2].text = `${this.userName}突然腦袋一片空白不知不覺的搭上了電車...`;
    },
  },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .5s;
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

