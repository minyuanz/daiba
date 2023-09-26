
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
    <div class="gameInner" v-show="Inner">
      <transition>
        <img :src="currentMessage.image" alt="Character Image" class="character-image" />
      </transition>
      <!-- 對話框角色 -->
      <div class="name" v-show="closeName">
        <p v-if="currentMessage.vo">???</p>
        <p v-if="currentMessage.user">{{ userName }}</p>
        <p v-if="currentMessage.npc">NPC</p>
      </div>
      <!-- 對話框 -->
      <div class="speechBalloon" @click="nextMessage" v-show="closeBalloon">
        <p :class="{ 'inputTxt': inputTxt }" :key="txtKey" @transitionend="animationEnd">{{
          currentMessage.text }}</p>
        <span class="nextBtn">▼</span>
      </div>
      <!-- 選項 -->
      <div class="optionsLightbox" v-if="options">
        <div v-if="options" class="option">
          <!-- 主選擇 -->
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), options = !options">吃美食</button>
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), options = !options">逛景點</button>
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), options = !options">住宿放鬆</button>

          <!-- 隨身物品(捷運線) -->
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), options = !options">大都市</button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), options = !options">一般都市</button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), options = !options">公寓住宅區</button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), options = !options">涼爽鄉下</button>
        </div>
      </div>

      <!-- 讀取畫面 -->
      <div class="loading" v-show="loadingTime() || loading">
        <svg xmlns="http://www.w3.org/2000/svg" width="600">
          <g class="animation-group">
            <rect class="box" width="50" height="50" rx="4" /><text class="text"
              transform="translate(10.12 35.19)">L</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="60" width="50" height="50" rx="4" /><text class="text"
              transform="translate(68.68 35.19)">O</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="120" width="50" height="50" rx="4" /><text class="text"
              transform="translate(128.22 35.19)">A</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="180" width="50" height="50" rx="4" />
            <text class="text" transform="translate(188.41 35.19)">D</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="240" width="50" height="50" rx="4" /><text class="text"
              transform="translate(259.06 35.19)">I</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="300" width="50" height="50" rx="4" /><text class="text"
              transform="translate(308.83 35.19)">N</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="360" width="50" height="50" rx="4" /><text class="text"
              transform="translate(368.14 35.19)">G</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="420" width="50" height="50" rx="4" /><text class="text"
              transform="translate(428.14 35.19)">.</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="480" width="50" height="50" rx="4" /><text class="text"
              transform="translate(488.14 35.19)">.</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="540" width="50" height="50" rx="4" /><text class="text"
              transform="translate(548.14 35.19)">.</text>
          </g>
        </svg>
      </div>

    </div>
  </transition>
</template>

<script>
import { faRuler } from '@fortawesome/free-solid-svg-icons';

