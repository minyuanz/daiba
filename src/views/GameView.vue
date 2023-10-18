<template>
  <!-- 遊戲首頁 -->

  <section class="gameHome" v-if="home">
    <div class="home">
      <img src="@/assets/images/game/station_AM.jpg" alt="home" />
    </div>
    <img src="../assets/images/game/gameLogo.png" alt="gameLogo" class="gameLogo" v-show="gameLogo" />
    <button class="start btn_s" @click="closeName = !closeName" v-show="startBtn">start</button>

    <!-- 名稱彈窗 -->
    <div class="name" v-if="closeName">
      <p>請輸入ID</p>
      <input type="text" maxlength="8" v-model="userName" />
      <button class="btn_s" @click="checkName">OK</button>
    </div>
    <transition>

      <!-- 選擇模式 -->
      <div class="mode" v-if="mode">
        <div class="toCostume" @click="home = !home, costume = !costume, startCostume()">
          <p>選擇穿搭</p>
        </div>
        <div class="toGame" @click="home = !home, Inner = !Inner, starGameScene()">
          <p>直接遊玩</p>
        </div>
      </div>

    </transition>
  </section>


  <!-- 選擇服裝 -->
  <transition name="fade" mode="out-in">
    <section class="gameCostume" v-show="costume">
      <div class="costume">
        <img src="@/assets/images/game/costume.jpg" alt="更衣室">
      </div>
      <div class="main">

        <!-- 試衣間 -->
        <div class="fittingRoom">

          <!--人物 -->
          <div class="model">
            <a href="" id="downloadModel" style="display: none;"></a>
            <img src="~@/assets/images/game/costume/doll_naked.png" alt="人物">
            <img class="tryItem" :class="`item${tryItem.id}`" :src="tryItem.img" :alt="tryItem.alt"
              v-for="tryItem in tryItems" @mousedown="upZIndex($event)">
          </div>

          <!-- 下方按鈕 -->
          <div class="btn">
            <button class="btn_s" @click="downloadModel">下載穿搭</button>
            <button class="btn_s" @click="costume = false, Inner = !Inner, starGameScene()">決定</button>
            <button class="btn_s" @click="tryItems = []">RESET</button>
          </div>

          <!-- 垃圾桶 -->
          <div class="delBox" ref="delBox" @mouseup="delItem()">
            <img src="~@/assets/images/game/costume/delbox.png" alt="回收動畫">
            <img src="~@/assets/images/game/costume/recycle-symbol.png" alt="回收logo" v-show="recycleing" class="recycle">
            <!-- 火動畫 -->
            <div class="flame" v-show="fireing"></div>
          </div>
        </div>

        <!-- 服裝清單 -->
        <div class="list">

          <!-- 分類 -->
          <div class="type">
            <span @click="selectType($event)">上衣</span>
            <span @click="selectType($event)">下身</span>
            <span @click="selectType($event)">套裝</span>
            <span @click="selectType($event)">外套</span>
            <span @click="selectType($event)">配件</span>
          </div>

          <!-- 物品 -->
          <div class="item" data-role="drag-drop-container">
            <div class="pic" v-for=" item  in  newCostumeItem " :key="itemIndex">
              <img :src="item.img" :alt="item.alt" @click="tryOn(item)">
            </div>
          </div>

        </div>
      </div>

      <!-- 過場動畫 -->
      <svg id="curtain" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path fill="#000" d="M 100,0 L 0,0 L 0,130 c 0,-17, 23,-30, 50,-30 c 27,0, 50,13, 50,30 Z">
          <animate id="curtainAnimate" attributeName="d" begin="indefinite" dur="1s" fill="freeze" keyTimes="0; 0.7; 1"
            values="M 100,0 L 0,0 L 0,130 c 0,-17, 23,-30, 50,-30 c 27,0, 50,13, 50,30 Z;
                     M 100,0 L 0,0 L 0,50  c 0,-17, 23,-30, 50,-30 c 27,0, 50,13, 50,30 Z;
                     M 100,0 L 0,0 L 0,0   c 0,0, 50,0, 50,0       c 0,0, 50,0, 50,0 Z" />
        </path>
        <!-- 設置svg動畫屬性 執行完成之後控制css 設置成none -->
        <set begin="curtainAnimate.end" attributeType="CSS" attributeName="display" to="none" />
      </svg>

    </section>


  </transition>

  <!--遊戲內容 -->

  <transition name="fade" mode="out-in">
    <section class="gameInner" v-if="Inner">

      <!-- 開場動畫背景 -->
      <div class="starLightBox"></div>

      <!-- 開場動畫 -->
      <div class="starGameScene"></div>

      <!-- 背景 -->
      <transition>
        <img :src="currentMessage.image" alt="Character Image" class="character-image" :class="{ imgFill }" />
      </transition>

      <!-- 對話框角色 -->
      <div class="name" v-show="closeTxtName">
        <p v-show="currentMessage.vo">???</p>
        <p v-show="currentMessage.user">{{ userName }}</p>
        <p v-show="currentMessage.npc">NPC</p>
      </div>

      <!-- 對話框 -->
      <div class="speechBalloon" @click="nextMessage" v-show="closeBalloon">
        <p :key="currentMessage.id">{{ currentText.join("") }}</p>
        <span class="nextBtn">▼</span>
      </div>

      <!-- 選項 -->
      <div class="lightbox" v-if="options">
        <div v-if="options" class="option">

          <!-- 主選擇 -->
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), (options = !options)">
            吃美食
          </button>
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), (options = !options)">
            逛景點
          </button>
          <button v-if="aimOption" class="btn_s" @click="decideAim($event), (options = !options)">
            住宿放鬆
          </button>

          <!-- 住處(捷運線) -->
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), (options = !options)">
            大都市
          </button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), (options = !options)">
            一般都市
          </button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), (options = !options)">
            公寓住宅區
          </button>
          <button v-if="lineOption" class="btn_s" @click="decideLine($event), (options = !options)">
            涼爽鄉下
          </button>

          <!-- 是否買鹹酥雞 -->
          <button v-if="yes_OR_no_Option" class="btn_s" @click="(chikinOption = true), (yes_OR_no_Option = false)">
            是
          </button>
          <button v-if="yes_OR_no_Option" class="btn_s" @click="
            (options = !options),
            nextMessage(),
            nextMessage(),
            (chikinshop = false)
            ">
            否
          </button>

          <!-- 鹹酥雞 -->
          <button v-if="chikinOption" class="btn_s" @click="decideChikin($event), (options = !options)">
            炸雞排
          </button>
          <button v-if="chikinOption" class="btn_s" @click="decideChikin($event), (options = !options)">
            炸薯條
          </button>
          <button v-if="chikinOption" class="btn_s" @click="decideChikin($event), (options = !options)">
            茶葉蛋
          </button>

          <!-- 唱歌 -->
          <button v-if="karaokeOption" class="btn_s" @click="decidekaraoke($event), (options = !options)">
            唱
          </button>
          <button v-if="karaokeOption" class="btn_s" @click="(options = !options), nextMessage(), nextMessage()">
            不唱
          </button>
        </div>
      </div>

      <!-- 插圖 -->
      <img class="chikinshop" src="~@/assets/images/game/chikin.png" alt="鹹酥雞" v-show="chikinshop" />

      <!-- 獲得物品的彈窗 -->
      <div class="lightbox" v-show="openBag">
        <div class="bag">
          <p>獲得了</p>
          <!-- <img src="~@/assets/images/game/flightChikin.png" alt=""> -->
          <img :src="item" alt="物品" />
          <button class="btn_s" @click="(openBag = !openBag), nextMessage()">
            關閉
          </button>
        </div>
      </div>

      <!-- 結束畫面 -->
      <div class="end" v-if="openEnd" >
        <p>冒險的一天結束了！</p>
        <p>根據你的冒險路線，你可以選擇...</p>

        <!-- 點數 -->
        <form @submit.prevent="addPoint" enctype="multipart/form-data">
        <div class="station">
          <div class="FrontCard">
            <img src="../../public/img/logo.png" alt="logo" />
          </div>
          <div class="backCard">
            <div class="point">
              <p v-if="notLogin">登入會員遊玩的話即可獲得點數！</p>
              <div>
                <p v-show="showPoint">獲得點數：10點！</p>
               <button class="btn_s" v-if="isLogin" type="submit">獲取點數</button>
            </div>
              
              
            </div>
          </div>
        </div>
      </form>

        <!-- 推薦的東西 -->
        <div class="info">
          <div class="FrontCard">
            <img src="../../public/img/logo.png" alt="logo" />
          </div>
          <div class="backCard">
            <div class="card-h border-r">
              <div class="img">
                <img :src=$imgUrl(specialAim[randomIndex].special_pic1) />
              </div>
              <div class="tag">
                <span class="title-tag gray">{{specialAim[randomIndex].fea_name}}</span>
                <span class="title-tag gray">{{specialAim[randomIndex].sta_name}}</span>
              </div>
              <div class="text">
                <div class="title">
                  <h3 v-if="specialAim.length > 0">{{ specialAim[randomIndex].special_title }}</h3>
                  <p>{{specialAim[randomIndex].special_des}}</p>
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
      <div class="loading" v-if="loading">
        <img src="../../src/assets/images/game/MRT.gif" alt="捷運動畫" id="MRT" />
        <svg xmlns="http://www.w3.org/2000/svg" width="600">
          <g class="animation-group">
            <rect class="box" width="50" height="50" rx="4" />
            <text class="text" transform="translate(10.12 35.19)">L</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="60" width="50" height="50" rx="4" />
            <text class="text" transform="translate(68.68 35.19)">O</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="120" width="50" height="50" rx="4" />
            <text class="text" transform="translate(128.22 35.19)">A</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="180" width="50" height="50" rx="4" />
            <text class="text" transform="translate(188.41 35.19)">D</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="240" width="50" height="50" rx="4" />
            <text class="text" transform="translate(259.06 35.19)">I</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="300" width="50" height="50" rx="4" />
            <text class="text" transform="translate(308.83 35.19)">N</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="360" width="50" height="50" rx="4" />
            <text class="text" transform="translate(368.14 35.19)">G</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="420" width="50" height="50" rx="4" />
            <text class="text" transform="translate(428.14 35.19)">.</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="480" width="50" height="50" rx="4" />
            <text class="text" transform="translate(488.14 35.19)">.</text>
          </g>
          <g class="animation-group">
            <rect class="box" x="540" width="50" height="50" rx="4" />
            <text class="text" transform="translate(548.14 35.19)">.</text>
          </g>
        </svg>
      </div>
    </section>
  </transition>
