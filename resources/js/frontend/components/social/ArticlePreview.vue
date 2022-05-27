<template>
  <div class="preview align-self-center">
    <h1 class="text-center">效果預覽</h1>
    <canvas class="rounded mx-auto d-block w-100" ref="canvasView">
      <!-- 倘若使用者的瀏覽器並不支援 canvas，將會顯示該段內容。 -->
      您的瀏覽器必須支援 HTML5 標籤語法，才能使用圖片(即時)預覽功能。
    </canvas>
    <p class="text-danger">
      因為字型檔(font)容量很大，所以我們決定把字型的預覽繪製當作有跟沒有之間。
    </p>
  </div>
</template>

<script>
export default {
  name: "ArticlePreview",
  props: {
    /**
     * 文字內容
     */
    content: {
      type: String,
      required: true,
    },
    /**
     * 主題
     */
    theme: {
      type: String,
      required: true,
    },
    /**
     * 字型
     */
    font: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      /**
       * 畫布設定
       */
      canvas: {
        view: null,
        ctx: null,
        width: 960,
        height: 720,
        center: false,
      },
      /**
       * 預設值
       */
      default: {
        canvas: {
          width: 960,
          height: 720,
        },
        line: {
          height: 80,
        },
      },
      /**
       * 主題選項
       */
      themes: {
        "black-green": {
          background: "#000000",
          text: "#00FF3B",
        },
        "black-yellow": {
          background: "#000000",
          text: "#EBD443",
        },
        "black-white": {
          background: "#000000",
          text: "#F8F9FA",
        },
        "black-red": {
          background: "#000000",
          text: "#DC3545",
        },
        "sweet-panda": {
          background: "#E83E8C",
          text: "#F8F9FA",
        },
        "blue-white": {
          background: "#007BFF",
          text: "#F8F9FA",
        },
        "white-blue": {
          background: "#F8F9FA",
          text: "#007BFF",
        },
        laravel: {
          background: "#F4645F",
          text: "#F8F9FA",
        },
        "soft-green": {
          background: "#39C5BB",
          text: "#000000",
        },
        "grey-pikachu": {
          background: "#2F3437",
          text: "#FFD547",
        },
        "grey-eevee": {
          background: "#2F3437",
          text: "#E7AF56",
        },
        "pikachu-grey": {
          background: "#FFD547",
          text: "#2F3437",
        },
        "eevee-grey": {
          background: "#E7AF56",
          text: "#2F3437",
        },
        "chinese-new-year": {
          background: "#A61723",
          text: "#D8B06A",
        },
        "reverse-chinese-new-year": {
          background: "#D8B06A",
          text: "#A61723",
        },
        devotion: {
          background: "#F11541",
          text: "#000000",
        },
        "windows-10-error": {
          background: "#007BD0",
          text: "#F8F9FA",
        },
        "windows-10-error-testing": {
          background: "#107C10",
          text: "#F8F9FA",
        },
        pink: {
          background: "#F8C0C8",
          text: "#FF5376",
        },
        "broken-think": {
          background: "#F8F9FA",
          text: "#000000",
        },
        "furry-broken-think": {
          background: "#F8F9FA",
          text: "#000000",
        },
      },
      /**
       * 字型選項
       */
      fonts: {
        auraka: {
          name: "AURAKA 點陣宋字型",
          font: "Auraka",
        },
        kc24m: {
          name: "國喬點陣字型",
          font: "KC24M",
        },
        "microsoft-jheng-hei": {
          name: "微軟正黑體",
          font: "Microsoft JhengHei",
        },
        mingliu: {
          name: "新細明體",
          font: "Mingliu",
        },
        kaiu: {
          name: "標楷體",
          font: "Kaiu",
        },
        "fot-matissepro-eb": {
          name: "極粗明朝體",
          font: "MatissePro EB",
        },
        "taipei-sans-tc-beta-bold": {
          name: "台北黑體",
          font: "Taipei Sans TC Beta",
        },
        "cubic-11": {
          name: "俐方體 11 號",
          font: "Cubic 11",
        },
        "huninn": {
          name: "粉圓體",
          font: "Huninn",
        },
      },
    };
  },
  mounted() {
    this.resetCanvasView();
    this.settingCanvasViewSize();
    this.drawingBackground();
    this.drawingBackgroundImage();
    this.drawingLogo();
    this.drawingUrl();
    this.drawingContent();
  },
  methods: {
    /**
     * 重置 Canvas view 物件、ctx 物件
     *
     * @return void
     */
    resetCanvasView() {
      this.canvas.view = this.$refs.canvasView;
      this.canvas.ctx = this.canvas.view.getContext("2d");
    },
    /**
     * 設定 Canvas view 的寬度(width)、高度(height)
     *
     * @return void
     */
    settingCanvasViewSize() {
      /**
       * 獲得文章內容經過分割後的行數
       */
      let lineCount = this.contentSplit().length;
      /**
       * 判斷文章是否垂直置中，假設每行佔 ${default.line.height} 的高度，文章內容小於 600px 則會垂直置中對齊
       */
      let canvasViewCenter =
        lineCount * this.default.line.height < 600 ? true : false;
      /**
       * 計算出 Canvas 的寬度(width)、高度(height)
       * 如果文章沒有很長，那就給予預設高度 ${default.canvas.height}
       * 如果文章過長，就根據其他元件的高度 + (每行 * ${default.line.height})
       */
      let canvasViewWidth = this.default.canvas.width;
      let canvasViewHeight = canvasViewCenter
        ? this.default.canvas.height
        : 144 + lineCount * this.default.line.height;
      /**
       * 如果是選擇特殊樣式，會有其它裝飾元素，必須再額外給予更多的寬度(width)、高度(height)
       */
      switch (this.theme) {
        // 主題: Windows 10 錯誤畫面
        case "windows-10-error":
          canvasViewHeight += 360;
          break;

        // 主題: Windows 10 測試人員計畫 錯誤畫面
        case "windows-10-error-testing":
          canvasViewHeight += 360;
          break;

        // 主題: 支離滅裂な思考・発言
        case "broken-think":
          canvasViewHeight += 160;
          canvasViewWidth += 349;
          break;

        // 主題: 不獣控制な思考・発言
        case "furry-broken-think":
          canvasViewHeight += 160;
          canvasViewWidth += 349;
          break;
      }
      /**
       * 將計算結果寫入 data() 當中
       */
      this.canvas.width = canvasViewWidth;
      this.canvas.height = canvasViewHeight;
      this.canvas.center = canvasViewCenter;
      /**
       * 將 canvas 物件重新設定其寬度(width)、高度(height)
       */
      this.canvas.view.width = this.canvas.width;
      this.canvas.view.height = this.canvas.height;
    },
    /**
     * 對畫布繪製背景顏色
     *
     * @return void
     */
    drawingBackground() {
      this.canvas.ctx.fillStyle = this.themes[this.theme].background;
      this.canvas.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
    },
    /**
     * 對畫布繪製背景圖片
     *
     * @return void
     */
    drawingBackgroundImage() {
      let self = this;
      switch (this.theme) {
        // 主題: 慈孤觀音
        case "devotion":
          var sources = {
            devotion: "/img/frontend/cards/devotion-bg.png",
          };
          this.loadingImages(sources, function (images) {
            self.canvas.ctx.drawImage(images.devotion, 360, 64);
            self.drawingLogo();
            self.drawingUrl();
          });
          break;

        // 主題: Windows 10 錯誤畫面
        case "windows-10-error":
          var sources = {
            qrcode: "/img/frontend/cards/qrcode.png",
          };
          this.loadingImages(sources, function (images) {
            self.canvas.ctx.drawImage(
              images.qrcode,
              24,
              self.canvas.height - 204
            );
            self.drawingLogo();
            self.drawingUrl();
          });
          break;

        // 主題: Windows 10 測試人員計畫 錯誤畫面
        case "windows-10-error-testing":
          var sources = {
            qrcode: "/img/frontend/cards/qrcode.png",
          };
          this.loadingImages(sources, function (images) {
            self.canvas.ctx.drawImage(
              images.qrcode,
              24,
              self.canvas.height - 204
            );
            self.drawingLogo();
            self.drawingUrl();
          });
          break;

        // 主題: 支離滅裂な思考・発言
        case "broken-think":
          /**
           * 定義圖片資源
           * background => 背景的紫色圓圈
           * people => 支離破碎的人物
           * arrow => 對話框的箭頭
           */
          var sources = {
            background: "/img/frontend/cards/fragmented_background.png",
            people: "/img/frontend/cards/fragmented_people.png",
            arrow: "/img/frontend/cards/fragmented_background_arrow.png",
          };
          this.loadingImages(sources, function (images) {
            /**
             * 繪製背景圓圈與人物
             */
            self.canvas.ctx.drawImage(
              images.background,
              0,
              self.canvas.height - 560
            );
            self.canvas.ctx.drawImage(
              images.people,
              36,
              self.canvas.height - 542
            );

            /**
             * 繪製對話框
             */
            self.canvas.ctx.lineJoin = "round";
            self.canvas.ctx.lineWidth = 8;
            self.canvas.ctx.strokeRect(
              353,
              40,
              self.canvas.width - 381,
              self.canvas.height - 282
            );
            self.canvas.ctx.fillStyle = "#FFFFFF";
            self.canvas.ctx.fillRect(
              357,
              44,
              self.canvas.width - 389,
              self.canvas.height - 290
            );

            /**
             * 繪製對話框的箭頭
             */
            self.canvas.ctx.drawImage(
              images.arrow,
              312,
              self.canvas.height - 388
            );
            self.drawingLogo();
            self.drawingUrl();
            self.drawingContent();
          });
          break;

        // 主題: 不獣控制な思考・発言
        case "furry-broken-think":
          /**
           * 定義圖片資源
           * background => 背景的紫色圓圈
           * wolf => 支離破碎的狼
           * arrow => 對話框的箭頭
           */
          var sources = {
            background: "/img/frontend/cards/fragmented_background.png",
            wolf: "/img/frontend/cards/fragmented_wolf.png",
            arrow: "/img/frontend/cards/fragmented_background_arrow.png",
          };
          this.loadingImages(sources, function (images) {
            /**
             * 繪製背景圓圈與狼
             */
            self.canvas.ctx.drawImage(
              images.background,
              0,
              self.canvas.height - 560
            );
            self.canvas.ctx.drawImage(
              images.wolf,
              12,
              self.canvas.height - 482
            );

            /**
             * 繪製對話框
             */
            self.canvas.ctx.lineJoin = "round";
            self.canvas.ctx.lineWidth = 8;
            self.canvas.ctx.strokeRect(
              353,
              40,
              self.canvas.width - 381,
              self.canvas.height - 282
            );
            self.canvas.ctx.fillStyle = "#FFFFFF";
            self.canvas.ctx.fillRect(
              357,
              44,
              self.canvas.width - 389,
              self.canvas.height - 290
            );

            /**
             * 繪製對話框的箭頭
             */
            self.canvas.ctx.drawImage(
              images.arrow,
              312,
              self.canvas.height - 388
            );
            self.drawingLogo();
            self.drawingUrl();
            self.drawingContent();
            // self.drawingFeature();
          });
          break;
      }
    },
    /**
     * 對畫布繪製 LOGO
     *
     * @return void
     */
    drawingLogo() {
      switch (this.theme) {
        // 主題: Windows 10 錯誤畫面
        case "windows-10-error":
          this.canvas.ctx.font = "36px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(
            "若要深入了解，您稍候可以線上搜尋此:",
            228,
            this.canvas.height - 160
          );
          this.canvas.ctx.fillText(
            "純靠北工程師 0xINIT_ENGINEER",
            228,
            this.canvas.height - 120
          );
          this.canvas.ctx.fillText(
            "請訪問 https://init.engineer",
            228,
            this.canvas.height - 40
          );
          break;

        // 主題: Windows 10 測試人員計畫 錯誤畫面
        case "windows-10-error-testing":
          this.canvas.ctx.font = "36px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(
            "若要深入了解，您稍候可以線上搜尋此:",
            228,
            this.canvas.height - 160
          );
          this.canvas.ctx.fillText(
            "純靠北工程師 0xINIT_ENGINEER",
            228,
            this.canvas.height - 120
          );
          this.canvas.ctx.fillText(
            "請訪問 https://init.engineer",
            228,
            this.canvas.height - 40
          );
          break;

        // 主題: 支離滅裂な思考・発言
        case "broken-think":
          this.canvas.ctx.font = "72px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText("支離滅裂な", 360, this.canvas.height - 160);
          this.canvas.ctx.fillText("思考・発言", 360, this.canvas.height - 80);
          this.canvas.ctx.font = "36px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(
            "純靠北工程師",
            this.canvas.width - 232,
            this.canvas.height - 24
          );
          break;

        // 主題: 不獣控制な思考・発言
        case "furry-broken-think":
          this.canvas.ctx.font = "72px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText("不獣控制な", 360, this.canvas.height - 160);
          this.canvas.ctx.fillText("思考・発言", 360, this.canvas.height - 80);
          this.canvas.ctx.font = "36px " + this.canvas.font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(
            "純靠北工程師",
            this.canvas.width - 232,
            this.canvas.height - 24
          );
          break;

        // 預設，會在右下角印上 LOGO 字樣
        default:
          this.canvas.ctx.font = "36px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(
            "純靠北工程師",
            this.canvas.width - 232,
            this.canvas.height - 24
          );
          break;
      }
    },
    /**
     * 對畫布繪製網站連結
     *
     * @return void
     */
    drawingUrl() {
      switch (this.theme) {
        // 主題: Windows 10 錯誤畫面
        case "windows-10-error":
          this.canvas.ctx.font = "192px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(":(", 48, 192);
          break;

        // 主題: Windows 10 測試人員計畫 錯誤畫面
        case "windows-10-error-testing":
          this.canvas.ctx.font = "192px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(":(", 48, 192);
          break;

        // 預設，會在左下角印上網站連結宣傳
        default:
          this.canvas.ctx.font = "36px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(
            "發文傳送門 https://init.engineer",
            16,
            this.canvas.height - 24
          );
          break;
      }
    },
    /**
     * 對畫布繪製文字內容
     *
     * @return void
     */
    drawingContent() {
      /**
       * 先取得整理過後的內容字串 array[string]
       * 並且透過 forEach 的方式逐一繪製內容
       */
      let contentList = this.contentSplit();
      contentList.forEach(
        function (contentValue, contentKey) {
          /**
           * 定義 x, y 基準點
           */
          let xPoint = 36;
          let yPoint = 0;

          /**
           * 判斷文章內容是否需要垂直置中
           * 垂直置中:
           * 向上對齊:
           */
          if (this.canvas.center) {
            yPoint = 440 + ((contentKey - 1) * 80 - contentList.length * 40);
          } else {
            yPoint = 96 + contentKey * 80;
          }

          /**
           * 根據主題(theme)去判斷是否需要額外修改 x, y 基準點
           */
          switch (this.theme) {
            // 主題: Windows 10 錯誤畫面
            case "windows-10-error":
              yPoint += 240;
              break;
            // 主題: Windows 10 測試人員計畫 錯誤畫面
            case "windows-10-error-testing":
              yPoint += 240;
              break;
            // 主題: 支離滅裂な思考・発言
            case "broken-think":
              xPoint += 349;
              yPoint += 24;
              break;
            // 主題: 不獣控制な思考・発言
            case "furry-broken-think":
              xPoint += 349;
              yPoint += 24;
              break;
          }

          /**
           * 根據基準點來去繪製當前行數應該出現的位置
           */
          this.canvas.ctx.font = "63px " + this.fonts[this.font].font;
          this.canvas.ctx.fillStyle = this.themes[this.theme].text;
          this.canvas.ctx.fillText(contentValue, xPoint, yPoint);
        }.bind(this)
      );
    },

    // ...

    /**
     * 字串切割，並且以陣列(array[string])的方式回傳
     *
     * @return array[string]
     */
    contentSplit() {
      /**
       * 先準備一個用來儲存結果的字串陣列
       */
      let responseList = [];
      /**
       * 將文字內容以換行符號來分割成字串陣列，並且迴圈執行每行內容
       */
      let contentList = this.content.split(/\r\n|\r|\n/);
      contentList.forEach(function (contentValue) {
        /**
         * 計算當前文字內容長度
         */
        let content_strlen = encodeURIComponent(contentValue).replace(
          /%[A-F\d]{2}/g,
          "U"
        ).length;
        if (content_strlen <= 42) {
          /**
           * 如果內容長度小於或等於 42，直接將本行新增到結果陣列
           */
          responseList.push(contentValue);
        } else {
          /**
           * 如果內容長度大於 42，因為內容太長，需要分割換行
           *
           * conntentWidth => 長度計數器
           * charStrring => 字串暫存
           * contentValueList => 內容分割成陣列
           */
          let contentWidth = 0;
          let charString = "";
          let contentValueList = contentValue.split("");
          /**
           * 將內容陣列以迴圈的方式來逐一執行
           */
          contentValueList.forEach(function (charValue, charKey) {
            /**
             * 判斷當前字元的長度
             */
            let charStrlen = encodeURIComponent(charValue).replace(
              /%[A-F\d]{2}/g,
              "U"
            ).length;
            /**
             * 字元長度 3 位元，那麼紀錄長度為 1，否則為 0.5
             * 字元儲存到字串暫存當中
             */
            contentWidth += charStrlen == 3 ? 1 : 0.5;
            charString += charValue;
            /**
             * 判斷是否還有下一個字元
             */
            if (charKey + 1 in contentValueList) {
              /**
               * 字元長度 3 位元，那麼紀錄長度為 1，否則為 0.5
               */
              let nextCharStrlen = encodeURIComponent(
                contentValueList[charKey + 1]
              ).replace(/%[A-F\d]{2}/g, "U").length;
              let nextCharWidth = nextCharStrlen == 3 ? 1 : 0.5;
              /**
               * 如當前長度再加上下一個字元的長度，長度大於字元最大限度
               */
              if (contentWidth + nextCharWidth >= 14) {
                /**
                 * 將當前的字串暫存做一個斷點，儲存到結果字串陣列
                 * 並且清空字串暫存、歸零長度計數器
                 */
                responseList.push(charString);
                contentWidth = 0;
                charString = "";
              }
            }
          });

          /**
           * 如果剩下的內容不是空的，那麼就把剩下的內容儲存到結果字串陣列
           */
          if (charString != "") {
            responseList.push(charString);
          }
        }
      });

      /**
       * 字串分割完畢，將結果字串陣列回傳
       */
      return responseList;
    },
    /**
     * 動態載入圖片
     *
     * @param array[string] sources 需要動態載入的圖片位址
     * @param function callback 載入後所需要執行的事件
     *
     * @return void
     */
    loadingImages(sources, callback) {
      var images = {},
        loadedImages = 0,
        numImages = Object.keys(sources).length;
      for (var src in sources) {
        images[src] = new Image();
        images[src].onload = function () {
          if (++loadedImages >= numImages) {
            callback(images);
          }
        };
        images[src].src = sources[src];
      }
    },
  },
  watch: {
    /**
     * 內容更新
     */
    content: function (val) {
      this.resetCanvasView();
      this.settingCanvasViewSize();
      this.drawingBackground();
      this.drawingBackgroundImage();
      this.drawingLogo();
      this.drawingUrl();
      this.drawingContent();
    },
    /**
     * 主題更新
     */
    theme: function (val) {
      this.resetCanvasView();
      this.settingCanvasViewSize();
      this.drawingBackground();
      this.drawingBackgroundImage();
      this.drawingLogo();
      this.drawingUrl();
      this.drawingContent();
    },
    /**
     * 字型更新
     */
    font: function (val) {
      this.resetCanvasView();
      this.settingCanvasViewSize();
      this.drawingBackground();
      this.drawingBackgroundImage();
      this.drawingLogo();
      this.drawingUrl();
      this.drawingContent();
    },
  },
};
</script>

<style scoped>
.preview {
  max-width: 720px;
}
</style>