export default {
  data() {
    return {
      messages: [],  //對話內容
      currentMessageIndex: 0, //對話內容索引值
      userName: '222', //使用者名稱
      closeName: false, //關閉填寫名稱欄位
      home: false, //遊戲首頁
      Inner: true, //遊戲內頁
      inputTxt: true, //文字打字機動畫
      txtKey: 1, //重新瑄染文字讓動畫可以重跑
      aim: "", //目的
      line: "", //捷運線
      options: false, //選擇視窗
      aimOption: false, //主選項
      lineOption: false, //捷運選項
      closeBalloon: true, //關閉對話框
      closeName: true, //關閉對話框角色名
      loading: false, //讀取
    };
  },
  computed: {
    // 帶出當前對話內容索引值
    currentMessage() {
      return this.messages[this.currentMessageIndex];
    },
  },
  watch: {
    currentMessageIndex(newValue) {
      if (newValue === 9) {
        // 在这里执行您希望执行的操作
        this.options = true;
        this.aimOption = true;
      } else if (newValue === 14) {
        // 在这里执行您希望执行的操作
        this.options = true;
        this.aimOption = false;
        this.lineOption = true;
      }
    }
  },
  created() {
    this.messages = [
      {
        id: 1,
        text: "在一個城市中，你想著要去旅行，但卻不知去向，突然聽到了遠處傳來的低沉隆隆聲，彷彿你的冒險即將開始，你抬頭望向遠處，發現一輛神秘的電車正等待著你的到來。你將迎著這趟神秘的旅行搭上車了，不知道它將帶領你前往何方......",
        image: require("@/assets/images/game/station_AM2.jpg"),
        vo: true,
      },
      {
        id: 2,
        text: "...",
        image: require("@/assets/images/game/station_AM2.jpg"),
        vo: true,
      },
      {
        id: 3,
        text: `${this.userName}突然腦袋一片空白不知不覺的搭上了電車...`,
        image: require("@/assets/images/game/black.jpg"),
        vo: true,
      },
      {
        id: 4,
        text: "醒來時自己已經在車上，覺得很不安也很興奮的不知道會往哪裡去。",
        image: require("@/assets/images/game/carriage_AM.jpg"),
        vo: true,
      },
      {
        id: 5,
        text: "沒辦法先找個位置坐吧。",
        image: require("@/assets/images/game/carriage_AM.jpg"),
        user: true,
      },
      {
        id: 6,
        text: "突然有人朝你走了過來...",
        image: require("@/assets/images/game/black.jpg"),
        vo: true,
      },
      {
        id: 7,
        text: "太好了！我們終於有新乘客了...",
        image: require("@/assets/images/game/carriage_AM.jpg"),
        npc: true,
      },
      {
        id: 8,
        text: "你是...?",
        image: require("@/assets/images/game/carriage_AM.jpg"),
        user: true,
      },
      {
        id: 9,
        text: "我是這次冒險中你的導遊，請問你想要前往哪個服務呢？",
        image: require("@/assets/images/game/carriage_AM.jpg"),
        npc: true,
        mainOption: true,
      },
      {
        id: 10,
        text: "",
        image: require("@/assets/images/game/carriage_AM.jpg"),
        user: true,
        mainOption: true,
      },

      // 美食
      {
        id: 11,
        text: "沒問題！車掌請前往美食之旅，加速前進！",
        image: require("@/assets/images/game/carriage_AM.jpg"),
        npc: true,
      },
      {
        id: 12,
        text: 'loading',
        image: require("@/assets/images/game/tunnel.jpg"),
        npc: true,

      },
      {
        id: 13,
        text: `冒昧問一下，請問${this.userName}住在哪裡呢？`,
        image: require("@/assets/images/game/tunnel.jpg"),
        npc: true,

      },
      {
        id: 14,
        text: "依你現在的心情，你會選擇住在？",
        image: require("@/assets/images/game/tunnel.jpg"),
        vo: true,
      },
      {
        id: 14,
        text: "",
        image: require("@/assets/images/game/tunnel.jpg"),
        user: true,

      },
      {
        id: 15,
        text: "原來如此！你真是幸福的傢伙。哼哼。好的我們也差不多要到目的地了。",
        image: require("@/assets/images/game/exit.jpg"),
        npc: true,
      },
      {
        id: 16,
        text: "RRRRRRRRRRRRRRRRRRR我的眼睛，出口好刺眼！",
        image: require("@/assets/images/game/exit.jpg"),
        npc: true,
        user: true,
      },
      {
        id: 17,
        text: `${this.userName}你看！是白天欸，`,
        image: require("@/assets/images/game/tokai.png"),
        npc: true,
      },
    ];
  },
  methods: {
    // 換下一個內容
    nextMessage() {
      if (!this.inputTxt) { //判斷動畫是否跑完
        if (this.currentMessageIndex < this.messages.length - 1) {
          this.currentMessageIndex++;
          this.inputTxt = true;
          this.txtKey++
          console.log(this.currentMessageIndex)
        }
      } else {
        this.inputTxt = false; //沒跑完的話取消class名稱，立即顯示出對話內容
      }
    },
    //確認名字
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
    // 動畫跑完取消class
    animationEnd() {
      this.inputTxt = false;
    },
    //更新內容的userName
    updateComputedText() {
      this.messages[2].text = `${this.userName}突然腦袋一片空白不知不覺的搭上了電車...`;
      this.messages[13].text = `冒昧問一下，請問${this.userName}住在哪裡呢？`;
      this.messages[16].text = `${this.userName}你看！是白天欸，`;
    },
    //決定目的
    decideAim(event) {
      let aim = event.target.innerText;
      if (aim === '吃美食') {
        this.aim = "美食"
        this.inputTxt = false;
        this.nextMessage()

      } else if (aim === '逛景點') {

        this.aim = "景點"
        this.inputTxt = false;
        this.nextMessage()

      } else if (aim === '輕鬆住宿') {
        this.aim = "住宿"
        this.inputTxt = false;
        this.nextMessage()

      }

    },

    // 捷運路線
    decideLine(event) {
      let line = event.target.innerText;
      if (line === '大都市') {
        this.line = ["淡水信義線", "板南線"]
        this.inputTxt = false;
        this.nextMessage()

      } else if (line === '一般都市') {

        this.line = ["板南線", "松山新店線"]
        this.inputTxt = false;
        this.nextMessage()

      } else if (line === '公寓住宅區') {
        this.line = ["中和新蘆線", "環狀線", "松山新店線"]
        this.inputTxt = false;
        this.nextMessage()

      } else if (line === '涼爽鄉下') {
        this.line = ["文湖線", "松山新店線"]
        this.inputTxt = false;
        this.nextMessage()

      }
    },

    // 讀取條
    loadingTime() {

      if (this.currentMessageIndex === 11) {
        this.closeName = false;
        this.closeBalloon = false;
        this.loading = true;
        setTimeout(() => {
          this.nextMessage()
        }, 2000);
      }
      else if (this.currentMessageIndex !== 11) {
        this.loading = false
        this.closeName = true;
        this.closeBalloon = true;

      }

    }
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/page/game";
</style>


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

