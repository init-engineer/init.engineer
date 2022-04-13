<template>
  <div>
    <marquee class="my-2" style="max-height: 4rem">
      <h2 class="color-color-primary m-0">{{ 標題 }}</h2>
    </marquee>

    <div class="checkout-container my-2">
      <form class="form cf">
        <section class="plan cf text-center my-2">
          <h2 class="color-color-primary" style="font-size: 3rem">
            第一次購買
          </h2>
          <h2 class="color-color-primary">
            這是您第一次在島上跟曹賣購買大頭菜嗎？
          </h2>
          <h3 class="color-color-primary">（這會影響您的判斷模式）</h3>
          <input
            type="radio"
            v-model="first_time"
            id="first-time-radio-no"
            name="first-time"
            :value="false"
            checked
          /><label class="col first-col" for="first-time-radio-no">不是</label>
          <input
            type="radio"
            v-model="first_time"
            id="first-time-radio-yes"
            name="first-time"
            :value="true"
          /><label class="col first-col" for="first-time-radio-yes">是的</label>
        </section>
        <section class="plan cf text-center my-2">
          <h2 class="color-color-primary" style="font-size: 3rem">
            上一期的模式
          </h2>
          <h2 class="color-color-primary">上週您的大頭菜價格走勢如何呢？</h2>
          <h3 class="color-color-primary">（這會影響您的判斷模式）</h3>
          <input
            type="radio"
            v-model.number="pattern"
            id="pattern-radio-unknown"
            name="pattern"
            :value="-1"
            checked
          /><label class="col pattern-col" for="pattern-radio-unknown"
            >我不知道</label
          >
          <input
            type="radio"
            v-model.number="pattern"
            id="pattern-radio-fluctuating"
            name="pattern"
            :value="0"
          /><label class="col pattern-col" for="pattern-radio-fluctuating"
            >波型</label
          >
          <input
            type="radio"
            v-model.number="pattern"
            id="pattern-radio-small-spike"
            name="pattern"
            :value="3"
          /><label class="col pattern-col" for="pattern-radio-small-spike"
            >四期型</label
          >
          <input
            type="radio"
            v-model.number="pattern"
            id="pattern-radio-large-spike"
            name="pattern"
            :value="1"
          /><label class="col pattern-col" for="pattern-radio-large-spike"
            >三期型</label
          >
          <input
            type="radio"
            v-model.number="pattern"
            id="pattern-radio-decreasing"
            name="pattern"
            :value="2"
          /><label class="col pattern-col" for="pattern-radio-decreasing"
            >遞減型</label
          >
        </section>
      </form>
    </div>

    <div class="row justify-content-center">
      <div class="col-12 col-md-4">
        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.起始 }}(日) 大頭菜 買入價格</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="大頭菜買入價格"
              v-model.number="大頭菜起始價格.起始買入價格"
              required
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
          <p class="text-danger text-right"><strong>必填</strong></p>
        </div>
        <!--form-group-->
      </div>
      <!--col-->
    </div>
    <!--row-->

    <div class="row">
      <div class="col-12 col-sm-4 col-lg-2">
        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期一 }}(一) 上午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期一.上午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->

        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期一 }}(一) 下午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期一.下午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->
      </div>

      <div class="col-12 col-sm-4 col-lg-2">
        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期二 }}(二) 上午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期二.上午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->

        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期二 }}(二) 下午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期二.下午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->
      </div>

      <div class="col-12 col-sm-4 col-lg-2">
        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期三 }}(三) 上午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期三.上午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->

        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期三 }}(三) 下午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期三.下午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->
      </div>

      <div class="col-12 col-sm-4 col-lg-2">
        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期四 }}(四) 上午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期四.上午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->

        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期四 }}(四) 下午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期四.下午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->
      </div>

      <div class="col-12 col-sm-4 col-lg-2">
        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期五 }}(五) 上午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期五.上午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->

        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期五 }}(五) 下午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期五.下午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->
      </div>

      <div class="col-12 col-sm-4 col-lg-2">
        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期六 }}(六) 上午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期六.上午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->

        <div class="form-group">
          <label class="col-label d-table"
            >{{ 大頭菜起始價格.起始日期.星期六 }}(六) 下午</label
          >
          <div class="input-group">
            <input
              class="form-control cards-editor text-right"
              placeholder="賣出價格"
              v-model.number="大頭菜週期價格.星期六.下午.設定價格"
              v-on:keyup="判斷大頭菜模型()"
            />
            <div class="input-group-append">
              <span class="input-group-text">鈴錢</span>
            </div>
          </div>
        </div>
        <!--form-group-->
      </div>
    </div>
    <!--row-->

    <div class="row">
      <div class="col">
        <div class="form-group clearfix">
          <label class="col-label d-table"
            >這個功能是以前根據公式來推估大頭菜模型的方式，僅能提供模型判斷，無法預測價格。</label
          >
          <button
            class="h3 btn btn-block btn-dos btn-lg"
            @click="彈跳視窗預測()"
          >
            我想試試傳統公式來判斷模型
          </button>
        </div>
        <!--form-group-->
      </div>
      <!--col-->
    </div>
    <!--row-->

    <div class="row">
      <div class="col">
        <div class="form-group clearfix">
          <label class="col-label d-table">把資料清光光！</label>
          <button
            class="h3 btn btn-block btn-dos btn-lg"
            @click="清空輸入資料()"
          >
            幫我把資料清空，謝謝！
          </button>
        </div>
        <!--form-group-->
      </div>
      <!--col-->
    </div>
    <!--row-->

    <div class="row pt-2">
      <div class="col-sm-12 col-lg-6 pt-4">
        <div class="card p-2" style="background-color: white !important; color: black !important;">
          <h3 class="card-title text-center pt-2">模型預測</h3>
          <PieChart :chartdata="modelData" />
        </div>
        <!--card-->
      </div>
      <!--col-->

      <div class="col-sm-12 col-lg-6 pt-4">
        <div class="card p-2" style="background-color: white !important; color: black !important;">
          <h3 class="card-title text-center pt-2">價格預測</h3>
          <AreaChart :chartdata="chartData" />
        </div>
        <!--card-->
      </div>
      <!--col-->
    </div>
    <!--row-->
  </div>
</template>

<script>
import PieChart from "./KohlrabiPieChart.vue";
import AreaChart from "./KohlrabiAreaChart.vue";

