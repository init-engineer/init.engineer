<template>
    <div>
        <!-- 公司標誌 Logo -->
        <div class="form-group row">
            <label for="companie_logo" class="col-sm-2 col-form-label text-md-right">公司標誌 Logo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="companie_logo">
                <p class="text-danger mb-0">* 圖檔請提供解析度 512 x 512 的圖片檔案。</p>
            </div>
        </div><!--form-group-->

        <!-- 公司名稱 -->
        <div class="form-group row">
            <label for="companie_name" class="col-sm-2 col-form-label text-md-right">公司名稱</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="companie_name" placeholder="請輸入您的公司名稱，例如：ＯＯ股份有限公司" v-model="name">
                <p class="text-danger mb-0">*「公司名稱」必須提供。</p>
            </div>
        </div><!--form-group-->

        <hr>

        <!-- 公司資訊 -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">公司資訊</label>
        </div><!--form-group-->

        <!-- 公司區域 -->
        <div class="form-group row">
            <label for="companie_area" class="col-sm-2 col-form-label text-md-right">。公司區域</label>
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
        </div><!--form-group-->

        <!-- 公司地址 -->
        <div class="form-group row">
            <label for="companie_address" class="col-sm-2 col-form-label text-md-right">。公司地址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="companie_address" placeholder="請輸入您的公司地址，例如：臺北市信義區信義路五段 7 號" v-model="address">
                <p class="text-danger mb-0">*「公司地址」必須提供。</p>
            </div>
        </div><!--form-group-->

        <!-- 公司人數 -->
        <div class="form-group row">
            <label for="companie_scale" class="col-sm-2 col-form-label text-md-right">。公司人數</label>
            <div class="col-sm-10">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">約</span>
                    </div>
                    <input type="number" class="form-control" id="companie_scale" placeholder="請輸入您的公司人數，例如：10" v-model="scale">
                    <div class="input-group-append">
                        <span class="input-group-text">位員工</span>
                    </div>
                </div>
            </div>
        </div><!--form-group-->

        <!-- 統一編號 -->
        <div class="form-group row">
            <label for="companie_tax" class="col-sm-2 col-form-label text-md-right">。統一編號</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="companie_tax" placeholder="請輸入您的統一編號，例如：12345678" v-model="tax">
            </div>
        </div><!--form-group-->

        <!-- 公司資本額 -->
        <div class="form-group row">
            <label for="companie_capital" class="col-sm-2 col-form-label text-md-right">。公司資本額</label>
            <div class="col-sm-10">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" class="form-control" id="companie_capital" placeholder="請輸入您的公司資本額，例如：10" v-model="capital">
                    <div class="input-group-append">
                        <span class="input-group-text">萬元</span>
                    </div>
                </div>
            </div>
        </div><!--form-group-->

        <hr>

        <!-- 聯絡方式 -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">聯絡方式</label>
        </div><!--form-group-->

        <!-- 公司信箱 -->
        <div class="form-group row">
            <label for="companie_email" class="col-sm-2 col-form-label text-md-right">。公司信箱</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="companie_email" placeholder="請輸入您的公司信箱，例如：hr@example.com" v-model="email">
                <p class="text-danger mb-0">*「公司信箱」必須提供。</p>
            </div>
        </div><!--form-group-->

        <!-- 公司電話 -->
        <div class="form-group row">
            <label for="companie_photo" class="col-sm-2 col-form-label text-md-right">。公司電話</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="companie_photo" placeholder="請輸入您的公司電話，例如：(09)11-111-111" v-model="phone">
            </div>
        </div><!--form-group-->

        <hr>

        <!-- 內容介紹 -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">內容介紹</label>
            <div class="col-sm-10">
                <p class="p-2"
                    v-show="contents.length === 0">
                    公司沒有任何內容介紹的資訊，建議點擊「新增其他區塊」來新增資訊。
                </p>
            </div>
        </div><!--form-group-->

        <!-- 公司介紹區塊 -->
        <div class="form-group row"
            v-for="(content, index) in contents"
            v-bind:key="index">
            <div class="col-sm-2">
                <input type="text"
                    class="form-control"
                    placeholder="..."
                    v-model="content.key"
                    :for="content.key"
                    :id="content.key">
                <button type="button"
                    class="btn btn-sm btn-danger mt-2"
                    @click="destroyContent(index)">
                    刪除區塊
                </button>
            </div>
            <div class="col-sm-10">
                <textarea type="text"
                    class="form-control"
                    rows="4"
                    v-model="content.value"
                    :id="content.key"
                    :placeholder="content.key + '的內容 ...'"></textarea>
            </div>
        </div><!--form-group-->

        <!-- 新增其他區塊 -->
        <div class="form-group row">
            <div class="col-sm-8 offset-sm-2">
                <button type="button"
                    class="btn btn-lg btn-primary"
                    @click="createContent()">
                    新增其他區塊
                </button>
            </div>
        </div><!--form-group-->

        <hr>

        <!-- 外觀設定 -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">外觀設定</label>
        </div><!--form-group-->

        <!-- 橫幅 -->
        <div class="form-group row">
            <label for="companie_banner" class="col-sm-2 col-form-label text-md-right">橫幅</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="companie_banner">
                <p class="text-danger mb-0">* 圖檔請提供解析度 1280 x 720 的圖片檔案。</p>
            </div>
        </div><!--form-group-->
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
            contents: [
                {
                    key: '公司介紹',
                    value: null,
                },
                {
                    key: '經營理念',
                    value: null,
                },
                {
                    key: '福利制度',
                    value: null,
                },
            ],
        }
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
    },
};
</script>
