<template>
  <div>
    <!-- 公司標誌 Logo -->
    <div class="form-group row">
      <label for="companie_logo" class="col-sm-2 col-form-label text-md-right"
        >公司標誌 Logo</label
      >
      <div class="col-sm-10">
        <input
          type="file"
          class="form-control"
          id="companie_logo"
          ref="companie_logo"
          accept="image/jpeg, image/jpg, image/png"
          @change="changeLogo($event)"
        />
        <p class="text-danger mb-0">
          * 圖檔請提供解析度 512 x 512 的圖片檔案，並且容量在 2MB 以下。
        </p>
      </div>
    </div>
    <!--form-group-->

    <!-- 公司名稱 -->
    <div class="form-group row">
      <label for="companie_name" class="col-sm-2 col-form-label text-md-right"
        >公司名稱</label
      >
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="companie_name"
          placeholder="請輸入您的公司名稱，例如：ＯＯ股份有限公司"
          v-model="name"
        />
        <p class="text-danger mb-0">*「公司名稱」必須提供。</p>
      </div>
    </div>
    <!--form-group-->

    <hr />

    <!-- 公司資訊 -->
    <div class="form-group row">
      <label class="col-sm-2 col-form-label text-md-right">公司資訊</label>
    </div>
    <!--form-group-->

    <!-- 公司區域 -->
    <div class="form-group row">
      <label for="companie_area" class="col-sm-2 col-form-label text-md-right"
        >。公司區域</label
      >
      <div class="col-sm-10">
        <select class="form-control" id="companie_area" v-model="area">
          <option selected disabled hidden>請選擇您公司所在的區域。</option>
          <option value="臺北市">臺北市</option>
          <option value="新北市">新北市</option>
          <option value="桃園市">桃園市</option>
          <option value="臺中市">臺中市</option>
          <option value="臺南市">臺南市</option>
          <option value="高雄市">高雄市</option>
          <option value="基隆市">基隆市</option>
          <option value="新竹市">新竹市</option>
          <option value="嘉義市">嘉義市</option>
          <option value="新竹縣">新竹縣</option>
          <option value="苗栗縣">苗栗縣</option>
          <option value="彰化縣">彰化縣</option>
          <option value="南投縣">南投縣</option>
          <option value="雲林縣">雲林縣</option>
          <option value="嘉義縣">嘉義縣</option>
          <option value="屏東縣">屏東縣</option>
          <option value="宜蘭縣">宜蘭縣</option>
          <option value="花蓮縣">花蓮縣</option>
          <option value="臺東縣">臺東縣</option>
          <option value="澎湖縣">澎湖縣</option>
          <option value="金門縣">金門縣</option>
          <option value="連江縣">連江縣</option>
          <option value="海外">海外</option>
        </select>
      </div>
    </div>
    <!--form-group-->

    <!-- 公司地址 -->
    <div class="form-group row">
      <label
        for="companie_address"
        class="col-sm-2 col-form-label text-md-right"
        >。公司地址</label
      >
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="companie_address"
          placeholder="請輸入您的公司地址，例如：臺北市信義區信義路五段 7 號"
          v-model="address"
        />
        <p class="text-danger mb-0">*「公司地址」必須提供。</p>
      </div>
    </div>
    <!--form-group-->

    <!-- 公司人數 -->
    <div class="form-group row">
      <label for="companie_scale" class="col-sm-2 col-form-label text-md-right"
        >。公司人數</label
      >
      <div class="col-sm-10">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">約</span>
          </div>
          <input
            type="number"
            class="form-control"
            id="companie_scale"
            placeholder="請輸入您的公司人數，例如：10"
            v-model="scale"
          />
          <div class="input-group-append">
            <span class="input-group-text">位員工</span>
          </div>
        </div>
      </div>
    </div>
    <!--form-group-->

    <!-- 統一編號 -->
    <div class="form-group row">
      <label for="companie_tax" class="col-sm-2 col-form-label text-md-right"
        >。統一編號</label
      >
      <div class="col-sm-10">
        <input
          type="number"
          class="form-control"
          id="companie_tax"
          placeholder="請輸入您的統一編號，例如：12345678"
          v-model="tax"
        />
      </div>
    </div>
    <!--form-group-->

    <!-- 公司資本額 -->
    <div class="form-group row">
      <label
        for="companie_capital"
        class="col-sm-2 col-form-label text-md-right"
        >。公司資本額</label
      >
      <div class="col-sm-10">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">$</span>
          </div>
          <input
            type="number"
            class="form-control"
            id="companie_capital"
            placeholder="請輸入您的公司資本額，例如：10"
            v-model="capital"
          />
          <div class="input-group-append">
            <span class="input-group-text">萬元</span>
          </div>
        </div>
      </div>
    </div>
    <!--form-group-->

    <hr />

    <!-- 聯絡方式 -->
    <div class="form-group row">
      <label class="col-sm-2 col-form-label text-md-right">聯絡方式</label>
    </div>
    <!--form-group-->

    <!-- 公司信箱 -->
    <div class="form-group row">
      <label for="companie_email" class="col-sm-2 col-form-label text-md-right"
        >。公司信箱</label
      >
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="companie_email"
          placeholder="請輸入您的公司信箱，例如：hr@example.com"
          v-model="email"
        />
        <p class="text-danger mb-0">*「公司信箱」必須提供。</p>
      </div>
    </div>
    <!--form-group-->

    <!-- 公司電話 -->
    <div class="form-group row">
      <label for="companie_photo" class="col-sm-2 col-form-label text-md-right"
        >。公司電話</label
      >
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="companie_photo"
          placeholder="請輸入您的公司電話，例如：(09)11-111-111"
          v-model="phone"
        />
      </div>
    </div>
    <!--form-group-->

    <hr />

    <!-- 公司簡介 -->
    <div class="form-group row">
      <label
        for="companie_description"
        class="col-sm-2 col-form-label text-md-right"
        >公司簡介</label
      >
      <div class="col-sm-10">
        <textarea
          type="text"
          id="companie_description"
          class="form-control"
          rows="4"
          maxlength="2000"
          v-model="description"
          placeholder="公司簡介的內容 ..."
        ></textarea>
      </div>
    </div>
    <!--form-group-->

    <!-- 內容介紹 -->
    <div class="form-group row">
      <label class="col-sm-2 col-form-label text-md-right">內容介紹</label>
      <div class="col-sm-10">
        <p class="p-2" v-show="contents.length === 0">
          公司沒有任何內容介紹的資訊，建議點擊「新增其他區塊」來新增資訊。
        </p>
      </div>
    </div>
    <!--form-group-->

    <!-- 公司介紹區塊 -->
    <div
      class="form-group row"
      v-for="(content, index) in contents"
      v-bind:key="index"
    >
      <div class="col-sm-2">
        <input
          type="text"
          class="form-control"
          placeholder="..."
          v-model="content.key"
          :for="content.key"
          :id="content.key"
        />
        <button
          type="button"
          class="btn btn-sm btn-danger mt-2"
          @click="destroyContent(index)"
        >
          刪除區塊
        </button>
      </div>
      <div class="col-sm-10">
        <textarea
          type="text"
          class="form-control"
          rows="4"
          maxlength="2000"
          v-model="content.value"
          :id="content.key"
          :placeholder="content.key + '的內容 ...'"
        ></textarea>
      </div>
    </div>
    <!--form-group-->

    <!-- 新增其他區塊 -->
    <div class="form-group row">
      <div class="col-sm-8 offset-sm-2">
        <button
          type="button"
          class="btn btn-lg btn-primary"
          @click="createContent()"
        >
          新增其他區塊
        </button>
        <p class="text-danger mb-0">
          *「介紹區塊」最多可以新增 10 個介紹區塊，每個區塊內容最多 2,000
          個字元。
        </p>
      </div>
    </div>
    <!--form-group-->

    <hr />

    <!-- 外觀設定 -->
    <div class="form-group row">
      <label class="col-sm-2 col-form-label text-md-right">外觀設定</label>
    </div>
    <!--form-group-->

    <!-- 橫幅 -->
    <div class="form-group row">
      <label for="companie_banner" class="col-sm-2 col-form-label text-md-right"
        >橫幅</label
      >
      <div class="col-sm-10">
        <input
          type="file"
          class="form-control"
          id="companie_banner"
          ref="companie_banner"
          accept="image/jpeg, image/jpg, image/png"
          @change="changeBanner($event)"
        />
        <p class="text-danger mb-0">
          * 圖檔請提供解析度 1280 x 720 的圖片檔案，並且容量在 2MB 以下。
        </p>
      </div>
    </div>
    <!--form-group-->

    <!-- 相關圖片 -->
    <div class="form-group row">
      <label
        for="companie_picture"
        class="col-sm-2 col-form-label text-md-right"
        >相關圖片</label
      >
      <div class="col-sm-10">
        <div
          class="input-group mb-3"
          v-for="(picture, index) in pictures"
          v-bind:key="index"
        >
          <input
            type="file"
            class="form-control"
            name="companie_picture[]"
            :id="`companie_picture_${index}`"
            :ref="`companie_picture_${index}`"
            accept="image/jpeg, image/jpg, image/png"
            @change="changePicture($event, index)"
          />
          <div class="input-group-append">
            <button
              type="button"
              class="btn btn-outline-danger"
              @click="destroyPicture(index)"
            >
              刪除區塊
            </button>
          </div>
        </div>

        <p class="p-2" v-show="pictures.length === 0">
          公司沒有任何相關圖片，建議點擊「新增其他相關圖片」來新增圖片。
        </p>
      </div>
    </div>
    <!--form-group-->

    <!-- 新增其他相關圖片 -->
    <div class="form-group row">
      <div class="col-sm-8 offset-sm-2">
        <button
          type="button"
          class="btn btn-lg btn-primary"
          @click="createPicture()"
        >
          新增其他相關圖片
        </button>
        <p class="text-danger mb-0">
          *「相關圖片」最多可以上傳 10 張圖片，每張容量上限為 2MB。
        </p>
      </div>
    </div>
    <!--form-group-->

    <hr />

    <!-- 新增 -->
    <div class="form-group row">
      <div class="col-sm-4 offset-sm-4">
        <button
          type="button"
          class="btn btn-lg btn-block btn-info mt-2"
          @click="createCompanie()"
        >
          <div v-if="status === null">新增公司</div>
          <div v-else>
            <span
              class="spinner-border spinner-border-sm"
              role="status"
              aria-hidden="true"
            ></span>
            <span class="sr-only">Loading...</span>
          </div>
        </button>
      </div>
    </div>
    <!--form-group-->
  </div>