export default {
  name: "KohlrabiComputer",
  components: {
    PieChart,
    AreaChart,
  },
  data() {
    return {
      first_time: false,
      pattern: -1,
      chartData: null,
      modelData: [],
      預測結果: [],
      標題: "大頭菜計算機，計算你的大頭菜",
      標題語錄: [
        "投資一定有風險，大頭菜有賺有賠，申購前應詳閱公開說明書。",
        "你，不會投資？那你有想過用大頭菜來投資嗎？",
        "史蒂夫和戴夫都有買動物森友會，史蒂夫精研大頭菜市場，戴夫則精研使用大頭菜計算機。",
        "豆狸粒狸，這是我最後的大頭菜了！你買下吧！",
        "冷靜 ... 先冷靜下來 ... 才能思考下一期該不該賣 ... 2、3、5、7、11、13、17、19 ... 冷靜下來 ... 數「大頭菜」一向能讓我冷靜 ...",
        "這味道 ... 是大頭菜的味道",
        "大頭菜挺立於大地",
        "曹賣：「和我購買大頭菜，成為大頭菜盤商吧！」",
        "你渴望大頭菜嗎？",
        "大頭菜的極致就是「三期型」的漲幅，大頭菜的暴利就是「三期型」的終焉！",
        "當我週日過了中午才打開 Switch 時 ... 曹賣！！！！！！！！！！！！",
        "豆狸、粒狸，不管你大頭菜要收多少，「預知的未來」顯示，致富站在我這邊！",
        "這跟賺得了賺不了錢沒有關係，我每一天都必須站在這裡問你今天大頭菜的價格！",
      ],
      大頭菜起始價格: {
        起始日期: {
          起始: new Date(),
          星期一: null,
          星期二: null,
          星期三: null,
          星期四: null,
          星期五: null,
          星期六: null,
        },
        最高價格: 110,
        最低價格: 90,
        起始買入價格: 100,
      },
      大頭菜週期價格: {
        星期一: {
          上午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
          下午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
        },
        星期二: {
          上午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
          下午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
        },
        星期三: {
          上午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
          下午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
        },
        星期四: {
          上午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
          下午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
        },
        星期五: {
          上午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
          下午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
        },
        星期六: {
          上午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
          下午: {
            設定價格: null,
            預測最高價格: null,
            預測最低價格: null,
            漲幅百分比: null,
          },
        },
      },
      大頭菜週期模式: null,
      售價模型機率: {
        本週: {
          波型: {
            下週: {
              波型: 0.2,
              三期型: 0.3,
              遞減型: 0.15,
              四期型: 0.35,
            },
          },
          三期型: {
            下週: {
              波型: 0.5,
              三期型: 0.05,
              遞減型: 0.2,
              四期型: 0.25,
            },
          },
          遞減型: {
            下週: {
              波型: 0.25,
              三期型: 0.45,
              遞減型: 0.05,
              四期型: 0.25,
            },
          },
          四期型: {
            下週: {
              波型: 0.45,
              三期型: 0.25,
              遞減型: 0.15,
              四期型: 0.15,
            },
          },
        },
      },
    };
  },
  mounted() {
    if (localStorage.起始買入價格)
      this.大頭菜起始價格.起始買入價格 = localStorage.起始買入價格;
    if (localStorage.星期一上午設定價格)
      this.大頭菜週期價格.星期一.上午.設定價格 =
        localStorage.星期一上午設定價格;
    if (localStorage.星期一下午設定價格)
      this.大頭菜週期價格.星期一.下午.設定價格 =
        localStorage.星期一下午設定價格;
    if (localStorage.星期二上午設定價格)
      this.大頭菜週期價格.星期二.上午.設定價格 =
        localStorage.星期二上午設定價格;
    if (localStorage.星期二下午設定價格)
      this.大頭菜週期價格.星期二.下午.設定價格 =
        localStorage.星期二下午設定價格;
    if (localStorage.星期三上午設定價格)
      this.大頭菜週期價格.星期三.上午.設定價格 =
        localStorage.星期三上午設定價格;
    if (localStorage.星期三下午設定價格)
      this.大頭菜週期價格.星期三.下午.設定價格 =
        localStorage.星期三下午設定價格;
    if (localStorage.星期四上午設定價格)
      this.大頭菜週期價格.星期四.上午.設定價格 =
        localStorage.星期四上午設定價格;
    if (localStorage.星期四下午設定價格)
      this.大頭菜週期價格.星期四.下午.設定價格 =
        localStorage.星期四下午設定價格;
    if (localStorage.星期五上午設定價格)
      this.大頭菜週期價格.星期五.上午.設定價格 =
        localStorage.星期五上午設定價格;
    if (localStorage.星期五下午設定價格)
      this.大頭菜週期價格.星期五.下午.設定價格 =
        localStorage.星期五下午設定價格;
    if (localStorage.星期六上午設定價格)
      this.大頭菜週期價格.星期六.上午.設定價格 =
        localStorage.星期六上午設定價格;
    if (localStorage.星期六下午設定價格)
      this.大頭菜週期價格.星期六.下午.設定價格 =
        localStorage.星期六下午設定價格;
    this.計算起始日期();
    this.隨機抽取標題();
    this.計算預測結果();
    this.渲染折條圖();
  },
  methods: {
    判斷大頭菜模型() {
      this.計算預測結果();
      this.渲染折條圖();
    },
    彈跳視窗預測() {
      if (
        this.大頭菜起始價格.起始買入價格 === null ||
        this.大頭菜週期價格.星期一.上午.設定價格 === null
      ) {
        Swal.fire(
          "無法判斷",
          "判斷大頭菜模型至少需要「起始基礎價格」以及「星期一上午價格」。",
          "error"
        );
        return;
      }
      const _R1 =
        this.大頭菜週期價格.星期一.上午.設定價格 /
        this.大頭菜起始價格.起始買入價格;
      if (_R1 >= 0.9) {
        /**
         * 如果週一下午、週二上午都還沒填寫，那我只能判斷為「四期」或「波型」
         */
        if (
          this.大頭菜週期價格.星期一.下午.設定價格 === null &&
          this.大頭菜週期價格.星期二.上午.設定價格 === null
        ) {
          this.大頭菜週期模式 = ["四期型", "波型"];
          Swal.fire(
            "可能為「四期型」或「波型」",
            "因為缺少「星期一下午價格」以及「星期二上午價格」，所以只能預測可能的模型。",
            "warning"
          );
          return;
        }
        /**
         * 如果週一下午有填寫，週二上午沒有填寫，那麼我就先計算週一下午的漲幅，如果跌到 0.8 以下，那肯定是「波型」，否則可能為「四期」或「波型」
         */
        if (
          this.大頭菜週期價格.星期一.下午.設定價格 != null &&
          this.大頭菜週期價格.星期二.上午.設定價格 === null
        ) {
          const _R21 =
            this.大頭菜週期價格.星期一.下午.設定價格 /
            this.大頭菜起始價格.起始買入價格;
          if (_R21 > 0.8) {
            this.大頭菜週期模式 = ["四期型", "波型"];
            Swal.fire(
              "可能為「四期型」或「波型」",
              "因為缺少「星期二上午價格」，所以只能預測可能的模型。",
              "warning"
            );
            return;
          } else {
            this.大頭菜週期模式 = ["波型"];
            Swal.fire(
              "波型",
              "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
              "success"
            );
            return;
          }
        }
        /**
         * 如果週一下午沒有填寫，週二上午有填寫，那麼我就先計算週二上午的漲幅，如果漲到 1.4 以上，那肯定是「四期」，否則為「波型」
         */
        if (
          this.大頭菜週期價格.星期一.下午.設定價格 === null &&
          this.大頭菜週期價格.星期二.上午.設定價格 != null
        ) {
          const _R21 =
            this.大頭菜週期價格.星期二.上午.設定價格 /
            this.大頭菜起始價格.起始買入價格;
          if (_R21 >= 1.4) {
            this.大頭菜週期模式 = ["四期型"];
            Swal.fire(
              "四期型",
              "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
              "success"
            );
            return;
          } else {
            this.大頭菜週期模式 = ["波型"];
            Swal.fire(
              "波型",
              "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
              "success"
            );
            return;
          }
        }
        /**
         * 最好的狀況就是週一下午、週二上午都有填寫
         * 那我就判斷週一下午的漲幅如果跌到 0.8 以下，或者週二上午的漲幅沒有漲到 1.4 以上，只要上面兩個條件任一符合，就肯定是「波型」，否則為「四期」
         */
        const _R211 =
          this.大頭菜週期價格.星期一.下午.設定價格 /
          this.大頭菜起始價格.起始買入價格;
        const _R212 =
          this.大頭菜週期價格.星期二.上午.設定價格 /
          this.大頭菜起始價格.起始買入價格;
        if (_R211 < 0.8 || _R212 < 1.4) {
          this.大頭菜週期模式 = ["波型"];
          Swal.fire(
            "波型",
            "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
            "success"
          );
          return;
        } else {
          this.大頭菜週期模式 = ["四期型"];
          Swal.fire(
            "四期型",
            "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
            "success"
          );
          return;
        }
      } else if (_R1 < 0.9 && _R1 >= 0.85) {
        /**
         * 這裡需要判斷每期漲幅，如果星期一上午至星期一下午的資料都有輸入，則進行判斷
         */
        if (
          this.大頭菜週期價格.星期一.上午.設定價格 != null &&
          this.大頭菜週期價格.星期一.下午.設定價格 != null &&
          this.大頭菜週期價格.星期二.上午.設定價格 != null &&
          this.大頭菜週期價格.星期二.下午.設定價格 != null &&
          this.大頭菜週期價格.星期三.上午.設定價格 != null &&
          this.大頭菜週期價格.星期三.下午.設定價格 != null &&
          this.大頭菜週期價格.星期四.上午.設定價格 != null &&
          this.大頭菜週期價格.星期四.下午.設定價格 != null
        ) {
          /**
           * 判斷大頭菜的價格是否每期都在減少，如果是的話則是「遞減型」
           */
          if (
            this.大頭菜週期價格.星期一.上午.設定價格 >
              this.大頭菜週期價格.星期一.下午.設定價格 &&
            this.大頭菜週期價格.星期一.下午.設定價格 >
              this.大頭菜週期價格.星期二.上午.設定價格 &&
            this.大頭菜週期價格.星期二.上午.設定價格 >
              this.大頭菜週期價格.星期二.下午.設定價格 &&
            this.大頭菜週期價格.星期二.下午.設定價格 >
              this.大頭菜週期價格.星期三.上午.設定價格 &&
            this.大頭菜週期價格.星期三.上午.設定價格 >
              this.大頭菜週期價格.星期三.下午.設定價格 &&
            this.大頭菜週期價格.星期三.下午.設定價格 >
              this.大頭菜週期價格.星期四.上午.設定價格 &&
            this.大頭菜週期價格.星期四.上午.設定價格 >
              this.大頭菜週期價格.星期四.下午.設定價格
          ) {
            this.大頭菜週期模式 = ["遞減型"];
            Swal.fire("遞減型", "最淺顯易懂的模型，一定不會賺錢。", "success");
            return;
          } else {
            /**
             * 找到第一次漲幅的那期，以那期推算漲幅的第二期是否有超過 1.4，如果有超過則是三期型
             * 舉例第一次漲幅為星期二上午，那麼第二期漲幅則是星期二下午
             */
            /**
             * 星期一下午開始進入漲幅，因此第二期漲幅是星期二上午
             */
            if (
              this.大頭菜週期價格.星期一.上午.設定價格 <
              this.大頭菜週期價格.星期一.下午.設定價格
            ) {
              if (
                this.大頭菜週期價格.星期二.上午.設定價格 /
                  this.大頭菜起始價格.起始買入價格 >
                1.4
              ) {
                this.大頭菜週期模式 = ["三期型"];
                Swal.fire(
                  "三期型",
                  "最刺激好賺的模型，要發大財就要靠這個。",
                  "success"
                );
                return;
              } else {
                this.大頭菜週期模式 = ["四期型"];
                Swal.fire(
                  "四期型",
                  "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                  "success"
                );
                return;
              }
            }
            /**
             * 星期二上午開始進入漲幅，因此第二期漲幅是星期二下午
             */
            if (
              this.大頭菜週期價格.星期一.下午.設定價格 <
              this.大頭菜週期價格.星期二.上午.設定價格
            ) {
              if (
                this.大頭菜週期價格.星期二.下午.設定價格 /
                  this.大頭菜起始價格.起始買入價格 >
                1.4
              ) {
                this.大頭菜週期模式 = ["三期型"];
                Swal.fire(
                  "三期型",
                  "最刺激好賺的模型，要發大財就要靠這個。",
                  "success"
                );
                return;
              } else {
                this.大頭菜週期模式 = ["四期型"];
                Swal.fire(
                  "四期型",
                  "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                  "success"
                );
                return;
              }
            }
            /**
             * 星期二下午開始進入漲幅，因此第二期漲幅是星期三上午
             */
            if (
              this.大頭菜週期價格.星期二.上午.設定價格 <
              this.大頭菜週期價格.星期二.下午.設定價格
            ) {
              if (
                this.大頭菜週期價格.星期三.上午.設定價格 /
                  this.大頭菜起始價格.起始買入價格 >
                1.4
              ) {
                this.大頭菜週期模式 = ["三期型"];
                Swal.fire(
                  "三期型",
                  "最刺激好賺的模型，要發大財就要靠這個。",
                  "success"
                );
                return;
              } else {
                this.大頭菜週期模式 = ["四期型"];
                Swal.fire(
                  "四期型",
                  "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                  "success"
                );
                return;
              }
            }
            /**
             * 星期三上午開始進入漲幅，因此第二期漲幅是星期三下午
             */
            if (
              this.大頭菜週期價格.星期二.下午.設定價格 <
              this.大頭菜週期價格.星期三.上午.設定價格
            ) {
              if (
                this.大頭菜週期價格.星期三.下午.設定價格 /
                  this.大頭菜起始價格.起始買入價格 >
                1.4
              ) {
                this.大頭菜週期模式 = ["三期型"];
                Swal.fire(
                  "三期型",
                  "最刺激好賺的模型，要發大財就要靠這個。",
                  "success"
                );
                return;
              } else {
                this.大頭菜週期模式 = ["四期型"];
                Swal.fire(
                  "四期型",
                  "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                  "success"
                );
                return;
              }
            }
            /**
             * 星期三下午開始進入漲幅，因此第二期漲幅是星期四上午
             */
            if (
              this.大頭菜週期價格.星期三.上午.設定價格 <
              this.大頭菜週期價格.星期三.下午.設定價格
            ) {
              if (
                this.大頭菜週期價格.星期四.上午.設定價格 /
                  this.大頭菜起始價格.起始買入價格 >
                1.4
              ) {
                this.大頭菜週期模式 = ["三期型"];
                Swal.fire(
                  "三期型",
                  "最刺激好賺的模型，要發大財就要靠這個。",
                  "success"
                );
                return;
              } else {
                this.大頭菜週期模式 = ["四期型"];
                Swal.fire(
                  "四期型",
                  "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                  "success"
                );
                return;
              }
            }
            /**
             * 星期四上午開始進入漲幅，因此第二期漲幅是星期四下午
             */
            if (
              this.大頭菜週期價格.星期三.下午.設定價格 <
              this.大頭菜週期價格.星期四.上午.設定價格
            ) {
              if (
                this.大頭菜週期價格.星期四.下午.設定價格 /
                  this.大頭菜起始價格.起始買入價格 >
                1.4
              ) {
                this.大頭菜週期模式 = ["三期型"];
                Swal.fire(
                  "三期型",
                  "最刺激好賺的模型，要發大財就要靠這個。",
                  "success"
                );
                return;
              } else {
                this.大頭菜週期模式 = ["四期型"];
                Swal.fire(
                  "四期型",
                  "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                  "success"
                );
                return;
              }
            }
            /**
             * 星期四下午開始進入漲幅，因此第二期漲幅是星期五上午
             */
            if (
              this.大頭菜週期價格.星期四.上午.設定價格 <
              this.大頭菜週期價格.星期四.下午.設定價格
            ) {
              /**
               * 這時候需要星期五上午的價格，才能做更近一步的判斷
               */
              if (this.大頭菜週期價格.星期五.上午.設定價格 != null) {
                if (
                  this.大頭菜週期價格.星期五.上午.設定價格 /
                    this.大頭菜起始價格.起始買入價格 >
                  1.4
                ) {
                  this.大頭菜週期模式 = ["三期型"];
                  Swal.fire(
                    "三期型",
                    "最刺激好賺的模型，要發大財就要靠這個。",
                    "success"
                  );
                  return;
                } else {
                  this.大頭菜週期模式 = ["四期型"];
                  Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                  );
                  return;
                }
              } else {
                this.大頭菜週期模式 = ["三期型", "四期型"];
                Swal.fire(
                  "可能為「三期型」或「四期型」",
                  "因為缺少了星期五上午的價格，所以僅能判斷為「三期型」或「四期型」",
                  "success"
                );
                return;
              }
            }
            /**
             * 都沒有進入漲幅，所以必為遞減型。
             */
            this.大頭菜週期模式 = ["遞減型"];
            Swal.fire("遞減型", "最淺顯易懂的模型，一定不會賺錢。", "success");
            return;
          }
        } else {
          /**
           * 並不是每個鈴錢都有填寫，所以只能預測。
           */
          /**
           * 如果星期一上午、星期一下午、星期二上午都有填寫，就判斷一下
           */
          if (
            this.大頭菜週期價格.星期一.上午.設定價格 != null &&
            this.大頭菜週期價格.星期一.下午.設定價格 != null
          ) {
            if (this.大頭菜週期價格.星期二.上午.設定價格 != null) {
              if (
                this.大頭菜週期價格.星期一.上午.設定價格 <
                this.大頭菜週期價格.星期一.下午.設定價格
              ) {
                if (
                  this.大頭菜週期價格.星期二.上午.設定價格 /
                    this.大頭菜起始價格.起始買入價格 >
                  1.4
                ) {
                  this.大頭菜週期模式 = ["三期型"];
                  Swal.fire(
                    "三期型",
                    "最刺激好賺的模型，要發大財就要靠這個。",
                    "success"
                  );
                  return;
                } else {
                  this.大頭菜週期模式 = ["四期型"];
                  Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                  );
                  return;
                }
              }
            } else {
              this.大頭菜週期模式 = ["三期型", "四期型", "遞減型"];
              Swal.fire(
                "「三期型」、「四期型」或「遞減型」",
                "因為缺乏了「星期二上午」的價格，因此僅能預估為「三期型」、「四期型」或「遞減型」",
                "warning"
              );
              return;
            }
          }
          /**
           * 如果星期一下午、星期二上午、星期二下午都有填寫，就判斷一下
           */
          if (
            this.大頭菜週期價格.星期一.下午.設定價格 != null &&
            this.大頭菜週期價格.星期二.上午.設定價格 != null
          ) {
            if (this.大頭菜週期價格.星期二.下午.設定價格 != null) {
              if (
                this.大頭菜週期價格.星期一.下午.設定價格 <
                this.大頭菜週期價格.星期二.上午.設定價格
              ) {
                if (
                  this.大頭菜週期價格.星期二.下午.設定價格 /
                    this.大頭菜起始價格.起始買入價格 >
                  1.4
                ) {
                  this.大頭菜週期模式 = ["三期型"];
                  Swal.fire(
                    "三期型",
                    "最刺激好賺的模型，要發大財就要靠這個。",
                    "success"
                  );
                  return;
                } else {
                  this.大頭菜週期模式 = ["四期型"];
                  Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                  );
                  return;
                }
              }
            } else {
              this.大頭菜週期模式 = ["三期型", "四期型", "遞減型"];
              Swal.fire(
                "「三期型」、「四期型」或「遞減型」",
                "因為缺乏了「星期二下午」的價格，因此僅能預估為「三期型」、「四期型」或「遞減型」",
                "warning"
              );
              return;
            }
          }
          /**
           * 如果星期二上午、星期二下午、星期三上午都有填寫，就判斷一下
           */
          if (
            this.大頭菜週期價格.星期二.上午.設定價格 != null &&
            this.大頭菜週期價格.星期二.下午.設定價格 != null
          ) {
            if (this.大頭菜週期價格.星期三.上午.設定價格 != null) {
              if (
                this.大頭菜週期價格.星期二.上午.設定價格 <
                this.大頭菜週期價格.星期二.下午.設定價格
              ) {
                if (
                  this.大頭菜週期價格.星期三.上午.設定價格 /
                    this.大頭菜起始價格.起始買入價格 >
                  1.4
                ) {
                  this.大頭菜週期模式 = ["三期型"];
                  Swal.fire(
                    "三期型",
                    "最刺激好賺的模型，要發大財就要靠這個。",
                    "success"
                  );
                  return;
                } else {
                  this.大頭菜週期模式 = ["四期型"];
                  Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                  );
                  return;
                }
              }
            } else {
              this.大頭菜週期模式 = ["三期型", "四期型", "遞減型"];
              Swal.fire(
                "「三期型」、「四期型」或「遞減型」",
                "因為缺乏了「星期三上午」的價格，因此僅能預估為「三期型」、「四期型」或「遞減型」",
                "warning"
              );
              return;
            }
          }
          /**
           * 如果星期二下午、星期三上午、星期三下午都有填寫，就判斷一下
           */
          if (
            this.大頭菜週期價格.星期二.下午.設定價格 != null &&
            this.大頭菜週期價格.星期三.上午.設定價格 != null
          ) {
            if (this.大頭菜週期價格.星期三.下午.設定價格 != null) {
              if (
                this.大頭菜週期價格.星期二.下午.設定價格 <
                this.大頭菜週期價格.星期三.上午.設定價格
              ) {
                if (
                  this.大頭菜週期價格.星期三.下午.設定價格 /
                    this.大頭菜起始價格.起始買入價格 >
                  1.4
                ) {
                  this.大頭菜週期模式 = ["三期型"];
                  Swal.fire(
                    "三期型",
                    "最刺激好賺的模型，要發大財就要靠這個。",
                    "success"
                  );
                  return;
                } else {
                  this.大頭菜週期模式 = ["四期型"];
                  Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                  );
                  return;
                }
              }
            } else {
              this.大頭菜週期模式 = ["三期型", "四期型", "遞減型"];
              Swal.fire(
                "「三期型」、「四期型」或「遞減型」",
                "因為缺乏了「星期三下午」的價格，因此僅能預估為「三期型」、「四期型」或「遞減型」",
                "warning"
              );
              return;
            }
          }
          /**
           * 如果星期三上午、星期三下午、星期四上午都有填寫，就判斷一下
           */
          if (
            this.大頭菜週期價格.星期三.上午.設定價格 != null &&
            this.大頭菜週期價格.星期三.下午.設定價格 != null
          ) {
            if (this.大頭菜週期價格.星期四.上午.設定價格 != null) {
              if (
                this.大頭菜週期價格.星期三.上午.設定價格 <
                this.大頭菜週期價格.星期三.下午.設定價格
              ) {
                if (
                  this.大頭菜週期價格.星期四.上午.設定價格 /
                    this.大頭菜起始價格.起始買入價格 >
                  1.4
                ) {
                  this.大頭菜週期模式 = ["三期型"];
                  Swal.fire(
                    "三期型",
                    "最刺激好賺的模型，要發大財就要靠這個。",
                    "success"
                  );
                  return;
                } else {
                  this.大頭菜週期模式 = ["四期型"];
                  Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                  );
                  return;
                }
              }
            } else {
              this.大頭菜週期模式 = ["三期型", "四期型", "遞減型"];
              Swal.fire(
                "「三期型」、「四期型」或「遞減型」",
                "因為缺乏了「星期四上午」的價格，因此僅能預估為「三期型」、「四期型」或「遞減型」",
                "warning"
              );
              return;
            }
          }
          /**
           * 如果星期三下午、星期四上午、星期四下午都有填寫，就判斷一下
           */
          if (
            this.大頭菜週期價格.星期三.下午.設定價格 != null &&
            this.大頭菜週期價格.星期四.上午.設定價格 != null
          ) {
            if (this.大頭菜週期價格.星期四.下午.設定價格 != null) {
              if (
                this.大頭菜週期價格.星期三.下午.設定價格 <
                this.大頭菜週期價格.星期四.上午.設定價格
              ) {
                if (
                  this.大頭菜週期價格.星期四.下午.設定價格 /
                    this.大頭菜起始價格.起始買入價格 >
                  1.4
                ) {
                  this.大頭菜週期模式 = ["三期型"];
                  Swal.fire(
                    "三期型",
                    "最刺激好賺的模型，要發大財就要靠這個。",
                    "success"
                  );
                  return;
                } else {
                  this.大頭菜週期模式 = ["四期型"];
                  Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                  );
                  return;
                }
              }
            } else {
              this.大頭菜週期模式 = ["三期型", "四期型", "遞減型"];
              Swal.fire(
                "「三期型」、「四期型」或「遞減型」",
                "因為缺乏了「星期四下午」的價格，因此僅能預估為「三期型」、「四期型」或「遞減型」",
                "warning"
              );
              return;
            }
          }
          /**
           * 如果星期四上午、星期四下午、星期五上午都有填寫，就判斷一下
           */
          if (
            this.大頭菜週期價格.星期四.上午.設定價格 != null &&
            this.大頭菜週期價格.星期四.下午.設定價格 != null
          ) {
            if (this.大頭菜週期價格.星期五.上午.設定價格 != null) {
              if (
                this.大頭菜週期價格.星期四.上午.設定價格 <
                this.大頭菜週期價格.星期四.下午.設定價格
              ) {
                if (
                  this.大頭菜週期價格.星期五.上五.設定價格 /
                    this.大頭菜起始價格.起始買入價格 >
                  1.4
                ) {
                  this.大頭菜週期模式 = ["三期型"];
                  Swal.fire(
                    "三期型",
                    "最刺激好賺的模型，要發大財就要靠這個。",
                    "success"
                  );
                  return;
                } else {
                  this.大頭菜週期模式 = ["四期型"];
                  Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                  );
                  return;
                }
              }
            } else {
              this.大頭菜週期模式 = ["三期型", "四期型", "遞減型"];
              Swal.fire(
                "「三期型」、「四期型」或「遞減型」",
                "因為缺乏了「星期五上午」的價格，因此僅能預估為「三期型」、「四期型」或「遞減型」",
                "warning"
              );
              return;
            }
          }
          this.大頭菜週期模式 = ["三期型", "四期型", "遞減型"];
          Swal.fire(
            "可能為「三期型」、「四期型」或「遞減型」",
            "因為缺乏星期一上午至星期四下午的連續價格資料，所以只能預測可能的模型。",
            "warning"
          );
          return;
        }
      } else if (_R1 < 0.85 && _R1 >= 0.8) {
        this.大頭菜週期模式 = ["四期型"];
        Swal.fire(
          "四期型",
          "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
          "success"
        );
        return;
      } else if (_R1 < 0.8 && _R1 >= 0.6) {
        if (
          this.大頭菜週期價格.星期一.下午.設定價格 === null &&
          this.大頭菜週期價格.星期二.上午.設定價格 === null
        ) {
          this.大頭菜週期模式 = ["四期型", "波型"];
          Swal.fire(
            "可能為「四期型」或「波型」",
            "因為缺乏星期一上午至星期二下午的價格資料，所以只能預測可能的模型。",
            "warning"
          );
          return;
        } else if (
          this.大頭菜週期價格.星期一.下午.設定價格 != null &&
          this.大頭菜週期價格.星期二.上午.設定價格 === null
        ) {
          const _R221 =
            this.大頭菜週期價格.星期一.上午.設定價格 /
              this.大頭菜起始價格.起始買入價格 -
            this.大頭菜週期價格.星期一.下午.設定價格 /
              this.大頭菜起始價格.起始買入價格;
          if (_R221 >= 0.05) {
            this.大頭菜週期模式 = ["波型"];
            Swal.fire(
              "波型",
              "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
              "success"
            );
            return;
          } else {
            this.大頭菜週期模式 = ["四期型", "波型"];
            Swal.fire(
              "可能為「四期型」或「波型」",
              "因為星期二上午的價格資料，所以只能預測可能的模型。",
              "warning"
            );
            return;
          }
        } else {
          /**
           * 波型是跌 4％ ~ 10％
           * 四期型是跌 3% ~ 5％
           */
          const _R221 =
            this.大頭菜週期價格.星期一.上午.設定價格 /
              this.大頭菜起始價格.起始買入價格 -
            this.大頭菜週期價格.星期一.下午.設定價格 /
              this.大頭菜起始價格.起始買入價格;
          const _R222 =
            this.大頭菜週期價格.星期一.下午.設定價格 /
              this.大頭菜起始價格.起始買入價格 -
            this.大頭菜週期價格.星期二.上午.設定價格 /
              this.大頭菜起始價格.起始買入價格;
          /**
           * 如果跌幅超過 5%，就必定為波型
           */
          if (_R221 >= 0.05 || _R222 >= 0.05) {
            this.大頭菜週期模式 = ["波型"];
            Swal.fire(
              "波型",
              "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
              "success"
            );
            return;
          } else {
            /**
             * 如果跌幅小於 4%，那就必定為四期型
             */
            if (_R221 < 0.04 || _R222 < 0.04) {
              this.大頭菜週期模式 = ["四期型"];
              Swal.fire(
                "四期型",
                "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                "success"
              );
              return;
            } else {
              /**
               * 情況二
               * 週一上午到週二上午都是跌 0.04 ~ 0.05 然後週二下午開始漲
               * 四期型會在週三下午漲超過 1.4
               */
              if (
                this.大頭菜週期價格.星期一.上午.設定價格 != null &&
                this.大頭菜週期價格.星期一.下午.設定價格 != null &&
                this.大頭菜週期價格.星期二.上午.設定價格 != null &&
                this.大頭菜週期價格.星期二.下午.設定價格 != null
              ) {
                if (
                  this.大頭菜週期價格.星期一.上午.設定價格 >
                    this.大頭菜週期價格.星期一.下午.設定價格 &&
                  this.大頭菜週期價格.星期一.下午.設定價格 >
                    this.大頭菜週期價格.星期二.上午.設定價格 &&
                  this.大頭菜週期價格.星期二.上午.設定價格 <
                    this.大頭菜週期價格.星期二.下午.設定價格
                ) {
                  if (this.大頭菜週期價格.星期三.下午.設定價格 != null) {
                    if (
                      this.大頭菜週期價格.星期三.下午.設定價格 /
                        this.大頭菜起始價格.起始買入價格 >=
                      1.4
                    ) {
                      this.大頭菜週期模式 = ["四期型"];
                      Swal.fire(
                        "四期型",
                        "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                        "success"
                      );
                      return;
                    } else {
                      this.大頭菜週期模式 = ["波型"];
                      Swal.fire(
                        "波型",
                        "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
                        "success"
                      );
                      return;
                    }
                  } else {
                    this.大頭菜週期模式 = ["四期型", "波型"];
                    Swal.fire(
                      "「四期型」或「波型」",
                      "因為缺乏「星期三下午」的大頭菜價格，因此只能推估為「四期型」或「波型」",
                      "success"
                    );
                    return;
                  }
                } else {
                  this.大頭菜週期模式 = ["波型"];
                  Swal.fire(
                    "波型",
                    "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
                    "success"
                  );
                  return;
                }
              }
              /**
               * 情況一
               * 週一上午到週一下午都是跌 0.04 ~ 0.05 然後週二上午開始漲
               * 四期型會在週三上午漲超過 1.4
               */
              if (
                this.大頭菜週期價格.星期一.上午.設定價格 != null &&
                this.大頭菜週期價格.星期一.下午.設定價格 != null &&
                this.大頭菜週期價格.星期二.上午.設定價格 != null
              ) {
                if (
                  this.大頭菜週期價格.星期一.上午.設定價格 >
                    this.大頭菜週期價格.星期一.下午.設定價格 &&
                  this.大頭菜週期價格.星期一.下午.設定價格 <
                    this.大頭菜週期價格.星期二.上午.設定價格
                ) {
                  if (this.大頭菜週期價格.星期三.上午.設定價格 != null) {
                    if (
                      this.大頭菜週期價格.星期三.上午.設定價格 /
                        this.大頭菜起始價格.起始買入價格 >=
                      1.4
                    ) {
                      this.大頭菜週期模式 = ["四期型"];
                      Swal.fire(
                        "四期型",
                        "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                        "success"
                      );
                      return;
                    } else {
                      this.大頭菜週期模式 = ["波型"];
                      Swal.fire(
                        "波型",
                        "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
                        "success"
                      );
                      return;
                    }
                  } else {
                    this.大頭菜週期模式 = ["四期型", "波型"];
                    Swal.fire(
                      "「四期型」或「波型」",
                      "因為缺乏「星期三上午」的大頭菜價格，因此只能推估為「四期型」或「波型」",
                      "success"
                    );
                    return;
                  }
                } else {
                  this.大頭菜週期模式 = ["四期型", "波型"];
                  Swal.fire(
                    "「四期型」或「波型」",
                    "因為缺乏「星期二下午」的大頭菜價格，因此只能推估為「四期型」或「波型」",
                    "success"
                  );
                  return;
                }
              }
              this.大頭菜週期模式 = ["四期型", "波型"];
              Swal.fire(
                "「四期型」或「波型」",
                "因為缺乏「星期一上午」到「星期二下午」的大頭菜價格，因此只能推估為「四期型」或「波型」",
                "success"
              );
              return;
            }
          }
        }
      } else if (_R1 < 0.6) {
        this.大頭菜週期模式 = ["四期型"];
        Swal.fire(
          "四期型",
          "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
          "success"
        );
        return;
      }
    },
    計算起始日期() {
      /**
       * 如果今天是星期天，那麼今天就是新週期的第一天，否則就要計算上禮拜的星期日。
       */
      const 起始日期 = new Date();
      if (起始日期.getDay() == 0) {
        this.大頭菜起始價格.起始日期.起始 = 起始日期.yyyymmdd();
      } else {
        起始日期.setDate(起始日期.getDate() + -起始日期.getDay());
        this.大頭菜起始價格.起始日期.起始 = 起始日期.yyyymmdd();
      }
      起始日期.setDate(起始日期.getDate() + 1);
      this.大頭菜起始價格.起始日期.星期一 = 起始日期.yyyymmdd("$2-$3");
      起始日期.setDate(起始日期.getDate() + 1);
      this.大頭菜起始價格.起始日期.星期二 = 起始日期.yyyymmdd("$2-$3");
      起始日期.setDate(起始日期.getDate() + 1);
      this.大頭菜起始價格.起始日期.星期三 = 起始日期.yyyymmdd("$2-$3");
      起始日期.setDate(起始日期.getDate() + 1);
      this.大頭菜起始價格.起始日期.星期四 = 起始日期.yyyymmdd("$2-$3");
      起始日期.setDate(起始日期.getDate() + 1);
      this.大頭菜起始價格.起始日期.星期五 = 起始日期.yyyymmdd("$2-$3");
      起始日期.setDate(起始日期.getDate() + 1);
      this.大頭菜起始價格.起始日期.星期六 = 起始日期.yyyymmdd("$2-$3");
    },
    隨機抽取標題() {
      const 抽卡 = Math.floor(Math.random() * this.標題語錄.length);
      this.標題 = this.標題語錄[抽卡];
    },
    渲染折條圖() {
      const 實價登錄 = [],
        預測最高價格 = [],
        預測最低價格 = [];
      /**
       * 把實價登錄資料塞進去
       */
      實價登錄.push(
        this.大頭菜週期價格.星期一.上午.設定價格 != null
          ? this.大頭菜週期價格.星期一.上午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期一.下午.設定價格 != null
          ? this.大頭菜週期價格.星期一.下午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期二.上午.設定價格 != null
          ? this.大頭菜週期價格.星期二.上午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期二.下午.設定價格 != null
          ? this.大頭菜週期價格.星期二.下午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期三.上午.設定價格 != null
          ? this.大頭菜週期價格.星期三.上午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期三.下午.設定價格 != null
          ? this.大頭菜週期價格.星期三.下午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期四.上午.設定價格 != null
          ? this.大頭菜週期價格.星期四.上午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期四.下午.設定價格 != null
          ? this.大頭菜週期價格.星期四.下午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期五.上午.設定價格 != null
          ? this.大頭菜週期價格.星期五.上午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期五.下午.設定價格 != null
          ? this.大頭菜週期價格.星期五.下午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期六.上午.設定價格 != null
          ? this.大頭菜週期價格.星期六.上午.設定價格
          : 0
      );
      實價登錄.push(
        this.大頭菜週期價格.星期六.下午.設定價格 != null
          ? this.大頭菜週期價格.星期六.下午.設定價格
          : 0
      );
      /**
       * 把預測最高價格塞進去
       */
      預測最高價格.push(
        this.大頭菜週期價格.星期一.上午.預測最高價格 != null
          ? this.大頭菜週期價格.星期一.上午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期一.下午.預測最高價格 != null
          ? this.大頭菜週期價格.星期一.下午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期二.上午.預測最高價格 != null
          ? this.大頭菜週期價格.星期二.上午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期二.下午.預測最高價格 != null
          ? this.大頭菜週期價格.星期二.下午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期三.上午.預測最高價格 != null
          ? this.大頭菜週期價格.星期三.上午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期三.下午.預測最高價格 != null
          ? this.大頭菜週期價格.星期三.下午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期四.上午.預測最高價格 != null
          ? this.大頭菜週期價格.星期四.上午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期四.下午.預測最高價格 != null
          ? this.大頭菜週期價格.星期四.下午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期五.上午.預測最高價格 != null
          ? this.大頭菜週期價格.星期五.上午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期五.下午.預測最高價格 != null
          ? this.大頭菜週期價格.星期五.下午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期六.上午.預測最高價格 != null
          ? this.大頭菜週期價格.星期六.上午.預測最高價格
          : 0
      );
      預測最高價格.push(
        this.大頭菜週期價格.星期六.下午.預測最高價格 != null
          ? this.大頭菜週期價格.星期六.下午.預測最高價格
          : 0
      );
      /**
       * 把預測最低價格塞進去
       */
      預測最低價格.push(
        this.大頭菜週期價格.星期一.上午.預測最低價格 != null
          ? this.大頭菜週期價格.星期一.上午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期一.下午.預測最低價格 != null
          ? this.大頭菜週期價格.星期一.下午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期二.上午.預測最低價格 != null
          ? this.大頭菜週期價格.星期二.上午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期二.下午.預測最低價格 != null
          ? this.大頭菜週期價格.星期二.下午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期三.上午.預測最低價格 != null
          ? this.大頭菜週期價格.星期三.上午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期三.下午.預測最低價格 != null
          ? this.大頭菜週期價格.星期三.下午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期四.上午.預測最低價格 != null
          ? this.大頭菜週期價格.星期四.上午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期四.下午.預測最低價格 != null
          ? this.大頭菜週期價格.星期四.下午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期五.上午.預測最低價格 != null
          ? this.大頭菜週期價格.星期五.上午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期五.下午.預測最低價格 != null
          ? this.大頭菜週期價格.星期五.下午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期六.上午.預測最低價格 != null
          ? this.大頭菜週期價格.星期六.上午.預測最低價格
          : 0
      );
      預測最低價格.push(
        this.大頭菜週期價格.星期六.下午.預測最低價格 != null
          ? this.大頭菜週期價格.星期六.下午.預測最低價格
          : 0
      );
      this.chartData = {
        labels: [
          "星期一 上午",
          "星期一 下午",
          "星期二 上午",
          "星期二 下午",
          "星期三 上午",
          "星期三 下午",
          "星期四 上午",
          "星期四 下午",
          "星期五 上午",
          "星期五 下午",
          "星期六 上午",
          "星期六 下午",
        ],
        datasets: [
          {
            label: "實價登錄",
            borderColor: "#ffba49",
            pointBackgroundColor: "white",
            pointRadius: 8,
            pointHoverRadius: 12,
            borderWidth: 4,
            hoverBorderWidth: 6,
            pointBorderColor: "#ffba49",
            backgroundColor: null,
            data: 實價登錄,
          },
          {
            label: "預計最高",
            borderColor: "#20a39e",
            pointBackgroundColor: "white",
            pointBorderColor: "#20a39e",
            pointRadius: 8,
            pointHoverRadius: 12,
            borderWidth: 4,
            hoverBorderWidth: 6,
            backgroundColor: null,
            data: 預測最高價格,
          },
          {
            label: "預計最低",
            borderColor: "#ef5b5b",
            pointBackgroundColor: "white",
            pointBorderColor: "#ef5b5b",
            pointRadius: 8,
            pointHoverRadius: 12,
            borderWidth: 4,
            hoverBorderWidth: 6,
            backgroundColor: null,
            data: 預測最低價格,
          },
        ],
      };
    },
    計算預測結果() {
      /**
       * 初始化大頭菜的最高、最低價格
       */
      this.大頭菜週期價格.星期一.上午.預測最高價格 = null;
      this.大頭菜週期價格.星期一.下午.預測最高價格 = null;
      this.大頭菜週期價格.星期二.上午.預測最高價格 = null;
      this.大頭菜週期價格.星期二.下午.預測最高價格 = null;
      this.大頭菜週期價格.星期三.上午.預測最高價格 = null;
      this.大頭菜週期價格.星期三.下午.預測最高價格 = null;
      this.大頭菜週期價格.星期四.上午.預測最高價格 = null;
      this.大頭菜週期價格.星期四.下午.預測最高價格 = null;
      this.大頭菜週期價格.星期五.上午.預測最高價格 = null;
      this.大頭菜週期價格.星期五.下午.預測最高價格 = null;
      this.大頭菜週期價格.星期六.上午.預測最高價格 = null;
      this.大頭菜週期價格.星期六.下午.預測最高價格 = null;
      this.大頭菜週期價格.星期一.上午.預測最低價格 = null;
      this.大頭菜週期價格.星期一.下午.預測最低價格 = null;
      this.大頭菜週期價格.星期二.上午.預測最低價格 = null;
      this.大頭菜週期價格.星期二.下午.預測最低價格 = null;
      this.大頭菜週期價格.星期三.上午.預測最低價格 = null;
      this.大頭菜週期價格.星期三.下午.預測最低價格 = null;
      this.大頭菜週期價格.星期四.上午.預測最低價格 = null;
      this.大頭菜週期價格.星期四.下午.預測最低價格 = null;
      this.大頭菜週期價格.星期五.上午.預測最低價格 = null;
      this.大頭菜週期價格.星期五.下午.預測最低價格 = null;
      this.大頭菜週期價格.星期六.上午.預測最低價格 = null;
      this.大頭菜週期價格.星期六.下午.預測最低價格 = null;
      this.預測結果 = [];
      let 購買價格 = this.大頭菜起始價格.起始買入價格;
      let 販售價格 = [parseInt(購買價格), parseInt(購買價格)];
      販售價格.push(
        this.大頭菜週期價格.星期一.上午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期一.上午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期一.下午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期一.下午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期二.上午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期二.上午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期二.下午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期二.下午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期三.上午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期三.上午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期三.下午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期三.下午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期四.上午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期四.上午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期四.下午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期四.下午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期五.上午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期五.上午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期五.下午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期五.下午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期六.上午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期六.上午.設定價格)
          : NaN
      );
      販售價格.push(
        this.大頭菜週期價格.星期六.下午.設定價格 != null
          ? parseInt(this.大頭菜週期價格.星期六.下午.設定價格)
          : NaN
      );
      let _pie0 = 0,
        _pie1 = 0,
        _pie2 = 0,
        _pie3 = 0;
      let predictor = new Predictor(販售價格, this.first_time, this.pattern);
      for (let 可能結果 of predictor.analyze_possibilities()) {
        if (可能結果.pattern_number != 4) {
          /**
           * 可能模型計算
           */
          switch (可能結果.pattern_number) {
            case 0:
              _pie0++;
              break;
            case 1:
              _pie1++;
              break;
            case 2:
              _pie2++;
              break;
            case 3:
              _pie3++;
              break;
          }
          /**
           * 重新設定大頭菜的最高、最低價格起點
           */
          if (this.大頭菜週期價格.星期一.上午.預測最高價格 === null)
            this.大頭菜週期價格.星期一.上午.預測最高價格 =
              可能結果.prices[2].max;
          if (this.大頭菜週期價格.星期一.下午.預測最高價格 === null)
            this.大頭菜週期價格.星期一.下午.預測最高價格 =
              可能結果.prices[3].max;
          if (this.大頭菜週期價格.星期二.上午.預測最高價格 === null)
            this.大頭菜週期價格.星期二.上午.預測最高價格 =
              可能結果.prices[4].max;
          if (this.大頭菜週期價格.星期二.下午.預測最高價格 === null)
            this.大頭菜週期價格.星期二.下午.預測最高價格 =
              可能結果.prices[5].max;
          if (this.大頭菜週期價格.星期三.上午.預測最高價格 === null)
            this.大頭菜週期價格.星期三.上午.預測最高價格 =
              可能結果.prices[6].max;
          if (this.大頭菜週期價格.星期三.下午.預測最高價格 === null)
            this.大頭菜週期價格.星期三.下午.預測最高價格 =
              可能結果.prices[7].max;
          if (this.大頭菜週期價格.星期四.上午.預測最高價格 === null)
            this.大頭菜週期價格.星期四.上午.預測最高價格 =
              可能結果.prices[8].max;
          if (this.大頭菜週期價格.星期四.下午.預測最高價格 === null)
            this.大頭菜週期價格.星期四.下午.預測最高價格 =
              可能結果.prices[9].max;
          if (this.大頭菜週期價格.星期五.上午.預測最高價格 === null)
            this.大頭菜週期價格.星期五.上午.預測最高價格 =
              可能結果.prices[10].max;
          if (this.大頭菜週期價格.星期五.下午.預測最高價格 === null)
            this.大頭菜週期價格.星期五.下午.預測最高價格 =
              可能結果.prices[11].max;
          if (this.大頭菜週期價格.星期六.上午.預測最高價格 === null)
            this.大頭菜週期價格.星期六.上午.預測最高價格 =
              可能結果.prices[12].max;
          if (this.大頭菜週期價格.星期六.下午.預測最高價格 === null)
            this.大頭菜週期價格.星期六.下午.預測最高價格 =
              可能結果.prices[13].max;
          if (this.大頭菜週期價格.星期一.上午.預測最低價格 === null)
            this.大頭菜週期價格.星期一.上午.預測最低價格 =
              可能結果.prices[2].min;
          if (this.大頭菜週期價格.星期一.下午.預測最低價格 === null)
            this.大頭菜週期價格.星期一.下午.預測最低價格 =
              可能結果.prices[3].min;
          if (this.大頭菜週期價格.星期二.上午.預測最低價格 === null)
            this.大頭菜週期價格.星期二.上午.預測最低價格 =
              可能結果.prices[4].min;
          if (this.大頭菜週期價格.星期二.下午.預測最低價格 === null)
            this.大頭菜週期價格.星期二.下午.預測最低價格 =
              可能結果.prices[5].min;
          if (this.大頭菜週期價格.星期三.上午.預測最低價格 === null)
            this.大頭菜週期價格.星期三.上午.預測最低價格 =
              可能結果.prices[6].min;
          if (this.大頭菜週期價格.星期三.下午.預測最低價格 === null)
            this.大頭菜週期價格.星期三.下午.預測最低價格 =
              可能結果.prices[7].min;
          if (this.大頭菜週期價格.星期四.上午.預測最低價格 === null)
            this.大頭菜週期價格.星期四.上午.預測最低價格 =
              可能結果.prices[8].min;
          if (this.大頭菜週期價格.星期四.下午.預測最低價格 === null)
            this.大頭菜週期價格.星期四.下午.預測最低價格 =
              可能結果.prices[9].min;
          if (this.大頭菜週期價格.星期五.上午.預測最低價格 === null)
            this.大頭菜週期價格.星期五.上午.預測最低價格 =
              可能結果.prices[10].min;
          if (this.大頭菜週期價格.星期五.下午.預測最低價格 === null)
            this.大頭菜週期價格.星期五.下午.預測最低價格 =
              可能結果.prices[11].min;
          if (this.大頭菜週期價格.星期六.上午.預測最低價格 === null)
            this.大頭菜週期價格.星期六.上午.預測最低價格 =
              可能結果.prices[12].min;
          if (this.大頭菜週期價格.星期六.下午.預測最低價格 === null)
            this.大頭菜週期價格.星期六.下午.預測最低價格 =
              可能結果.prices[13].min;
          /**
           * 判斷大頭菜可能的最高價格
           */
          if (
            this.大頭菜週期價格.星期一.上午.預測最高價格 <
            可能結果.prices[2].max
          )
            this.大頭菜週期價格.星期一.上午.預測最高價格 =
              可能結果.prices[2].max;
          if (
            this.大頭菜週期價格.星期一.下午.預測最高價格 <
            可能結果.prices[3].max
          )
            this.大頭菜週期價格.星期一.下午.預測最高價格 =
              可能結果.prices[3].max;
          if (
            this.大頭菜週期價格.星期二.上午.預測最高價格 <
            可能結果.prices[4].max
          )
            this.大頭菜週期價格.星期二.上午.預測最高價格 =
              可能結果.prices[4].max;
          if (
            this.大頭菜週期價格.星期二.下午.預測最高價格 <
            可能結果.prices[5].max
          )
            this.大頭菜週期價格.星期二.下午.預測最高價格 =
              可能結果.prices[5].max;
          if (
            this.大頭菜週期價格.星期三.上午.預測最高價格 <
            可能結果.prices[6].max
          )
            this.大頭菜週期價格.星期三.上午.預測最高價格 =
              可能結果.prices[6].max;
          if (
            this.大頭菜週期價格.星期三.下午.預測最高價格 <
            可能結果.prices[7].max
          )
            this.大頭菜週期價格.星期三.下午.預測最高價格 =
              可能結果.prices[7].max;
          if (
            this.大頭菜週期價格.星期四.上午.預測最高價格 <
            可能結果.prices[8].max
          )
            this.大頭菜週期價格.星期四.上午.預測最高價格 =
              可能結果.prices[8].max;
          if (
            this.大頭菜週期價格.星期四.下午.預測最高價格 <
            可能結果.prices[9].max
          )
            this.大頭菜週期價格.星期四.下午.預測最高價格 =
              可能結果.prices[9].max;
          if (
            this.大頭菜週期價格.星期五.上午.預測最高價格 <
            可能結果.prices[10].max
          )
            this.大頭菜週期價格.星期五.上午.預測最高價格 =
              可能結果.prices[10].max;
          if (
            this.大頭菜週期價格.星期五.下午.預測最高價格 <
            可能結果.prices[11].max
          )
            this.大頭菜週期價格.星期五.下午.預測最高價格 =
              可能結果.prices[11].max;
          if (
            this.大頭菜週期價格.星期六.上午.預測最高價格 <
            可能結果.prices[12].max
          )
            this.大頭菜週期價格.星期六.上午.預測最高價格 =
              可能結果.prices[12].max;
          if (
            this.大頭菜週期價格.星期六.下午.預測最高價格 <
            可能結果.prices[13].max
          )
            this.大頭菜週期價格.星期六.下午.預測最高價格 =
              可能結果.prices[13].max;
          /**
           * 判斷大頭菜可能的最高價格
           */
          if (
            this.大頭菜週期價格.星期一.上午.預測最低價格 >
            可能結果.prices[2].min
          )
            this.大頭菜週期價格.星期一.上午.預測最低價格 =
              可能結果.prices[2].min;
          if (
            this.大頭菜週期價格.星期一.下午.預測最低價格 >
            可能結果.prices[3].min
          )
            this.大頭菜週期價格.星期一.下午.預測最低價格 =
              可能結果.prices[3].min;
          if (
            this.大頭菜週期價格.星期二.上午.預測最低價格 >
            可能結果.prices[4].min
          )
            this.大頭菜週期價格.星期二.上午.預測最低價格 =
              可能結果.prices[4].min;
          if (
            this.大頭菜週期價格.星期二.下午.預測最低價格 >
            可能結果.prices[5].min
          )
            this.大頭菜週期價格.星期二.下午.預測最低價格 =
              可能結果.prices[5].min;
          if (
            this.大頭菜週期價格.星期三.上午.預測最低價格 >
            可能結果.prices[6].min
          )
            this.大頭菜週期價格.星期三.上午.預測最低價格 =
              可能結果.prices[6].min;
          if (
            this.大頭菜週期價格.星期三.下午.預測最低價格 >
            可能結果.prices[7].min
          )
            this.大頭菜週期價格.星期三.下午.預測最低價格 =
              可能結果.prices[7].min;
          if (
            this.大頭菜週期價格.星期四.上午.預測最低價格 >
            可能結果.prices[8].min
          )
            this.大頭菜週期價格.星期四.上午.預測最低價格 =
              可能結果.prices[8].min;
          if (
            this.大頭菜週期價格.星期四.下午.預測最低價格 >
            可能結果.prices[9].min
          )
            this.大頭菜週期價格.星期四.下午.預測最低價格 =
              可能結果.prices[9].min;
          if (
            this.大頭菜週期價格.星期五.上午.預測最低價格 >
            可能結果.prices[10].min
          )
            this.大頭菜週期價格.星期五.上午.預測最低價格 =
              可能結果.prices[10].min;
          if (
            this.大頭菜週期價格.星期五.下午.預測最低價格 >
            可能結果.prices[11].min
          )
            this.大頭菜週期價格.星期五.下午.預測最低價格 =
              可能結果.prices[11].min;
          if (
            this.大頭菜週期價格.星期六.上午.預測最低價格 >
            可能結果.prices[12].min
          )
            this.大頭菜週期價格.星期六.上午.預測最低價格 =
              可能結果.prices[12].min;
          if (
            this.大頭菜週期價格.星期六.下午.預測最低價格 >
            可能結果.prices[13].min
          )
            this.大頭菜週期價格.星期六.下午.預測最低價格 =
              可能結果.prices[13].min;
          this.預測結果.push(可能結果);
        }
      }
      this.modelData = [_pie0, _pie1, _pie2, _pie3];
      // if (_pie0 == 0 && _pie1 == 0 && _pie2 == 0 && _pie3 == 0) {
      //     this.彈跳視窗預測();
      // }
    },
    清空輸入資料() {
      localStorage.clear();
      this.大頭菜週期價格.星期一.上午.設定價格 = "";
      this.大頭菜週期價格.星期一.下午.設定價格 = "";
      this.大頭菜週期價格.星期二.上午.設定價格 = "";
      this.大頭菜週期價格.星期二.下午.設定價格 = "";
      this.大頭菜週期價格.星期三.上午.設定價格 = "";
      this.大頭菜週期價格.星期三.下午.設定價格 = "";
      this.大頭菜週期價格.星期四.上午.設定價格 = "";
      this.大頭菜週期價格.星期四.下午.設定價格 = "";
      this.大頭菜週期價格.星期五.上午.設定價格 = "";
      this.大頭菜週期價格.星期五.下午.設定價格 = "";
      this.大頭菜週期價格.星期六.上午.設定價格 = "";
      this.大頭菜週期價格.星期六.下午.設定價格 = "";
      this.大頭菜起始價格.起始買入價格 = 100;
      localStorage.clear();
      this.渲染折條圖();
    },
  },
  watch: {
    "大頭菜起始價格.起始買入價格": function (價格資訊) {
      localStorage.起始買入價格 = 價格資訊;
    },
    "大頭菜週期價格.星期一.上午.設定價格": function (價格資訊) {
      localStorage.星期一上午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期一.下午.設定價格": function (價格資訊) {
      localStorage.星期一下午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期二.上午.設定價格": function (價格資訊) {
      localStorage.星期二上午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期二.下午.設定價格": function (價格資訊) {
      localStorage.星期二下午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期三.上午.設定價格": function (價格資訊) {
      localStorage.星期三上午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期三.下午.設定價格": function (價格資訊) {
      localStorage.星期三下午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期四.上午.設定價格": function (價格資訊) {
      localStorage.星期四上午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期四.下午.設定價格": function (價格資訊) {
      localStorage.星期四下午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期五.上午.設定價格": function (價格資訊) {
      localStorage.星期五上午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期五.下午.設定價格": function (價格資訊) {
      localStorage.星期五下午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期六.上午.設定價格": function (價格資訊) {
      localStorage.星期六上午設定價格 = 價格資訊;
    },
    "大頭菜週期價格.星期六.下午.設定價格": function (價格資訊) {
      localStorage.星期六下午設定價格 = 價格資訊;
    },
  },
};
Date.prototype.yyyymmdd = function (val = "$1-$2-$3") {
  return this.toLocaleString("zh-TW", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
  }).replace(/(\d+)\/(\d+)\/(\d+)/, val);
};
</script>

