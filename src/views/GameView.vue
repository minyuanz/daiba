
<template>
  <!-- 遊戲首頁 -->
  <transition name="fade" mode="out-in">
    <div class="gameHome" v-show="home">
      <div class="home">
        <img src="@/assets/images/game/station_AM.jpg" alt="home">
      </div>
      <img src="../assets/images/game/gameLogo.png" alt="gameLogo" class="gameLogo">
      <!-- <ButtonS class="start" :HTMLInner="btninner[0]" @click="closeName = !closeName" /> -->
      <button class="start btn_s" @click="closeName = !closeName">start</button>
      <div class="name" v-show="closeName">
        <p>請輸入ID</p>
        <input type="text" maxlength="8" v-model="userName">
        <!-- <ButtonS class="btn_s" :HTMLInner="btninner[1]" @click="checkName" /> -->
        <button class="btn_s" @click="checkName">OK</button>
      </div>
    </div>
  </transition>

  <!-- 遊戲內容 -->
  <transition name="fade" mode="out-in">
    <div class="gameInner" v-if="Inner">
      <transition>
        <img :src="currentMessage.image" alt="Character Image" class="character-image" />
      </transition>
      <!-- 對話框角色 -->
      <div class="name" v-show="closeTxtName">
        <p v-if="currentMessage.vo">???</p>
        <p v-if="currentMessage.user">{{ userName }}</p>
        <p v-if="currentMessage.npc">NPC</p>
      </div>
      <!-- 對話框 -->
      <div class="speechBalloon" @click="nextMessage" v-show="closeBalloon">
        <!-- <p :class="{ 'inputTxt': inputTxt }" :key="txtKey" @transitionend="animationEnd">{{
          currentMessage.text }}</p> -->
        <p>{{ currentText.join('') }}</p>
        <span class="nextBtn">▼</span>
      </div>
      <!-- 選項 -->
      <div class="lightbox" v-if="options">
        <div v-if="options" class="option">
          <!-- 主選擇 -->
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), options = !options">吃美食</button>
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), options = !options">逛景點</button>
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), options = !options">住宿放鬆</button>

          <!-- 住處(捷運線) -->
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), options = !options">大都市</button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), options = !options">一般都市</button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), options = !options">公寓住宅區</button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), options = !options">涼爽鄉下</button>

          <!-- 是與否 -->
          <button v-if="yes_OR_no_Option" class="btn_s" @click="chikinOption = true, yes_OR_no_Option = false">是</button>
          <button v-if="yes_OR_no_Option" class="btn_s"
            @click="options = !options, nextMessage(), nextMessage(), chikinshop = false">否</button>

          <!-- 鹹酥雞 -->
          <button v-if="chikinOption" class="btn_s" @click="decideChikin($event), options = !options">炸雞排</button>
          <button v-if="chikinOption" class="btn_s" @click="decideChikin($event), options = !options">炸薯條</button>
          <button v-if="chikinOption" class="btn_s" @click="decideChikin($event), options = !options">茶葉蛋</button>
        </div>
      </div>

      <!-- 插圖 -->
      <img class="chikinshop" src="~@/assets/images/game/chikin.png" alt="鹹酥雞" v-show="chikinshop">


      <!-- 獲得物品的彈窗 -->
      <div class="lightbox" v-show="openBag">
        <div class="bag">
          <p>獲得了</p>
          <!-- <img src="~@/assets/images/game/flightChikin.png" alt=""> -->
          <img :src="item" alt="物品">
          <button class="btn_s" @click="openBag = !openBag, nextMessage()">關閉</button>
        </div>
      </div>

      <!-- 結束畫面 -->
      <div class="end" v-show="openEnd">
        <p>冒險的一天結束了！</p>
        <p>根據你的冒險路線，你可以選擇...</p>
        <div class="station">
          <div class="FrontCard">
            <img src="../../public/img/logo.png" alt="logo">
          </div>
          <div class="backCard">

          </div>
        </div>

        <div class="info">
          <div class="FrontCard">
            <img src="../../public/img/logo.png" alt="logo">
          </div>
          <div class="backCard">
            <div class="card-h border-r">
              <div class="img">
                <img src="https://picsum.photos/280/200/?random=10" />
              </div>
              <div class="text">
                <div class="title">
                  <h3>原來京站樓上長這樣？</h3>
                  <p>開箱五星級行政豪華客房一泊二食</p>
                </div>
              </div>
            </div>

          </div>
        </div>
        
        <div class="btn">
          <button class="btn_s" @click="resetGame">再次冒險</button>
        </div>
      </div>


      <!-- 讀取畫面 -->
      <div class="loading" v-show="loading">
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
import ButtonS from '@/components/ButtonS.vue'
import { faRuler } from '@fortawesome/free-solid-svg-icons';