</template>

<script>
import ButtonS from "@/components/ButtonS.vue";
import { faRuler } from "@fortawesome/free-solid-svg-icons";
import $ from 'jquery'
import 'jquery-ui-dist/jquery-ui'
import html2canvas from "html2canvas";
import { faThinkPeaks } from "@fortawesome/free-brands-svg-icons";
import axios from 'axios';


export default {

  data() {
    return {
      btninner: ["START", "OK"],
      currentMessageIndex: 0, //對話內容索引值
      userName: "", //使用者名稱
      closeName: false, //關閉填寫名稱欄位
      gameLogo: true,
      home: true, //遊戲首頁
      startBtn: true, //開始按鈕
      mode: false, //選擇模式
      costume: false, //選擇服裝
      Inner: false, //遊戲內頁
      imgFill: false, //控制圖片css
      closeTxtName: true,
      closeBalloon: true,

      // 服裝
      costumeItem: [
        // 上身
        { id: 1, img: require('@/assets/images/game/costume/black_sweater.png'), alt: '上衣' },
        { id: 2, img: require('@/assets/images/game/costume/blue_shirt.png'), alt: '上衣' },
        { id: 3, img: require('@/assets/images/game/costume/yellow_upper.png'), alt: '上衣' },
        { id: 4, img: require('@/assets/images/game/costume/white_tshirt.png'), alt: '上衣' },

        // 下身
        { id: 5, img: require('@/assets/images/game/costume/blue_shorts.png'), alt: '下身' },
        { id: 6, img: require('@/assets/images/game/costume/navy_skirt.png'), alt: '下身' },
        { id: 7, img: require('@/assets/images/game/costume/white_trousers.png'), alt: '下身' },

        // 套裝
        { id: 8, img: require('@/assets/images/game/costume/red_dress.png'), alt: '套裝' },
        { id: 9, img: require('@/assets/images/game/costume/sportClothes.png'), alt: '套裝' },

        // 外套
        { id: 10, img: require('@/assets/images/game/costume/pink_baseballJacket.png'), alt: '外套' },
        { id: 11, img: require('@/assets/images/game/costume/tiffany_coat.png'), alt: '外套' },

        // 配件
        { id: 12, img: require('@/assets/images/game/costume/black_sockes.png'), alt: '配件' },
        { id: 13, img: require('@/assets/images/game/costume/white_longSocks.png'), alt: '配件' },
        { id: 14, img: require('@/assets/images/game/costume/pink_longSocks.png'), alt: '配件' },
        { id: 15, img: require('@/assets/images/game/costume/yellow_socks.png'), alt: '配件' },
        { id: 16, img: require('@/assets/images/game/costume/black_shoes.png'), alt: '配件' },
        { id: 17, img: require('@/assets/images/game/costume/white_shoes.png'), alt: '配件' },
        { id: 18, img: require('@/assets/images/game/costume/brown_shoes.png'), alt: '配件' },
        { id: 19, img: require('@/assets/images/game/costume/sandals.png'), alt: '配件' },
      ], //清單

      itemIndex: 0, //Key
      zIndex: 1,  //階級

      newCostumeItem: [
        { id: 1, img: require('@/assets/images/game/costume/black_sweater.png'), alt: '上衣' },
        { id: 2, img: require('@/assets/images/game/costume/blue_shirt.png'), alt: '上衣' },
        { id: 3, img: require('@/assets/images/game/costume/yellow_upper.png'), alt: '上衣' },
        { id: 4, img: require('@/assets/images/game/costume/white_tshirt.png'), alt: '上衣' },
      ], //篩選服裝 預設為上衣
      tryItems: [], //選擇的服裝
      fireing: false,
      recycleing: true,
      tagTryItem: [],


      // 需帶出的物件
      aim: "景點", //目的
      line: "", //捷運線

      // 選項
      options: false, //選擇視窗
      aimOption: false, //主選項
      lineOption: false, //捷運選項
      yes_OR_no_Option: false, //是否選項
      chikinOption: false, //炸機
      karaokeOption: false, //唱歌

      // 插圖
      chikinshop: false, //鹹酥雞店
      item: "", //鹹酥雞店

      // 彈窗
      openBag: false, //獲得物品
      openEnd: false, //結束

      // loading
      loading: false, //讀取
      MRTkey: 1,

      //會員資料
      userId:null,
      point:null,
      showPoint:false,
      isLogin:false,
      notLogin:false,

      // 捷運推薦
      specialALL:[],
      specialAim:[],
      randomIndex:null,
      

      // 對話內容
      messages: [
        {
          id: 1,
          text: "",
          image: require("@/assets/images/game/station_AM2.jpg"),
          vo: true,
        },
        {
          id: 2,
          text: "在一個城市中，你想著要去旅行，但卻不知去向，突然聽到了遠處傳來的低沉隆隆聲，彷彿你的冒險即將開始，你抬頭望向遠處，發現一輛神秘的電車正等待著你的到來。你將迎著這趟神秘的旅行搭上車了，不知道它將帶領你前往何方......",
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
        {
          id: 11,
          text: `沒問題！車掌請前往${this.aim}之旅，加速前進！`,
          image: require("@/assets/images/game/carriage_AM.jpg"),
          npc: true,
        },
        {
          id: 12,
          text: "loading",
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
          image: require("@/assets/images/game/tokai.jpg"),
          npc: true,
        },
        {
          id: 19,
          text: "好...",
          image: require("@/assets/images/game/tokai.jpg"),
          user: true,
        },

        // 美食
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
        // 景點
        {
          id: 29,
          text: "咳咳...好的，首先你有看到那高高的大樓嗎？那就是所謂的101大樓。",
          image: require("@/assets/images/game/101.jpg"),
          npc: true,
        },
        {
          id: 30,
          text: "讓我們上去看看好了。",
          image: require("@/assets/images/game/101.jpg"),
          npc: true,
        },
        {
          id: 31,
          text: "來準備看看從上往下看的台北街景吧！3..2..1..",
          image: require("@/assets/images/game/101-2.jpg"),
          npc: true,
        },
        {
          id: 32,
          text: "登登！很寬廣吧。哦，我看到你家了，在那裡！",
          image: require("@/assets/images/game/101-3.jpg"),
          npc: true,
        },
        {
          id: 33,
          text: "有欸，我家！",
          image: require("@/assets/images/game/101-3.jpg"),
          user: true,
        },
        {
          id: 35,
          text: "才怪...",
          image: require("@/assets/images/game/101-3.jpg"),
          user: true,
        },
        {
          id: 36,
          text: "再來看看北投這裡的日式古蹟，溫泉會館等等...",
          image: require("@/assets/images/game/oldtown.jpg"),
          npc: true,
        },
        {
          id: 37,
          text: "還可以特地泡個溫泉舒服一下。",
          image: require("@/assets/images/game/onsen.jpg"),
          npc: true,
        },
        {
          id: 38,
          text: "另外也有很多百貨公司可以逛逛，也是個好選擇。",
          image: require("@/assets/images/game/shopping.jpg"),
          npc: true,
        },
        {
          id: 39,
          text: "雖然台北是個大都市，但還有保持許多老街可以來體驗。",
          image: require("@/assets/images/game/shopmachi.jpg"),
          npc: true,
        },
        {
          id: 40,
          text: "下一站是台北當代藝術館，想提升你的藝術美感可以來看，你也會變藝術人也說不定！",
          image: require("@/assets/images/game/art.jpg"),
          npc: true,
        },
        {
          id: 41,
          text: "走著走著突然到了唱歌的地方，要唱歌嗎？",
          image: require("@/assets/images/game/karaoke.jpg"),
          vo: true,
        },
        {
          id: 42,
          text: "",
          image: require("@/assets/images/game/karaoke.jpg"),
          user: true,
        },
        {
          id: 43,
          text: "晚上了，可以去的地方有...",
          image: require("@/assets/images/game/PM.jpg"),
          npc: true,
        },
        {
          id: 44,
          text: "狂歡酒吧！",
          image: require("@/assets/images/game/pub.jpg"),
          npc: true,
        },
        {
          id: 44,
          text: "平溪天燈等等的...多重選擇！",
          image: require("@/assets/images/game/PMLight.jpg"),
          npc: true,
        },
        {
          id: 45,
          text: "累了，我們上車回家吧！",
          image: require("@/assets/images/game/PM.jpg"),
          npc: true,
        },

        // 住宿
        {
          id: 46,
          text: "首先來看看類型，普通的商務，最划算的價格。",
          image: require("@/assets/images/game/hotel.jpg"),
          npc: true,
        },
        {
          id: 47,
          text: "日式風格，有些很貴要小心。",
          image: require("@/assets/images/game/hotel-2.jpg"),
          npc: true,
        },
        {
          id: 48,
          text: "英式風格，WOW，高級感。",
          image: require("@/assets/images/game/hotel-3.jpg"),
          npc: true,
        },
        {
          id: 49,
          text: "或是平民風的民宿。好選擇！",
          image: require("@/assets/images/game/hotel-4.jpg"),
          npc: true,
        },
        {
          id: 50,
          text: "我們幫你預定了商務類型的，登記時間。",
          image: require("@/assets/images/game/hotel-5.jpg"),
          npc: true,
        },
        {
          id: 51,
          text: "嗯...真是個好房間！東西放著去閒晃吧。",
          image: require("@/assets/images/game/hotel-6.jpg"),
          npc: true,
        },
        {
          id: 52,
          text: "這是公園！",
          image: require("@/assets/images/game/park.jpg"),
          npc: true,
        },
        {
          id: 53,
          text: "啊！轉眼間已經晚上了，真好玩，回去飯店吧！",
          image: require("@/assets/images/game/park-2.jpg"),
          npc: true,
        },
        {
          id: 54,
          text: "天好黑喔，準備睡覺吧！",
          image: require("@/assets/images/game/hotel-7.jpg"),
          npc: true,
        },
        {
          id: 55,
          text: "...",
          image: require("@/assets/images/game/hotel-7.jpg"),
          npc: true,
        },
        // 結束
        {
          id: 56,
          text: "感謝你搭乘我們的捷運冒險旅程，今天真是開心的一天。",
          image: require("@/assets/images/game/carriage_DUSK.jpg"),
          npc: true,
        },
        {
          id: 57,
          text: "感謝你搭乘我們的捷運冒險旅程，今天真是開心的一天。",
          image: require("@/assets/images/game/carriage_DUSK.jpg"),
          vo: true,
        },
        {
          id: 58,
          text: `下一站，${this.userName}的家站，左側開門。`,
          image: require("@/assets/images/game/carriage_DUSK.jpg"),
          vo: true,
        },
        {
          id: 59,
          text: "！！！？",
          image: require("@/assets/images/game/carriage_DUSK.jpg"),
          user: true,
        },
        {
          id: 60,
          text: "逼逼逼逼逼逼逼逼！登登！",
          image: require("@/assets/images/game/station_DUSK.jpg"),
          vo: true,
        },
        {
          id: 61,
          text: `再會了，${this.userName}。`,
          image: require("@/assets/images/game/station_DUSK.jpg"),
          npc: true,
        },
        {
          id: 62,
          text: "",
          image: require("@/assets/images/game/room.jpg"),
          user: true,
        },
        {
          id: 63,
          text: "原來我在做夢啊...算了，也滿開心的！",
          image: require("@/assets/images/game/room.jpg"),
          user: true,
        },
        {
          id: 64,
          text: "",
          image: require("@/assets/images/game/HOME_PM.jpg"),
          user: true,
        },
      ],
      // 陣列文字動畫
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
  mounted(){
            // 會員
      axios.get(`${this.$apiUrl('getMember.php')}`)
            .then((res) => {
                //抓取資料res
                const matchingUser = res.data.find(user => user.mem_id === this.$store.state.memInfo.mem_id); //資料中和目前登入的ID配對
                this.userId = matchingUser.mem_id   //現在的會員的id
                this.point = parseInt(matchingUser.mem_point) //現在會員的點數資料 + 轉成int
                
            })
            .catch((error) => {
                console.error('資料失敗：', error);
            });

            // 判斷會員顯示
            if(this.$store.state.memInfo){
              this.isLogin = true
              this.notLogin = false
            }else{
              this.notLogin = true
              this.isLogin = false
            }
    
            // 推薦
            axios.get(`${this.$apiUrl('BackFeatureM.php')}`)
            .then((res) => {
                // console.log(res) //抓取資料
                this.specialALL = res.data
                console.log(this.specialALL);
                console.log(this.specialALL[0].special_title);
                this.specialAim = this.specialALL.filter(special => special.fea_name === this.aim)
                console.log(this.specialAim);    
            })
            .catch((error) => {
                console.error('資料失敗：', error);
            });

            
  },


  methods: {

    // 換下一個內容
    nextMessage() {
      if (this.idx === this.currentMessage.text.length) {
        //
        if (this.currentMessageIndex < this.messages.length - 1) {
          if (this.currentMessageIndex === 18) {
            //分支線18 選擇aim
            if (this.aim === "景點") {
              this.currentMessageIndex = 28;
            } else if (this.aim === "住宿") {
              this.currentMessageIndex = 45;
            } else {
              this.currentMessageIndex++;
            }
          }
          if (this.currentMessageIndex === 27) {
            // 分支線27 美食路線
            this.currentMessageIndex = 55;
          }
          if (this.currentMessageIndex === 44) {
            // 分支線44 景點路線
            this.currentMessageIndex = 55;
          } else this.currentMessageIndex++;

        }
      } else {
        this.currentText.push(this.currentMessage.text.substring(this.idx));
        this.idx = this.currentMessage.text.length;
      }
    },

    //確認名字
    checkName() {
      if (this.userName !== "") {
        this.closeName = false;
        this.startBtn = false;
        this.gameLogo = false;
        this.mode = true;
      } else {
        alert("請輸入您的名字");
      }
    },

    // 換裝動畫
    startCostume() {
      var animateElement = document.getElementById("curtainAnimate")
      setTimeout(() => {
        animateElement.beginElement()
      }, 500);

    },

    // 服裝分類
    selectType(event) {
      let type = event.target.innerText;
      if (type === "上衣") {
        this.newCostumeItem = this.costumeItem.filter(costumeItem => costumeItem.alt === type);
      } else if (type === "下身") {
        this.newCostumeItem = this.costumeItem.filter(costumeItem => costumeItem.alt === type);
      } else if (type === "套裝") {
        this.newCostumeItem = this.costumeItem.filter(costumeItem => costumeItem.alt === type);
      } else if (type === '外套') {
        this.newCostumeItem = this.costumeItem.filter(costumeItem => costumeItem.alt === type);
      } else if (type === '配件') {
        this.newCostumeItem = this.costumeItem.filter(costumeItem => costumeItem.alt === type);
      }
    },


    // 新增衣服 + 拖曳
    tryOn(item) {
      if (!this.tryItems.includes(item)) {  //如果當前沒有所選的衣服則新增
        this.tryItems.push(item);
      } else {
        let i = this.tryItems.indexOf(item) //如有找到則搜尋衣服的位置並刪除
        if (i !== -1) {
          this.tryItems.splice(i, 1)
        }

      }

      this.$nextTick(() => {
        const newTryItem = document.querySelector('.tryItem:last-child');
        if (newTryItem) {
          $(newTryItem).draggable({
            containment: '.fittingRoom',
          });
        }
      });
    },

    // 再次點擊試穿的衣服時，階級增加
    upZIndex(event) {
      event.target.style.zIndex = this.zIndex++   //增加當前目標的z-index
      let className = event.target.classList.toString()   //獲得當前目標的class名稱 並轉為字串
      let matches = className.match(/\d+/); //只篩選出數字
      let id = matches[0];
      this.tagTryItem = this.tryItems.filter(tryItems => tryItems.id == id) //將試穿的陣列清單中以id去抓取當前目標並給予當前目標試穿的陣列
    },


    // 刪除衣服
    delItem() {
      let i = this.tryItems.indexOf(this.tagTryItem[0]) //搜尋當前目標在試穿清單中的位置 有找到之後並刪除
      console.log(i)
      if (i !== -1) {
        this.recycleing = false
        this.fireing = true
        this.tryItems.splice(i, 1)
        setTimeout(() => {
          this.fireing = false
          this.recycleing = true
        }, 1000);
      }
    },


    // 轉成圖片檔並下載
    downloadModel() {
      let outfit = document.getElementById('downloadModel')  //抓到a標籤
      html2canvas(document.querySelector('.model')).then(function (canvas) {  //html2canvas套件轉成canvas
        outfit.href = canvas.toDataURL()   //給予連結(canvas)
        outfit.download = 'your outfit.png'; //→ 指定預設下載名稱
        outfit.click(); //直接讓outfit被點擊
      })


    },

    // 遊戲開場動畫
    starGameScene() {
      setTimeout(() => {
        this.nextMessage()
      }, 3000);
    },


    //決定目的
    decideAim(event) {
      let aim = event.target.innerText;
      if (aim === "吃美食") {
        this.aim = "美食";
        this.nextMessage();
        this.nextMessage();
      } else if (aim === "逛景點") {
        this.aim = "景點";
        this.nextMessage();
        this.nextMessage();
      } else if (aim === "住宿放鬆") {
        this.aim = "住宿";
        this.nextMessage();
        this.nextMessage();
      }
      this.specialAim = this.specialALL.filter(special => special.fea_name === this.aim)
      console.log(this.aim);
      
    },

    // 捷運路線
    decideLine(event) {
      let line = event.target.innerText;
      if (line === "大都市") {
        this.line = ["淡水信義線", "板南線"];
        this.inputTxt = false;
        this.nextMessage();
      } else if (line === "一般都市") {
        this.line = ["板南線", "松山新店線"];
        this.inputTxt = false;
        this.nextMessage();
      } else if (line === "公寓住宅區") {
        this.line = ["中和新蘆線", "環狀線", "松山新店線"];
        this.inputTxt = false;
        this.nextMessage();
      } else if (line === "涼爽鄉下") {
        this.line = ["文湖線", "松山新店線"];
        this.inputTxt = false;
        this.nextMessage();
      }
    },

    // 鹹酥雞店
    decideChikin(event) {
      let buyItem = event.target.innerText;
      if (buyItem === "炸雞排") {
        this.item = require("@/assets/images/game/flightChikin.png");
        this.openBag = true;
        this.chikinshop = false;
        this.nextMessage();
      } else if (buyItem === "炸薯條") {
        this.item = require("@/assets/images/game/flightPotato.png");
        this.openBag = true;
        this.chikinshop = false;
        this.nextMessage();
      } else if (buyItem === "茶葉蛋") {
        this.item = require("@/assets/images/game/teaEgg.png");
        this.openBag = true;
        this.chikinshop = false;
        this.nextMessage();
      }
      
    },

    // 唱歌
    decidekaraoke(event) {
      let karaoke = event.target.innerText;
      if (karaoke === "唱") {
        this.item = require("@/assets/images/game/mic.png");
        this.openBag = true;
        this.nextMessage();
      }
    },

    // 讀取條
    loadingTime() {
      this.loading = true;
      setTimeout(() => {
        this.currentMessageIndex++;
        this.loading = false;
        this.MRTkey++
      }, 2000);
    },


    // 點數
    addPoint() {
        this.point+=10
        console.log(this.point);
        const formData = new FormData();
        formData.append('mem_id',this.userId)
        formData.append('mem_point',this.point)
        axios.post(`${this.$apiUrl('addPoint.php')}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then((response) => {
                    if (response.status === 200) { //檢查http  狀態碼來判別 php新增成功與否
                    this.showPoint = true

                    } else {
                        console.log('error');
                    }
                })
                .catch((error) => {
                    console.error('上傳點數失敗：', error);
                });
        
      
        
    
    },

    // 隨機產生陣列數
    random(){
      return Math.floor(Math.random() * this.specialAim.length) + 1;
    },

    // 重新遊戲
    resetGame() {
      this.currentMessageIndex = 0;
      this.closeTxtName = true;
      this.closeBalloon = true;
      this.openEnd = false;
      this.Inner = false;
      this.home = true;
      this.aim = "";
      this.line = "";
      this.userName = "";
      this.options = false;
      this.aimOption = false;
      this.lineOption = false;
      this.yes_OR_no_Option = false;
      this.chikinOption = false;
      this.karaokeOption = false;
      this.mode = false;
      this.gameLogo = true;
      this.startBtn = true;
    },
  },
  watch: {
    // 判斷index來發動其他事件
    currentMessageIndex(newValue) {
      console.log(newValue);
      if (newValue === 9) {
        this.options = true;
        this.aimOption = true;
      } else if (newValue === 11 || newValue === 55 || newValue === 61) {
        this.loadingTime();
      } else if (newValue === 14) {
        this.options = true;
        this.aimOption = false;
        this.lineOption = true;
      } else if (newValue === 25) {
        this.chikinshop = true;
      } else if (newValue === 26) {
        this.options = true;
        this.lineOption = false;
        this.yes_OR_no_Option = true;
      } else if (newValue === 40) {
        this.options = true;
        this.lineOption = false;
        this.karaokeOption = true;
      } else if (newValue === 39 || newValue === 40 || newValue === 42) {
        if (
          (window.innerWidth <= 414 && newValue === 39) ||
          newValue === 40 ||
          newValue === 42
        ) {
          this.imgFill = true;
        } else {
          this.imgFill = false;
        }
      } else if (newValue === 54) {
        this.item = require("@/assets/images/game/makura.png");
        this.openBag = true;
      } else if (newValue === 63) {
        this.closeTxtName = false;
        this.closeBalloon = false;
        this.openEnd = true;
        this.randomIndex = this.random()
        console.log(this.randomIndex);
      }
    },

    // 打字機動畫
    currentMessage: {
      handler(nVal) {
        if (this.Inner === true) {
          clearInterval(this.timer);
          this.currentText = [];
          this.idx = 0;
          this.timer = setInterval(() => {
            this.currentText.push(nVal.text[this.idx]);
            this.idx++;
            if (this.idx >= nVal.text.length) {
              clearInterval(this.timer);
            }
          }, 50);
        }
      },
      immediate: true,
    },

    // 更新名字
    userName(newValue) {
      this.messages[2].text = `${newValue}突然腦袋一片空白不知不覺的搭上了電車...`;
      this.messages[12].text = `冒昧問一下，請問${newValue}住在哪裡呢？`;
      this.messages[17].text = `${newValue}你看！是白天欸，`;
      this.messages[22].text = `齁齁齁齁，特寫照！${newValue}你肚子餓了吧`;
      this.messages[57].text = `下一站，${newValue}的家站，左側開門。`;
      this.messages[60].text = `再會了，${newValue}。`;
    },
    // 目的
    aim(newValue) {
      this.messages[10].text = `沒問題！車掌請前往${newValue}之旅，加速前進！`;
    },
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/page/_game";
</style>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.8s;
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
