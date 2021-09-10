<template>
    <div class="multi-step-form" style="max-width: 100vw;">
        <div class="multi-form py-3 mx-3">
            <div class="inner">
                <ul class="steps p-0" @click="onClickListener($event)">
                    <!-- Step 1 - 編輯文章內容 Start -->
                    <li ref="listItem1" class="listItem show" id="step1">
                        <div class="col1">
                            <span class="step">
                                <span>1</span>
                                <span class="checkmark"></span>
                            </span>
                            <span class="line"></span>
                        </div>
                        <div ref="stepBody" class="col2 stepBody">
                            <div class="stepTitle">
                                Step 1 - 編輯文章內容
                            </div>
                            <div class="content">
                                <div class="inputGroup">
                                    <label for="name">跟大家分享你的靠北事吧。</label>
                                    <textarea
                                        class="form-control cards-editor"
                                        rows="8"
                                        minlength="30"
                                        maxlength="4096"
                                        v-model="content"
                                        required
                                        @keyup="onKeyupListener($event)"></textarea>
                                </div>
                                <div class="buttons pt-2">
                                    <button class="next" disabled>下一步</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Step 1 - 編輯文章內容 End -->

                    <!-- Step 2 - 選擇主題樣式 Start -->
                    <li ref="listItem2" class="listItem" id="step2">
                        <div class="col1">
                            <span class="step">
                                <span>2</span>
                                <span class="checkmark"></span>
                            </span>
                            <span class="line"></span>
                        </div>
                        <div ref="stepBody" class="col2 stepBody">
                            <div class="stepTitle">
                                Step 2 - 選擇主題樣式
                            </div>
                            <div class="row mt-2">
                                <div class="col-6 col-md-4 col-lg-3 p-1" v-for="theme in themes" v-bind:key="theme">
                                    <input type="radio" name="theme" :id="theme" v-model="selector.theme" v-bind:value="theme">
                                    <label :for="theme">
                                        <img :src="`/img/frontend/article/theme/${theme}.png`" class="img-fluid rounded">
                                    </label>
                                </div>
                            </div>
                            <div class="content">
                                <div class="buttons pt-2">
                                    <button class="next">下一步</button>
                                    <button class="prev">返回</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Step 2 - 選擇主題樣式 End -->

                    <!-- Step 3 - 選擇字型樣式 Start -->
                    <li ref="listItem3" class="listItem" id="step3">
                        <div class="col1">
                            <span class="step">
                                <span>3</span>
                                <span class="checkmark"></span>
                            </span>
                            <span class="line"></span>
                        </div>
                        <div ref="stepBody" class="col2 stepBody">
                            <div class="stepTitle">
                                Step 3 - 選擇字型樣式
                            </div>
                            <div class="row mt-2">
                                <div class="col-6 col-md-4 col-lg-3 p-1" v-for="font in fonts" v-bind:key="font">
                                    <input type="radio" name="font" :id="font" v-model="selector.font" v-bind:value="font">
                                    <label :for="font">
                                        <img :src="`/img/frontend/article/font/${font}.png`" class="img-fluid rounded" />
                                    </label>
                                </div>
                            </div>
                            <div class="content">
                                <div class="buttons pt-2">
                                    <button class="next">下一步</button>
                                    <button class="prev">返回</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Step 3 - 選擇字型樣式 End -->

                    <!-- Step 4 - 同意版規 Start -->
                    <li ref="listItem4" class="listItem" id="step4">
                        <div class="col1">
                            <span class="step">
                                <span>4</span>
                                <span class="checkmark"></span>
                            </span>
                            <span class="line"></span>
                        </div>
                        <div ref="stepBody" class="col2 stepBody">
                            <div class="stepTitle">
                                Step 4 - 同意版規
                            </div>
                            <div class="jumbotron jumbotron-fluid rounded p-2 mt-2">
                                <div class="container p-0">
                                    <h1 class="text-center w-100 py-2 my-0">內容守則</h1>
                                    <h3>一、責任聲明：</h3>
                                    <p>本站使用者須對自己所張貼之每一篇文章負責，本站毋需對站內以及其他關聯之社群媒體的言論負擔起任何的責任，責任的歸屬權屬於各位發表人。</p>
                                    <h3>二、發表文章時之注意事項：</h3>
                                    <ol class="pb-2">
                                        <li>尊重他人意見，注意用字遣詞與口氣，避免引起爭吵。</li>
                                        <li>避免在公眾區域，討論私人事務。</li>
                                        <li>避免發表文章於非相關區域，文章標題及內容不符合討論區之討論主題。</li>
                                        <li>禁止重複刊登相同內容或相同意義之留言。</li>
                                        <li>適度引用文章，避免引用過長文章，造成閱讀困擾。</li>
                                        <li>不適當的廣告、宣傳活動或商業性留言。</li>
                                        <li>禁止發表謾罵、脅迫、挑釁、猥褻或不雅之文字。</li>
                                        <li>禁止發表個人測試用文章或散播不實消息之文章，張貼文章，應自負相關法律責任。</li>
                                        <li>轉貼任何文章請附上原作者貨來源，否則版主會親自去問授權、處理方式，並且把您的帳號封鎖。</li>
                                        <li>禁止以發表防疫相關的調侃、反防疫相關言論。</li>
                                        <li>若有未規定的部份，由版主依主觀認定，視情況處理。</li>
                                    </ol>
                                    <h3>三、違規處理辦法：</h3>
                                    <p>違反上述規定之文章或作者，版主可刪除文章或行使禁貼之處份。</p>
                                    <h3>四、附註及補充說明：</h3>
                                    <ol class="pb-2">
                                        <li>本站歡迎網友互相討論發表己見，唯請務必遵守上述規定。</li>
                                        <li>是否違反上述規定，由版主主觀認定，請謹慎用詞。</li>
                                        <li>請學習包容各種意見，如遇惡意批評或攻擊之文章，切勿加入爭執，並且善用檢舉，版主會有適當之處理，否則雙方</li>皆依上述規定處理。
                                    </ol>
                                </div>
                                <div class="mt-2 text-center">
                                    <input class="tgl tgl-flip" id="consent" type="checkbox" v-model="consent"/>
                                    <label style="display: inline-block;" class="tgl-btn mt-2 mr-2" data-tg-off="杰哥不要！😱" data-tg-on="好ㄛ🥴" for="consent"></label>
                                    <label style="display: inline-block;" :class="[consent ? 'text-success' : 'text-danger']" for="consent">
                                        {{ consent ? '我看完了，我願意遵守以上的內容守則，所以我按了「好ㄛ🥴」以表示我同意。' : '杰哥，不要啦！杰哥不要！我不想遵守「內容守則」😭' }}
                                    </label>
                                </div>
                                <div class="buttons pt-2">
                                    <button class="next" :disabled="!consent">下一步</button>
                                    <button class="prev" style="background-color: var(--background-secondary);">返回</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Step 4 - 同意版規 End -->

                    <!-- Step 5 - 最後確認 Start -->
                    <li ref="listItem5" class="listItem" id="step5">
                        <div class="col1">
                            <span class="step">
                                <span>5</span>
                                <span class="checkmark"></span>
                            </span>
                            <span class="line"></span>
                        </div>
                        <div ref="stepBody" class="col2 stepBody">
                            <div class="stepTitle">
                                Step 5 - 最後確認
                            </div>
                            <div class="content">
                                <article-preview
                                    :content="content"
                                    :theme="selector.theme"
                                    :font="selector.font" />
                                <div class="pt-2"
                                    v-if="final !== 'success'">
                                    <h3 class="w-100">好棒，接下來我們只要「送出投稿」就可以了！</h3>
                                    <div class="buttons">
                                        <button type="button"
                                            class="submit btn yes"
                                            @click="submitForm()"
                                            :disabled="final !== null">
                                            <div v-if="final === null">
                                                送出投稿
                                            </div>
                                            <div v-else>
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </button>
                                        <button class="prev" v-if="final === null">返回</button>
                                    </div>
                                </div>
                                <div v-if="final === 'success'">
                                    <h3 class="success">您成功送出投稿了！</h3>
                                    <p>不過文章還沒有被發表出去，需要經過群眾審核，你也可以參與群眾審核，幫自己的文章投票，</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Step 5 - 最後確認 End -->

                    <!-- Step 6 - 完成 Start -->
                    <li ref="listItem6" class="listItem" id="step6">
                        <div class="col1">
                            <span class="step">
                                <span>6</span>
                                <span class="checkmark"></span>
                            </span>
                            <span class="line"></span>
                        </div>
                        <div ref="stepBody" class="col2 stepBody">
                            <div class="stepTitle">
                                Step 6 - 完成
                            </div>
                            <div class="content">
                                <div class="col-md-8 offset-md-2 mb-3" id="flowchart">
                                    <div class="row">
                                        <ul class="col-12">
                                            <li class="flow-step flow-light">文章投稿</li>
                                            <li class="flow-arrow">
                                                <i class="fas fa-arrow-down"></i>
                                            </li>
                                            <li class="flow-step flow-light">
                                                <p class="mb-0">送出投稿</p>
                                                <h5>
                                                    <span class="badge badge-pill badge-secondary">您現在在這裡</span>
                                                </h5>
                                            </li>
                                            <li class="flow-arrow">
                                                <i class="fas fa-arrow-down"></i>
                                            </li>
                                            <li class="flow-step flow-light">
                                                <p class="mb-0">進入群眾審核系統</p>
                                                <a href="/cards/review" class="p-0">
                                                    <h5>
                                                        <span class="badge badge-pill badge-primary">前往投票</span>
                                                    </h5>
                                                </a>
                                            </li>
                                        </ul>
                                        <ul class="col-4">
                                            <li class="flow-arrow text-success">
                                                <i class="fas fa-arrow-down text-success mr-2"></i>
                                                同意數達標
                                            </li>
                                            <li class="flow-step flow-success">
                                                <p class="m-0">文章發表</p>
                                                <p class="m-0">各社群平台</p>
                                            </li>
                                        </ul>
                                        <ul class="col-8">
                                            <li class="flow-arrow text-warning">
                                                <i class="fas fa-arrow-down text-warning mr-2"></i>
                                                否決票過多
                                            </li>
                                            <li class="flow-step flow-warning">
                                                <p class="m-0">暫時擱置</p>
                                                <p class="m-0">等待管理員審核</p>
                                            </li>
                                        </ul>
                                        <ul class="col-2">
                                            <!-- 空的 -->
                                        </ul>
                                        <ul class="col-5">
                                            <li class="flow-arrow text-success">
                                                審核通過
                                                <i class="fas fa-arrow-down text-success ml-2"></i>
                                            </li>
                                            <li class="flow-step flow-success">
                                                <p class="m-0">文章發表</p>
                                                <p class="m-0">各社群平台</p>
                                            </li>
                                        </ul>
                                        <ul class="col-5">
                                            <li class="flow-arrow text-danger">
                                                <i class="fas fa-arrow-down text-danger mr-2"></i>
                                                審核不通過
                                            </li>
                                            <li class="flow-step flow-danger">
                                                <p class="m-0">投稿失敗</p>
                                                <p class="m-0">文章石沈大海</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Step 6 - 完成 End -->
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import ArticlePreview from './ArticlePreview.vue';
export default {
    name: "PublishArticle",
    components: {
        ArticlePreview,
    },
    data() {
        return {
            stepsWrapper: null,
            listItems: null,
            inputs: null,
            content: '',
            consent: false,
            final: null,
            selector: {
                theme: 'black-green',
                font: 'auraka',
            },
            themes: [
                'black-green',
                'black-yellow',
                'black-white',
                'black-red',
                'sweet-panda',
                'blue-white',
                'white-blue',
                'laravel',
                'soft-green',
                'grey-pikachu',
                'grey-eevee',
                'pikachu-grey',
                'eevee-grey',
                'chinese-new-year',
                'reverse-chinese-new-year',
                'devotion',
                'windows-10-error',
                'windows-10-error-testing',
                'pink',
                'broken-think',
                'furry-broken-think',
            ],
            fonts: [
                'auraka',
                'kc24m',
                'microsoft-jheng-hei',
                'mingliu',
                'kaiu',
                'fot-matissepro-eb',
                'taipei-sans-tc-beta-bold',
            ],
        };
    },
    mounted() {
        this.stepsWrapper = document.querySelector(".steps")
        this.listItems = this.stepsWrapper.querySelectorAll(".listItem")
        this.inputs = this.stepsWrapper.querySelectorAll("input")

        // 預設打開 Step 1
        this.changeSteps(this.$refs.listItem1, this.$refs.listItem1);
    },
    methods: {
        /**
         * 內容更新的觸發事件
         *
         * @param elements event
         *
         * @return void
         */
        onKeyupListener(event) {
            // 用 keyup 為每個 input 添加焦點
            const inputWrapper = event.target.closest(".inputGroup");
            const nextButton = inputWrapper
                .closest(".stepBody")
                .querySelector(".next");

            // 如果是同意內容守則，內容守則被同意了則啟用下一步按鈕
            if (this.consent) {
                return (nextButton.disabled = false);
            }

            // 如果沒有 value，則移除焦點，禁用下一步按鈕並 return
            if (!event.target.value) {
                inputWrapper.closest(".listItem").classList.remove("done");
                inputWrapper.classList.remove("js-focus");
                return (nextButton.disabled = true);
            }
            inputWrapper.classList.add("js-focus");

            // 如果仍有輸入為空，則禁用下一個按鈕
            if (inputWrapper.nextElementSibling.classList.contains("inputGroup") &&
               !inputWrapper.nextElementSibling.querySelector("input").value) {
                return;
            }

            // 如果主要內容輸入長度小於 30 字元
            if (this.content.length < 30) {
                return;
            }

            // 否則啟用下一步按鈕
            nextButton.disabled = false;
        },
        /**
         * 按鈕點擊的觸發事件
         *
         * @param elements event
         *
         * @return void
         */
        onClickListener(event) {
            // 如果單擊不在按鈕上，則返回
            if (!event.target.closest("button")) {
                return;
            }

            const btn = event.target;
            const currentStep = btn.closest(".listItem");

            btn.classList.contains("next")
                ? this.changeSteps(currentStep, currentStep.nextElementSibling)
                : btn.classList.contains("prev")
                    ? this.changeSteps(currentStep, currentStep.previousElementSibling)
                    : null;
        },
        /**
         * 當使用者按下投稿的按鈕後，執行圖片投稿的動作
         *
         * @return void
         */
        submitForm() {
            // 將目前狀態改為發送表單當中
            this.final = 'submit';

            // 彙整資料格式並執行呼叫 API
            let self = this;
            let data = {
                content: self.content,
                config: {
                    theme: self.selector.theme,
                    font: self.selector.font,
                },
            };
            axios.post(`/api/social/cards/publish/article`, data)
                .then((response) => {
                    // 圖片投稿成功，將目前狀態改為發表成功，將頁面移動到完成頁面
                    self.final = 'success';
                    self.changeSteps(self.$refs.listItem5, self.$refs.listItem6);

                    // 取出投稿編號，並顯示訊息給使用者看
                    let id = response.data.id;
                    Swal.fire(
                        '您成功投稿圖片了！',
                        `您的文章編號為<a href="/cards/show/${id}"> ${id}(#${id.toString(36)}) </a>您的投稿接下來會進入<a href="/cards/review">群眾審核系統</a>當中等待審核，這項系統是所有人都能參與的，您也可以投票給自己投稿的文章，加速文章被發表的速度。`,
                        'success'
                    );
                })
                // 圖片投稿失敗，將目前裝態改為初始狀態，並顯示 Error 通知
                .catch((error) => {
                    self.final = null;
                    Swal.fire(
                        '噢噗！怪怪的？',
                        '投稿文章時發生了一些錯誤，可以的話，把這項問題拿到<a href="https://github.com/init-engineer/init.engineer"> GitHub repo </a>發個 issue 給我，謝謝你 m(_ _)m',
                        'error'
                    );
                });
        },
        /**
         * 計算 Step 需要關閉及展開的頁面高度
         *
         * @param elements currentStep
         * @param elements newStep
         *
         * @return void
         */
        changeSteps(currentStep, newStep) {
            // 取得尚未關閉的 Step 高度，並將當前 Step 關閉
            currentStep.style.height = getComputedStyle(newStep).height;
            currentStep.classList.remove("show");

            // 如果按下繼續按鈕，則添加複選標記
            if (newStep === currentStep.nextElementSibling)
                currentStep.classList.add("done");

            // 打開下一步
            const contentHeight = newStep
                .querySelector(".stepBody")
                .getBoundingClientRect().height;
            newStep.style.height = `${contentHeight}px`;
            newStep.classList.add("show");

            // 執行畫面移動的動作
            this.scrollTo(newStep.id);
        },
        /**
         * 將畫面移動到指定的 Step
         *
         * @param string id 步驟 ID 標籤，用來判斷畫面需要移動到哪個步驟
         *
         * @return void
         */
        scrollTo(id) {
            // 計算 alert 公告的高度
            let alert = document.getElementsByClassName('alert');
            let alertHeight = 48;
            for (var i = 0; i < alert.length; i++) {
                alertHeight = alertHeight + alert[i].getBoundingClientRect().height;
            }

            // 根據 Step 來判斷需要疊加的高度
            let y = 0;
            switch (id) {
                case 'step1': y = 0; break;
                case 'step2': y = 66; break;
                case 'step3': y = 132; break;
                case 'step4': y = 198; break;
                case 'step5': y = 264; break;
                case 'step6': y = 330; break;
            }

            // 執行畫面移動的動作
            window.scrollTo({top: alertHeight + y, behavior: 'smooth'});
        },
    },
};
</script>