export default {
  data() {
    return {
      btninner: ["START", "OK"],
      currentMessageIndex: 34, //對話內容索引值
      userName: '', //使用者名稱
      closeName: false, //關閉填寫名稱欄位
      home: false, //遊戲首頁
      Inner: true, //遊戲內頁
      closeTxtName: true, //關閉對話框角色名
      inputTxt: true, //文字打字機動畫
      txtKey: 1, //重新瑄染文字讓動畫可以重跑

      // 需帶出的物件
      aim: "", //目的
      line: "", //捷運線


      // 選項
      options: false, //選擇視窗
      aimOption: false, //主選項
      lineOption: false, //捷運選項
      yes_OR_no_Option: false, //是否選項
      chikinOption: false,

      // 插圖
      chikinshop: false, //鹹酥雞店
      item: '', //鹹酥雞店

      // 彈窗
      openBag: false,
      openEnd: false,

      // loading
      closeBalloon: true, //關閉對話框
      loading: false, //讀取
      messages: [  //對話內容
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
          id: 15,
          text: "",
          image: require("@/assets/images/game/tunnel.jpg"),
          user: true,

        },
        {
          id: 16,
          text: "原來如此！你真是幸福的傢伙。哼哼。好的我們也差不多要到目的地了。",
          image: require("@/assets/images/game/exit.jpg"),
          npc: true,
        },
        {
          id: 17,
          text: "RRRRRRRRRRRRRRRRRRR我的眼睛，出口好刺眼！",
          image: require("@/assets/images/game/exit.jpg"),
          npc: true,
          user: true,
        },
        {
          id: 18,
          text: `${this.userName}你看！是白天欸，台北馬路如虎口，大家要小心哦！`,
          image: require("@/assets/images/game/tokai.png"),
          npc: true,
        },
        {
          id: 19,
          text: "好...",
          image: require("@/assets/images/game/tokai.png"),
          user: true,
        },
        {
          id: 20,
          text: "咳咳...好的，美食可以選擇高級餐廳...",
          image: require("@/assets/images/game/chuuka.jpg"),
          npc: true,
        },
        {
          id: 21,
          text: "或是吵雜的快炒店、居酒屋...",
          image: require("@/assets/images/game/izakaya.jpg"),
          npc: true,
        },
        {
          id: 22,
          text: "或是好玩又好吃又吵雜的夜市！",
          image: require("@/assets/images/game/yoichi.jpg"),
          npc: true,
        },
        {
          id: 23,
          text: `齁齁齁齁，給你近距離看一眼！${this.userName}你肚子餓了吧！`,
          image: require("@/assets/images/game/yoichi-2.jpg"),
          npc: true,
        },
        {
          id: 24,
          text: "不然也可以選擇街道的小吃店。不過要注意...",
          image: require("@/assets/images/game/michi.jpg"),
          npc: true,
        },
        {
          id: 25,
          text: "台北很潮濕，要小心下雨！！",
          image: require("@/assets/images/game/michi-2.jpg"),
          npc: true,
        },
        {
          id: 26,
          text: "眼前遇到了超好吃鹽酥雞店，請問你有要購買嗎？",
          image: require("@/assets/images/game/michi.jpg"),
          vo: true,
        },
        {
          id: 27,
          text: "",
          image: require("@/assets/images/game/michi.jpg"),
          user: true,
        },
        {
          id: 28,
          text: "好的！今天的旅程也該結束了，我們上車吧！",
          image: require("@/assets/images/game/michi.jpg"),
          npc: true,
        },
        {
          id: 29,
          text: "感謝你搭乘我們的捷運冒險旅程，今天真是開心的一天。",
          image: require("@/assets/images/game/carriage_DUSK.jpg"),
          npc: true,
        },
        {
          id: 30,
          text: `下一站，${this.userName}的家站，左側開門。`,
          image: require("@/assets/images/game/carriage_DUSK.jpg"),
          vo: true,
        },
        {
          id: 31,
          text: "！！！？",
          image: require("@/assets/images/game/carriage_DUSK.jpg"),
          user: true,
        },
        {
          id: 32,
          text: "逼逼逼逼逼逼逼逼！登登！",
          image: require("@/assets/images/game/station_DUSK.jpg"),
          vo: true,
        },
        {
          id: 33,
          text: `再會了，${this.userName}。`,
          image: require("@/assets/images/game/station_DUSK.jpg"),
          npc: true,
        },
        {
          id: 34,
          text: "",
          image: require("@/assets/images/game/room.jpg"),
          user: true,
        },
        {
          id: 35,
          text: "原來我在做夢啊...算了，也滿開心的！",
          image: require("@/assets/images/game/room.jpg"),
          user: true,
        },
        {
          id: 36,
          text: "",
          image: require("@/assets/images/game/HOME_PM.jpg"),
          user: true,
        },
      ],
      currentText: [],
      timer: null,
      idx: 0,
    };
  },

  computed: {
    // 帶出當前對話內容索引值
    currentMessage() {
      return this.messages[this.currentMessageIndex];
    },
  },
  // created() {
  // this.messages = [
  //   {
  //     id: 1,
  //     text: "在一個城市中，你想著要去旅行，但卻不知去向，突然聽到了遠處傳來的低沉隆隆聲，彷彿你的冒險即將開始，你抬頭望向遠處，發現一輛神秘的電車正等待著你的到來。你將迎著這趟神秘的旅行搭上車了，不知道它將帶領你前往何方......",
  //     image: require("@/assets/images/game/station_AM2.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 2,
  //     text: "...",
  //     image: require("@/assets/images/game/station_AM2.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 3,
  //     text: `${this.userName}突然腦袋一片空白不知不覺的搭上了電車...`,
  //     image: require("@/assets/images/game/black.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 4,
  //     text: "醒來時自己已經在車上，覺得很不安也很興奮的不知道會往哪裡去。",
  //     image: require("@/assets/images/game/carriage_AM.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 5,
  //     text: "沒辦法先找個位置坐吧。",
  //     image: require("@/assets/images/game/carriage_AM.jpg"),
  //     user: true,
  //   },
  //   {
  //     id: 6,
  //     text: "突然有人朝你走了過來...",
  //     image: require("@/assets/images/game/black.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 7,
  //     text: "太好了！我們終於有新乘客了...",
  //     image: require("@/assets/images/game/carriage_AM.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 8,
  //     text: "你是...?",
  //     image: require("@/assets/images/game/carriage_AM.jpg"),
  //     user: true,
  //   },
  //   {
  //     id: 9,
  //     text: "我是這次冒險中你的導遊，請問你想要前往哪個服務呢？",
  //     image: require("@/assets/images/game/carriage_AM.jpg"),
  //     npc: true,
  //     mainOption: true,
  //   },
  //   {
  //     id: 10,
  //     text: "",
  //     image: require("@/assets/images/game/carriage_AM.jpg"),
  //     user: true,
  //     mainOption: true,
  //   },

  //   // 美食
  //   {
  //     id: 11,
  //     text: "沒問題！車掌請前往美食之旅，加速前進！",
  //     image: require("@/assets/images/game/carriage_AM.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 12,
  //     text: 'loading',
  //     image: require("@/assets/images/game/tunnel.jpg"),
  //     npc: true,

  //   },
  //   {
  //     id: 13,
  //     text: `冒昧問一下，請問${this.userName}住在哪裡呢？`,
  //     image: require("@/assets/images/game/tunnel.jpg"),
  //     npc: true,

  //   },
  //   {
  //     id: 14,
  //     text: "依你現在的心情，你會選擇住在？",
  //     image: require("@/assets/images/game/tunnel.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 14,
  //     text: "",
  //     image: require("@/assets/images/game/tunnel.jpg"),
  //     user: true,

  //   },
  //   {
  //     id: 15,
  //     text: "原來如此！你真是幸福的傢伙。哼哼。好的我們也差不多要到目的地了。",
  //     image: require("@/assets/images/game/exit.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 16,
  //     text: "RRRRRRRRRRRRRRRRRRR我的眼睛，出口好刺眼！",
  //     image: require("@/assets/images/game/exit.jpg"),
  //     npc: true,
  //     user: true,
  //   },
  //   {
  //     id: 17,
  //     text: `${this.userName}你看！是白天欸，台北馬路如虎口，大家要小心哦！`,
  //     image: require("@/assets/images/game/tokai.png"),
  //     npc: true,
  //   },
  //   {
  //     id: 18,
  //     text: "好...",
  //     image: require("@/assets/images/game/tokai.png"),
  //     user: true,
  //   },
  //   {
  //     id: 19,
  //     text: "咳咳...好的，美食可以選擇高級餐廳...",
  //     image: require("@/assets/images/game/chuuka.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 20,
  //     text: "或是吵雜的快炒店、居酒屋...",
  //     image: require("@/assets/images/game/izakaya.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 21,
  //     text: "或是好玩又好吃又吵雜的夜市！",
  //     image: require("@/assets/images/game/yoichi.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 22,
  //     text: `齁齁齁齁，給你近距離看一眼！${this.userName}你肚子餓了吧！`,
  //     image: require("@/assets/images/game/yoichi-2.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 23,
  //     text: "不然也可以選擇街道的小吃店。不過要注意...",
  //     image: require("@/assets/images/game/michi.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 24,
  //     text: "台北很潮濕，要小心下雨！！",
  //     image: require("@/assets/images/game/michi-2.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 25,
  //     text: "眼前遇到了超好吃鹽酥雞店，請問你有要購買嗎？",
  //     image: require("@/assets/images/game/michi.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 26,
  //     text: "",
  //     image: require("@/assets/images/game/michi.jpg"),
  //     user: true,
  //   },
  //   {
  //     id: 27,
  //     text: "好的！今天的旅程也該結束了，我們上車吧！",
  //     image: require("@/assets/images/game/michi.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 27,
  //     text: "感謝你搭乘我們的捷運冒險旅程，今天真是開心的一天。",
  //     image: require("@/assets/images/game/carriage_DUSK.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 28,
  //     text: `下一站，${this.userName}的家站，左側開門。`,
  //     image: require("@/assets/images/game/carriage_DUSK.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 29,
  //     text: "！！！？",
  //     image: require("@/assets/images/game/carriage_DUSK.jpg"),
  //     user: true,
  //   },
  //   {
  //     id: 30,
  //     text: "逼逼逼逼逼逼逼逼！登登！",
  //     image: require("@/assets/images/game/station_DUSK.jpg"),
  //     vo: true,
  //   },
  //   {
  //     id: 31,
  //     text: `再會了，${this.userName}。`,
  //     image: require("@/assets/images/game/station_DUSK.jpg"),
  //     npc: true,
  //   },
  //   {
  //     id: 32,
  //     text: "",
  //     image: require("@/assets/images/game/room.jpg"),
  //     user: true,
  //   },
  //   {
  //     id: 33,
  //     text: "原來我在做夢啊...算了，也滿開心的！",
  //     image: require("@/assets/images/game/room.jpg"),
  //     user: true,
  //   },
  //   {
  //     id: 34,
  //     text: "",
  //     image: require("@/assets/images/game/HOME_PM.jpg"),
  //     user: true,
  //   },
  // ];
  // },
  methods: {
    // 換下一個內容
    nextMessage() {
      if (this.idx === this.currentMessage.text.length) { //
        if (this.currentMessageIndex < this.messages.length - 1) {
          this.currentMessageIndex++;

          console.log(this.currentMessageIndex)
        }
      } else {
        this.currentText.push(this.currentMessage.text.substring(this.idx));
        this.idx = this.currentMessage.text.length;
      }
    },
    //確認名字
    checkName() {
      if (this.userName !== '') {
        this.home = false;
        this.closeName = false;
        this.Inner = true;
      } else {
        alert('請輸入您的名字');
      }
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

    // 鹹酥雞店
    decideChikin(event) {
      let buyItem = event.target.innerText;
      if (buyItem === '炸雞排') {
        this.item = require("@/assets/images/game/flightChikin.png");
        this.openBag = true;
        this.chikinshop = false;
        this.nextMessage()

      } else if (buyItem === '炸薯條') {
        this.item = require("@/assets/images/game/flightPotato.png");
        this.openBag = true;
        this.chikinshop = false;
        this.nextMessage()

      } else if (buyItem === '茶葉蛋') {
        this.item = require("@/assets/images/game/teaEgg.png");
        this.openBag = true;
        this.chikinshop = false;
        this.nextMessage()
      }
    },

    // 讀取條
    loadingTime() {

      if (this.currentMessageIndex === 11 || this.currentMessageIndex === 33) {
        this.closeTxtName = false;
        this.closeBalloon = false;
        this.loading = true;
        setTimeout(() => {
          this.currentMessageIndex++
          this.loading = false;
          this.closeTxtName = true;
          this.closeBalloon = true;
        }, 2000);
      }
    },
    // 重新遊戲
    resetGame() {
      this.currentMessageIndex = 0
      this.closeTxtName = true;
      this.closeBalloon = true;
      this.Inner = false;
      this.home = true;
    }


  },
  watch: {
    currentMessageIndex(newValue) {
      console.log(newValue)
      if (newValue === 9) {
        this.options = true;
        this.aimOption = true;
      } else if (newValue === 11) {
        this.loadingTime()
      }
      else if (newValue === 13) {
        this.options = true;
        this.aimOption = false;
        this.lineOption = true;
      } else if (newValue === 25) {
        this.chikinshop = true;
      } else if (newValue === 26) {
        this.options = true;
        this.lineOption = false;
        this.yes_OR_no_Option = true;
      } else if (newValue === 35) {
        this.closeTxtName = false;
        this.closeBalloon = false;
        this.openEnd = true;
      }
    },
    currentMessage: {
      handler(nVal) {
        if (this.Inner === true) {
          clearInterval(this.timer)
          this.currentText = []
          this.idx = 0
          this.timer = setInterval(() => {
            this.currentText.push(nVal.text[this.idx])
            this.idx++
            if (this.idx >= (nVal.text.length)) {
              clearInterval(this.timer)
            }
          }, 50)
        }
      },
      immediate: true
    },
    userName(newValue) {
      this.messages[2].text = `${newValue}突然腦袋一片空白不知不覺的搭上了電車...`;
      this.messages[12].text = `冒昧問一下，請問${newValue}住在哪裡呢？`;
      this.messages[17].text = `${newValue}你看！是白天欸，`;
      this.messages[22].text = `齁齁齁齁，特寫照！${newValue}你肚子餓了吧`;
      this.messages[29].text = `下一站，${newValue}的家站，左側開門。`;
      this.messages[32].text = `再會了，${newValue}。`;

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

