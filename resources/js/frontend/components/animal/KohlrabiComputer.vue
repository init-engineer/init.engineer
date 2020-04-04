<template>
    <div>
        <marquee-text class="mb-3">
            <h1 class="text-white">投資一定有風險，大頭菜有賺有賠，申購前應詳閱公開說明書。</h1>
        </marquee-text>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.起始 }} 大頭菜 買入價格</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="大頭菜買入價格" v-model.number="大頭菜起始價格.起始買入價格" number required>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                    <p class="text-danger text-right"><strong>必填</strong></p>
                </div>
                <!--form-group-->
            </div>
            <!--col-->

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.起始 }} 大頭菜 賣出價格</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="大頭菜賣出價格" v-model.number="大頭菜起始價格.起始賣出價格" number required>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                    <p class="text-danger text-right"><strong>必填</strong></p>
                </div>
                <!--form-group-->
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row">
            <div class="col-4 col-md-2">
                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期一 }}(一) 上午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期一.上午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期一 }}(一) 下午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期一.下午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->
            </div>

            <div class="col-4 col-md-2">
                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期二 }}(二) 上午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期二.上午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期二 }}(二) 下午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期二.下午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->
            </div>

            <div class="col-4 col-md-2">
                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期三 }}(三) 上午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期三.上午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期三 }}(三) 下午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期三.下午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->
            </div>

            <div class="col-4 col-md-2">
                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期四 }}(四) 上午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期四.上午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期四 }}(四) 下午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期四.下午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->
            </div>

            <div class="col-4 col-md-2">
                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期五 }}(五) 上午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期五.上午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期五 }}(五) 下午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期五.下午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->
            </div>

            <div class="col-4 col-md-2">
                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期六 }}(六) 上午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期六.上午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group">
                    <label class="col-label">{{ 大頭菜起始價格.起始日期.星期六 }}(六) 下午</label>
                    <div class="input-group">
                        <input class="form-control cards-editor text-right" placeholder="賣出價格" v-model.number="大頭菜週期價格.星期六.下午.設定價格" number>
                        <div class="input-group-append"><span class="input-group-text">鈴錢</span></div>
                    </div>
                </div>
                <!--form-group-->
            </div>
        </div>
        <!--row-->

        <div class="row">
            <div class="col">
                <div class="form-group clearfix">
                    <label class="col-label">狸？</label>
                    <button class="h3 btn btn-block btn-dos btn-lg" @click="判斷大頭菜模型()">我輸入完了，幫我算算看！</button>
                </div>
                <!--form-group-->
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
</template>

<script>
import MarqueeText from "vue-marquee-text-component";

