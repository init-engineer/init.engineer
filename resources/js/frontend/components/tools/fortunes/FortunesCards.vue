<template>
  <div>
    <div class="row px-2" @click="rendon">
      <div class="col-12 col-md-6 p-2">
        <canvas
          class="rounded mx-auto d-block w-100"
          width="960"
          height="1440"
          ref="畫布正面物件"
        >
          <!-- 倘若使用者的瀏覽器並不支援 canvas，將會顯示該段內容。 -->
          您的瀏覽器必須支援 HTML5 標籤語法，才能使用圖片(即時)預覽功能。
        </canvas>
      </div>
      <div class="col-12 col-md-6 p-2">
        <canvas
          class="rounded mx-auto d-block w-100"
          width="960"
          height="1440"
          ref="畫布背面物件"
        >
          <!-- 倘若使用者的瀏覽器並不支援 canvas，將會顯示該段內容。 -->
          您的瀏覽器必須支援 HTML5 標籤語法，才能使用圖片(即時)預覽功能。
        </canvas>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FortunesCards",
  props: {
    index: {
      type: Number,
    },
  },
  data() {
    return {
      資料: null,
      畫布: {
        正面視圖: null,
        正面物件: null,
        背面視圖: null,
        背面物件: null,
        寬度: 960,
        高度: 1440,
        背景顏色: "#faf3dd",
        文字顏色: "#252422",
        字型: "kaiu",
      },
      籤運: null,
    };
  },
  mounted() {
    axios
      .get("/json/fortunes.json")
      .then((response) => {
        this.資料 = response.data;
        this.籤運 = this.資料[this.index];
        this.初始化();
        this.繪製背景顏色();
        this.繪製框線();
        this.繪製文字();
      })
      .catch((error) => console.log(error));
  },
  methods: {
    rendon() {
      this.初始化();
      this.繪製背景顏色();
      this.繪製框線();
      this.繪製文字();
    },
    初始化() {
      this.畫布.正面視圖 = this.$refs.畫布正面物件;
      this.畫布.背面視圖 = this.$refs.畫布背面物件;
      this.畫布.正面物件 = this.畫布.正面視圖.getContext("2d");
      this.畫布.背面物件 = this.畫布.背面視圖.getContext("2d");
    },
    繪製背景顏色() {
      this.畫布.正面物件.fillStyle = this.畫布.背景顏色;
      this.畫布.正面物件.fillRect(0, 0, this.畫布.寬度, this.畫布.高度);
      this.畫布.背面物件.fillStyle = this.畫布.背景顏色;
      this.畫布.背面物件.fillRect(0, 0, this.畫布.寬度, this.畫布.高度);
    },
    繪製框線() {
      this.繪製格子(
        this.畫布.正面物件,
        "M92 40 h 776 v 180 h -776 Z",
        this.畫布.文字顏色
      );
      this.繪製格子(
        this.畫布.正面物件,
        "M104 52 h 752 v 180 h -752 Z",
        this.畫布.背景顏色
      );
      this.繪製格子(
        this.畫布.正面物件,
        "M40 220 h 880 v 1180 h -880 Z",
        this.畫布.文字顏色
      );
      this.繪製格子(
        this.畫布.正面物件,
        "M50 232 h 170 v 1156 h -170 Z",
        this.畫布.背景顏色
      );
      this.繪製格子(
        this.畫布.正面物件,
        "M226 232 h 166 v 1156 h -166 Z",
        this.畫布.背景顏色
      );
      this.繪製格子(
        this.畫布.正面物件,
        "M398 232 h 166 v 1156 h -166 Z",
        this.畫布.背景顏色
      );
      this.繪製格子(
        this.畫布.正面物件,
        "M570 232 h 166 v 1156 h -166 Z",
        this.畫布.背景顏色
      );
      this.繪製格子(
        this.畫布.正面物件,
        "M742 232 h 166 v 1156 h -166 Z",
        this.畫布.背景顏色
      );
      this.繪製格子(
        this.畫布.正面物件,
        "M226 980 h 694 v 4 h -694 Z",
        this.畫布.文字顏色
      );
      this.繪製格子(
        this.畫布.背面物件,
        "M40 40 h 880 v 1360 h -880 Z",
        this.畫布.文字顏色
      );
      this.繪製格子(
        this.畫布.背面物件,
        "M42 42 h 876 v 1356 h -876 Z",
        this.畫布.背景顏色
      );
      this.繪製格子(
        this.畫布.背面物件,
        "M42 920 h 876 v 2 h -876 Z",
        this.畫布.文字顏色
      );
    },
    繪製格子(畫布物件, SVG, 顏色) {
      let 格子 = new Path2D(SVG);
      畫布物件.fillStyle = 顏色;
      畫布物件.fill(格子);
    },
    繪製文字() {
      this.畫布.正面物件.fillStyle = this.畫布.文字顏色;
      /**
       * 正面 詩籤標題
       */
      this.畫布.正面物件.font = "108px " + this.畫布.字型;
      let 標題 = this.籤運.編號 + this.籤運.運勢;
      標題 = 標題.split("").reverse().join("");
      for (let i = 0; i < 標題.length; i++) {
        this.畫布.正面物件.fillText(
          標題.split("")[i],
          128 + (600 / (標題.length - 1)) * i,
          168
        );
      }
      /**
       * 正面 詩籤內容
       */
      this.畫布.正面物件.font = "128px " + this.畫布.字型;
      let 詩籤內容 = this.籤運.內容.日文;
      for (let i = 0; i < 4; i++) {
        let 詩籤文字 = 詩籤內容[i].split("");
        for (let j = 0; j < 5; j++) {
          this.畫布.正面物件.fillText(
            詩籤文字[j],
            760 - i * 172,
            360 + j * 140
          );
        }
      }
      /**
       * 正面 解詩
       */
      this.畫布.正面物件.font = "36px " + this.畫布.字型;
      for (let i = 0; i < 4; i++) {
        let 解詩內容 = this.籤運.解籤.日文[i].split("");
        let 解詩行數 = Math.ceil(解詩內容.length / 11);
        for (let j = 0; j < 解詩內容.length; j++) {
          this.畫布.正面物件.fillText(
            解詩內容[j],
            788 + 解詩行數 * 18 - i * 172 - parseInt(j / 11) * 36,
            1020 + (j % 11) * 36
          );
        }
      }
      /**
       * 正面 解籤
       */
      let 解籤內容 = this.籤運.解籤.日文[4].split("");
      let 解籤行數 = Math.ceil(解籤內容.length / 31);
      for (let i = 0; i < 解籤內容.length; i++) {
        this.畫布.正面物件.fillText(
          解籤內容[i],
          92 + 解籤行數 * 20 - parseInt(i / 31) * 36,
          280 + (i % 31) * 36
        );
      }
      /**
       * 背面 解詩內容
       */
      this.畫布.背面物件.font = "36px " + this.畫布.字型;
      this.畫布.背面物件.fillText(
        this.籤運.編號 + "籤",
        280 + (4 - this.籤運.編號.length) * 36,
        120
      );
      this.畫布.背面物件.font = "48px " + this.畫布.字型;
      this.畫布.背面物件.fillText(this.籤運.運勢, 520, 120);
      for (let i = 0; i < this.籤運.內容.中文.length; i++) {
        this.畫布.背面物件.font = "Bold 36px " + this.畫布.字型;
        this.畫布.背面物件.fillText(this.籤運.內容.中文[i], 380, 200 + 180 * i);
        this.畫布.背面物件.font = "28px " + this.畫布.字型;
        let 解籤內容 = this.籤運.解籤.中文[i];
        for (let j = 0; j < 解籤內容.length; j++) {
          this.畫布.背面物件.fillText(
            解籤內容[j],
            60 + (j % 26) * 32,
            240 + 180 * i + parseInt(j / 26) * 32
          );
        }
      }
      /**
       * 背面 運勢內容
       */
      for (let i = 0; i < this.籤運.解答.length; i++) {
        this.畫布.背面物件.font = "Bold 32px " + this.畫布.字型;
        if (this.籤運.解答[i].value !== null) {
          this.畫布.背面物件.fillText(
            this.籤運.解答[i].key + "：",
            60,
            972 + 48 * i
          );
          this.畫布.背面物件.font = "32px " + this.畫布.字型;
          this.畫布.背面物件.fillText(
            this.籤運.解答[i].value,
            92 + this.籤運.解答[i].key.length * 32,
            972 + 48 * i
          );
        } else {
          this.畫布.背面物件.fillText(this.籤運.解答[i].key, 60, 992 + 48 * i);
        }
      }
    },
  },
};
</script>