</template>

<script>
export default {
  name: "CreateCompanie",
  data() {
    return {
      logo: null,
      banner: null,
      pictures: [],
      name: null,
      area: null,
      address: null,
      scale: null,
      tax: null,
      capital: null,
      email: null,
      phone: null,
      description: null,
      contents: [
        {
          key: "公司介紹",
          value: null,
        },
        {
          key: "經營理念",
          value: null,
        },
        {
          key: "福利制度",
          value: null,
        },
      ],
      status: null,
    };
  },
  methods: {
    /**
     * 新增公司區塊。
     *
     * @return void
     */
    createContent() {
      this.contents.push({
        key: null,
        value: null,
      });
    },
    /**
     * 刪除公司區塊。
     *
     * @param int index
     *
     * @return void
     */
    destroyContent(index) {
      this.contents.splice(index, 1);
    },
    /**
     * 新增其他相關圖片。
     *
     * @return void
     */
    createPicture() {
      this.pictures.push(null);
    },
    /**
     * 刪除其他相關圖片。
     *
     * @param int index
     *
     * @return void
     */
    destroyPicture(index) {
      this.pictures.splice(index, 1);
    },
    /**
     * LOGO 上傳的觸發事件
     *
     * @param elements event
     *
     * @return void
     */
    changeLogo(event) {
      if (event.target.files && event.target.files[0]) {
        let uploaded = event.target.files[0];
        if (
          this.checkImage(event.target, uploaded, {
            height: 512,
            width: 512,
          })
        ) {
          this.logo = uploaded;

          return;
        }
      }

      this.$refs.companie_logo.value = null;
    },
    /**
     * 橫幅上傳的觸發事件
     *
     * @param elements event
     *
     * @return void
     */
    changeBanner(event) {
      if (event.target.files && event.target.files[0]) {
        let uploaded = event.target.files[0];
        if (
          this.checkImage(event.target, uploaded, {
            height: 720,
            width: 1280,
          })
        ) {
          this.banner = uploaded;

          return;
        }
      }

      this.$refs.companie_banner.value = null;
    },
    /**
     * 相關圖片上傳的觸發事件
     *
     * @param elements event
     * @param int index
     *
     * @return void
     */
    changePicture(event, index) {
      if (event.target.files && event.target.files[0]) {
        let uploaded = event.target.files[0];
        if (this.checkImage(event.target, uploaded)) {
          this.pictures[index] = uploaded;

          return;
        }
      }
    },
    /**
     * 判斷圖片是否符合規格。
     *
     * @param Image file
     * @param Object limit
     *
     * @return Image
     */
    checkImage(
      target,
      file,
      limit = {
        height: null,
        width: null,
      }
    ) {
      // 判斷檔案的格式是否正確
      let accepted = ["jpg", "jpeg", "png"];
      if (!new RegExp(accepted.join("|")).test(file.type)) {
        Swal.fire(
          "噢噗！您的圖片格式不支援！",
          '目前僅支援 <strong>"jpg"、"jpeg"、"png"</strong> 圖片格式的上傳，需要麻煩您幫圖片轉成我們支援的格式，再來重新上傳。',
          "error"
        );
        return false;
      }

      // 判斷檔案的容量大小是否超標
      if (file.size >= 2 * 1024 * 1024) {
        Swal.fire(
          "噢噗！您的圖片太大了！",
          "圖片容量大小限制 <strong>2MB</strong> 以下，建議您壓縮一下圖片，再來重新上傳。",
          "error"
        );
        return false;
      }

      // 判斷檔案的長度與高度是否符合規範
      if (limit.height !== null && limit.width !== null) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (evt) => {
          let img = new Image();
          img.onload = () => {
            if (limit.height !== img.height || limit.width !== img.width) {
              Swal.fire(
                "噢噗！您的圖片尺寸不正確哦！",
                `圖片尺寸必須為<p><strong>高度(Height) ${limit.height} × 寬度(Width) ${limit.width}</strong></p>您所上傳的圖片為<p><strong>高度(Height) ${img.height} × 寬度(Width) ${img.width}</strong></p>建議您重新檢查一下圖片，再來重新上傳。`,
                "error"
              );
              target.value = null;

              return false;
            }
          };
          img.src = evt.target.result;
        };
      }

      // 圖片格式、容量大小都沒問題，把圖片回傳
      return file;
    },
    /**
     * 新增公司。
     */
    createCompanie() {
      /**
       * 公司名稱防呆
       */
      if (this.name === null || this.name === "") {
        Swal.fire(
          "噢噗，公司名稱不能為空！",
          "「公司名稱」必須提供<p><strong>例如：ＯＯ股份有限公司</strong></p>",
          "error"
        );

        return;
      }

      /**
       * 公司區域防呆
       */
      if (this.area === null || this.area === "") {
        Swal.fire(
          "噢噗，您必須選擇公司區域！",
          "您必須提供「公司區域」的所在區域。",
          "error"
        );

        return;
      }

      /**
       * 公司地址防呆
       */
      if (this.address === null || this.address === "") {
        Swal.fire(
          "噢噗，公司地址不能為空！",
          "「公司地址」必須提供<p><strong>例如：臺北市信義區信義路五段 7 號</strong></p>",
          "error"
        );

        return;
      }

      /**
       * 公司信箱防呆
       */
      if (this.email === null || this.email === "") {
        Swal.fire(
          "噢噗，公司信箱不能為空！",
          "「公司信箱」必須提供<p><strong>例如：hr@example.com</strong></p>",
          "error"
        );

        return;
      }

      this.status = "create";

      /**
       * 處理必填的 FormData
       */
      let data = new FormData();
      data.append("name", this.name);
      data.append("area", this.area);
      data.append("address", this.address);
      data.append("email", this.email);

      /**
       * 處理選填的 FormData
       */
      if (this.scale !== null) {
        data.append("scale", this.scale);
      }

      if (this.tax !== null) {
        data.append("tax", this.tax);
      }

      if (this.capital !== null) {
        data.append("capital", this.capital);
      }

      if (this.phone !== null) {
        data.append("phone", this.phone);
      }

      if (this.description !== null) {
        data.append("description", this.description);
      }

      if (this.contents !== null) {
        this.contents.forEach((element) => {
          data.append("contents[" + element.key + "]", element.value);
        });
      }

      /**
       * 處理 LOGO File 圖片
       */
      if (this.logo !== null) {
        data.append("logo", this.logo);
      }

      /**
       * 處理 Banner File 圖片
       */
      if (this.banner !== null) {
        data.append("banner", this.banner);
      }

      /**
       * 處理 Pictures File 圖片
       */
      if (this.pictures.length !== 0) {
        let i = 0;
        this.pictures.forEach((element) => {
          if (element !== null) {
            data.append("pictures[" + i + "]", element);
            i = i + 1;
          }
        });
      }

      /**
       * 開始建立 Companie 公司資訊
       */
      let self = this;
      axios({
        method: "post",
        url: "/api/companies",
        data: data,
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
        .then(function (response) {
          self.status = null;
          document.location.href = `/companie/${response.data.data.uuid}`;
        })
        .catch(function (error) {
          /**
           * 處理不明的例外錯誤
           */
          self.status = null;
          Swal.fire(
            "噢噗！怪怪的？",
            '新增公司時發生了一些錯誤，可以的話，把這項問題拿到<a href="https://github.com/init-engineer/init.engineer"> GitHub repo </a>發個 issue 給我，謝謝你 m(_ _)m',
            "error"
          );
        });
    },
  },
};
</script>