export default {
    name: "KohlrabiComputer",
    components: {
        MarqueeText,
    },
    data() {
        return {
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
                起始買入價格: null,
                起始賣出價格: null,
            },
            大頭菜週期價格: {
                星期一: {
                    上午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                    下午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                },
                星期二: {
                    上午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                    下午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                },
                星期三: {
                    上午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                    下午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                },
                星期四: {
                    上午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                    下午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                },
                星期五: {
                    上午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                    下午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                },
                星期六: {
                    上午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
                    下午: { 設定價格: null, 預測最高價格: null, 預測最低價格: null, 漲幅百分比: null },
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
        this.計算起始日期();
    },
    methods: {
        判斷大頭菜模型() {
            if (this.大頭菜起始價格.起始買入價格 === null || this.大頭菜週期價格.星期一.上午.設定價格 === null) {
                Swal.fire(
                    "無法判斷",
                    "判斷大頭菜模型至少需要「起始基礎價格」以及「星期一上午價格」。",
                    "error"
                );
                return;
            }

            const _R1 = this.大頭菜週期價格.星期一.上午.設定價格 / this.大頭菜起始價格.起始買入價格;

            if (_R1 >= 0.9) {
                // 四期型 或 波型
                // 步驟 2-1
                if (this.大頭菜週期價格.星期一.下午.設定價格 === null && this.大頭菜週期價格.星期二.上午.設定價格 === null) {
                    this.大頭菜週期模式 = ['四期型', '波型'];
                    Swal.fire(
                        "可能為「四期型」或「波型」",
                        "因為缺少「星期一下午價格」以及「星期二上午價格」，所以只能預測可能的模型。",
                        "warning"
                    );
                    return;
                }

                if (this.大頭菜週期價格.星期一.下午.設定價格 != null && this.大頭菜週期價格.星期二.上午.設定價格 === null) {
                    const _R21 = this.大頭菜週期價格.星期一.下午.設定價格 / this.大頭菜起始價格.起始買入價格;
                    if (_R21 > 0.8) {
                        this.大頭菜週期模式 = ['四期型', '波型'];
                        Swal.fire(
                            "可能為「四期型」或「波型」",
                            "因為缺少「星期二上午價格」，所以只能預測可能的模型。",
                            "warning"
                        );
                        return;
                    } else {
                        this.大頭菜週期模式 = ['波型'];
                        Swal.fire(
                            "波型",
                            "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
                            "success"
                        );
                        return;
                    }
                }

                if (this.大頭菜週期價格.星期一.下午.設定價格 === null && this.大頭菜週期價格.星期二.上午.設定價格 != null) {
                    const _R21 = this.大頭菜週期價格.星期二.上午.設定價格 / this.大頭菜起始價格.起始買入價格;
                    if (_R21 < 1.4) {
                        this.大頭菜週期模式 = ['四期型', '波型'];
                        Swal.fire(
                            "可能為「四期型」或「波型」",
                            "因為缺少「星期一下午價格」，所以只能預測可能的模型。",
                            "warning"
                        );
                        return;
                    } else {
                        this.大頭菜週期模式 = ['波型'];
                        Swal.fire(
                            "波型",
                            "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
                            "success"
                        );
                        return;
                    }
                }

                const _R211 = this.大頭菜週期價格.星期一.下午.設定價格 / this.大頭菜起始價格.起始買入價格;
                const _R212 = this.大頭菜週期價格.星期二.上午.設定價格 / this.大頭菜起始價格.起始買入價格;
                if (_R211 > 0.8 && _R212 < 1.4) {
                    Swal.fire(
                        "四期型",
                        "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                        "success"
                    );
                    return;
                } else {
                    Swal.fire(
                        "波型",
                        "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
                        "success"
                    );
                    return;
                }
            } else if (_R1 < 0.9 && _R1 >= 0.85) {
                // 三期型 或 四期型 或 遞減型
                // 步驟 3
                if (this.大頭菜週期價格.星期一.上午.設定價格 != null && this.大頭菜週期價格.星期一.下午.設定價格 != null &&
                    this.大頭菜週期價格.星期二.上午.設定價格 != null && this.大頭菜週期價格.星期二.下午.設定價格 != null &&
                    this.大頭菜週期價格.星期三.上午.設定價格 != null && this.大頭菜週期價格.星期三.下午.設定價格 != null &&
                    this.大頭菜週期價格.星期四.上午.設定價格 != null && this.大頭菜週期價格.星期四.下午.設定價格 != null) {

                    if (this.大頭菜週期價格.星期一.上午.設定價格 >= this.大頭菜週期價格.星期一.下午.設定價格 &&
                        this.大頭菜週期價格.星期一.下午.設定價格 >= this.大頭菜週期價格.星期二.上午.設定價格 &&
                        this.大頭菜週期價格.星期二.上午.設定價格 >= this.大頭菜週期價格.星期二.下午.設定價格 &&
                        this.大頭菜週期價格.星期二.下午.設定價格 >= this.大頭菜週期價格.星期三.上午.設定價格 &&
                        this.大頭菜週期價格.星期三.上午.設定價格 >= this.大頭菜週期價格.星期三.下午.設定價格 &&
                        this.大頭菜週期價格.星期三.下午.設定價格 >= this.大頭菜週期價格.星期四.上午.設定價格 &&
                        this.大頭菜週期價格.星期四.上午.設定價格 >= this.大頭菜週期價格.星期四.下午.設定價格) {

                        Swal.fire(
                            "遞減型",
                            "最淺顯易懂的模型，一定不會賺錢。",
                            "success"
                        );
                        return;
                    } else {
                        if ((this.大頭菜週期價格.星期一.上午.設定價格 / this.大頭菜起始價格.起始買入價格) >= 1.4 ||
                            (this.大頭菜週期價格.星期一.下午.設定價格 / this.大頭菜起始價格.起始買入價格) >= 1.4 ||
                            (this.大頭菜週期價格.星期二.上午.設定價格 / this.大頭菜起始價格.起始買入價格) >= 1.4 ||
                            (this.大頭菜週期價格.星期二.下午.設定價格 / this.大頭菜起始價格.起始買入價格) >= 1.4 ||
                            (this.大頭菜週期價格.星期三.上午.設定價格 / this.大頭菜起始價格.起始買入價格) >= 1.4 ||
                            (this.大頭菜週期價格.星期三.下午.設定價格 / this.大頭菜起始價格.起始買入價格) >= 1.4 ||
                            (this.大頭菜週期價格.星期四.上午.設定價格 / this.大頭菜起始價格.起始買入價格) >= 1.4) {
                            Swal.fire(
                                "三期型",
                                "最刺激好賺的模型，要發大財就要靠這個。",
                                "success"
                            );
                            return;
                        } else {
                            Swal.fire(
                                "四期型",
                                "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                                "success"
                            );
                            return;
                        }
                    }
                } else {
                    Swal.fire(
                        "可能為「三期型」、「四期型」或「遞減型」",
                        "因為缺乏星期一上午至星期四下午的價格資料，所以只能預測可能的模型。",
                        "warning"
                    );
                    return;
                }
            } else if (_R1 < 0.85 && _R1 >= 0.8) {
                Swal.fire(
                    "四期型",
                    "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                    "success"
                );
            } else if (_R1 < 0.8 && _R1 >= 0.6) {
                // 四期型 或 波型
                // 步驟 2-2
                if (this.大頭菜週期價格.星期一.下午.設定價格 === null || this.大頭菜週期價格.星期二.上午.設定價格 === null) {
                    Swal.fire(
                        "可能為「四期型」或「波型」",
                        "因為缺乏星期一上午至星期二下午的價格資料，所以只能預測可能的模型。",
                        "warning"
                    );
                    return;
                } else {
                    const _R221 = (this.大頭菜週期價格.星期一.上午.設定價格 / this.大頭菜起始價格.起始買入價格) - (this.大頭菜週期價格.星期一.下午.設定價格 / this.大頭菜起始價格.起始買入價格);
                    const _R222 = (this.大頭菜週期價格.星期一.下午.設定價格 / this.大頭菜起始價格.起始買入價格) - (this.大頭菜週期價格.星期二.上午.設定價格 / this.大頭菜起始價格.起始買入價格);

                    if (_R221 >= 0.05 && _R222 >= 0.05) {
                        Swal.fire(
                            "波型",
                            "波型固定會有 2 次的下跌階段與 3 次的上漲階段。",
                            "success"
                        );
                        return;
                    } else {
                        Swal.fire(
                            "四期型",
                            "相當平均的模型，容易在早期發現，也可以賣到上限 2 倍買價的錢，不錯。",
                            "success"
                        );
                        return;
                    }
                }
            } else if (_R1 < 0.6) {
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
            this.大頭菜起始價格.起始日期.星期一 = 起始日期.yyyymmdd('$2-$3');

            起始日期.setDate(起始日期.getDate() + 1);
            this.大頭菜起始價格.起始日期.星期二 = 起始日期.yyyymmdd('$2-$3');

            起始日期.setDate(起始日期.getDate() + 1);
            this.大頭菜起始價格.起始日期.星期三 = 起始日期.yyyymmdd('$2-$3');

            起始日期.setDate(起始日期.getDate() + 1);
            this.大頭菜起始價格.起始日期.星期四 = 起始日期.yyyymmdd('$2-$3');

            起始日期.setDate(起始日期.getDate() + 1);
            this.大頭菜起始價格.起始日期.星期五 = 起始日期.yyyymmdd('$2-$3');

            起始日期.setDate(起始日期.getDate() + 1);
            this.大頭菜起始價格.起始日期.星期六 = 起始日期.yyyymmdd('$2-$3');
        },
        計算漲幅百分比() {
            if (this.大頭菜起始價格.起始價格 === null) {
                return;
            }

            // 註：每期之間的跌幅算法為 (上期÷基礎價格) x 100％ - (下期÷基礎價格) x 100％
            const 上期價格 = this.大頭菜起始價格.起始價格;
            this.大頭菜週期價格.forEach(日期 => {
                if (日期.上午.設定價格 != null && 日期.下午.設定價格 != null) {
                    const 漲幅 = 上期價格 / this.大頭菜起始價格.起始價格;
                }

                if (日期.上午.設定價格 != null && 日期.下午.設定價格 === null) {

                }
            });
        },
    },
};

Date.prototype.yyyymmdd = function(val = '$1-$2-$3') {
    return this.toLocaleString('zh-TW', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    }).replace(/(\d+)\/(\d+)\/(\d+)/, val);
};
</script>