<style>
/* CONTAINERS */
.checkout-container {
  max-width: 850px;
  width: 100%;
  margin: 0 auto;
}
.first-col {
  width: 48.6%;
  max-width: 50%;
}
.pattern-col {
  width: 18.6%;
  max-width: 50%;
}
/* COLUMNS */
.col {
  display: block;
  float: left;
  margin: 1% 0 1% 1.6%;
}
.col:first-of-type {
  margin-left: 0;
}
/* CLEARFIX */
.cf:before,
.cf:after {
  content: " ";
  display: table;
}
.cf:after {
  clear: both;
}
.cf {
  *zoom: 1;
}
/* FORM */
.form .plan input,
.form .payment-plan input,
.form .payment-type input {
  display: none;
}
.form label {
  position: relative;
  color: #fff;
  background-color: #888;
  font-size: 26px;
  text-align: center;
  height: 150px;
  line-height: 150px;
  display: block;
  cursor: pointer;
  border: 3px solid transparent;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.form .plan input:checked + label,
.form .payment-plan input:checked + label,
.form .payment-type input:checked + label {
  border: 3px solid #333;
  background-color: #2fcc71;
}
.form .plan input:checked + label:after,
form .payment-plan input:checked + label:after,
.form .payment-type input:checked + label:after {
  content: "\2713";
  width: 40px;
  height: 40px;
  line-height: 40px;
  border-radius: 100%;
  border: 2px solid #333;
  background-color: #2fcc71;
  z-index: 1;
  position: absolute;
  top: 8px;
  right: 8px;
}
</style>
