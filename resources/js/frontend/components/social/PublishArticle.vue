<template>
    <div class="multi-step-form" style="max-width: 100vw;">
        <div class="multi-form py-3 mx-3">
            <div class="inner">
                <ul class="steps p-0" @click="onClickListener($event)">
                    <li ref="listItem" class="listItem show">
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
                                <div class="buttons">
                                    <button class="next" disabled>下一步</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li ref="listItem" class="listItem">
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
                                        <!-- <i class="checked fa fa-check icon"></i> -->
                                        <img :src="`/img/frontend/article/theme/${theme}.png`" class="img-fluid rounded">
                                    </label>
                                </div>
                            </div>
                            <div class="content">
                                <div class="buttons">
                                    <button class="next">下一步</button>
                                    <button class="prev">返回</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li ref="listItem" class="listItem">
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
                                        <!-- <i class="checked fa fa-check icon"></i> -->
                                        <img :src="`/img/frontend/article/font/${font}.png`" class="img-fluid rounded">
                                    </label>
                                </div>
                            </div>
                            <div class="content">
                                <div class="buttons">
                                    <button class="next">下一步</button>
                                    <button class="prev">返回</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li ref="listItem" class="listItem">
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
                                <div class="container">
                                    <h1 class="text-center w-100 py-2 my-0">內容守則</h1>
                                    <pre>一、責任聲明：
本站使用者須對自己所張貼之每一篇文章負責，本站毋需對站內以及其他關聯之社群媒體的言論負擔起任何的責任，責任的歸屬權屬於各位發表人。

二、發表文章時之注意事項：
1. 尊重他人意見，注意用字遣詞與口氣，避免引起爭吵。
2. 避免在公眾區域，討論私人事務。
3. 避免發表文章於非相關區域，文章標題及內容不符合討論區之討論主題。
4. 禁止重複刊登相同內容或相同意義之留言。
5. 適度引用文章，避免引用過長文章，造成閱讀困擾。
6. 不適當的廣告、宣傳活動或商業性留言。
7. 禁止發表謾罵、脅迫、挑釁、猥褻或不雅之文字。
8. 禁止發表個人測試用文章或散播不實消息之文章，張貼文章，應自負相關法律責任。
9. 轉貼任何文章請附上原作者貨來源，否則版主會親自去問授權、處理方式，並且把您的帳號封鎖。
10. 禁止以發表防疫相關的調侃、反防疫相關言論。
11. 若有未規定的部份，由版主依主觀認定，視情況處理。

三、違規處理辦法：
違反上述規定之文章或作者，版主可刪除文章或行使禁貼之處份。

四、附註及補充說明：
1. 本站歡迎網友互相討論發表己見，唯請務必遵守上述規定。
2. 是否違反上述規定，由版主主觀認定，請謹慎用詞。
3. 請學習包容各種意見，如遇惡意批評或攻擊之文章，切勿加入爭執，並且善用檢舉，版主會有適當之處理，否則雙方皆依上述規定處理。</pre>
                                    <hr>
                                    <div class="pretty p-icon p-smooth">
                                        <input type="checkbox" id="checkbox">
                                        <div class="state p-success">
                                            <i class="icon fas fa-check"></i>
                                            <label class="text-danger">我看完了，我願意遵守以上的內容守則，所以我按了勾勾以表示我同意。</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <button class="next" disabled>下一步</button>
                                    <button class="prev">返回</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li ref="listItem" class="listItem">
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
                                <div class="inputGroup">
                                    <p>
                                        Congratulations! Now you're all set,<br />
                                        hit that submit button!
                                    </p>
                                </div>
                                <div class="buttons">
                                    <button class="submit">送出投稿</button>
                                    <button class="prev">返回</button>
                                </div>
                                <div class="message">
                                    <span class="success">You signed up succesfully!</span>
                                    <span class="fail">Oops, something went wrong! Please double-check your inputs.</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PublishArticle",
    data() {
        return {
            stepsWrapper: null,
            listItems: null,
            inputs: null,
            content: null,
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
        this.listItems[0].style.height = '630px';
    },
    methods: {
        onKeyupListener(e) {
            // 用 keyup 為每個 input 添加焦點
            const inputWrapper = e.target.closest(".inputGroup");
            const nextButton = inputWrapper
                .closest(".stepBody")
                .querySelector(".next");
            // 如果沒有 value，則移除焦點，禁用下一步按鈕並 return
            if (!e.target.value) {
                inputWrapper.closest(".listItem").classList.remove("done");
                inputWrapper.classList.remove("js-focus");
                return (nextButton.disabled = true);
            }
            inputWrapper.classList.add("js-focus");

            // 如果仍有輸入為空，則禁用下一個按鈕
            if (inputWrapper.nextElementSibling.classList.contains("inputGroup") &&
               !inputWrapper.nextElementSibling.querySelector("input").value)
                return;

            if (this.content.length < 30) {
                return;
            }

            // 否則啟用下一步按鈕
            nextButton.disabled = false;
        },
        onClickListener(e) {
            // 如果單擊不在按鈕上，則返回
            if (!e.target.closest("button")) {
                return;
            }

            const btn = e.target;
            const currentStep = btn.closest(".listItem");

            btn.classList.contains("next")
                ? this.changeSteps(currentStep, currentStep.nextElementSibling)
                : btn.classList.contains("prev")
                    ? this.changeSteps(currentStep, currentStep.previousElementSibling)
                    : this.submitForm(btn);
        },
        changeSteps(currentStep, newStep) {
            // 1. 關閉當前步驟
            currentStep.style.height = getComputedStyle(newStep).height; // 獲取（尚未）關閉下一步的高度
            currentStep.classList.remove("show");
            // 如果按下繼續按鈕，則添加複選標記
            if (newStep === currentStep.nextElementSibling)
                currentStep.classList.add("done");

            // 2. 打開下一步
            const contentHeight = newStep
                .querySelector(".stepBody")
                .getBoundingClientRect().height;
            newStep.style.height = `${contentHeight}px`;
            newStep.classList.add("show");
        },
        submitForm(btn) {
            // 提交時顯示成功信息
            btn.closest(".buttons").nextElementSibling.classList.add("success");
            // 隱藏 back 按鈕
            btn.nextElementSibling.style.display = "none";
        },
    },
};
</script>
