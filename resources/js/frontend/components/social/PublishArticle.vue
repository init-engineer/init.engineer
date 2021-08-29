<template>
    <div class="multi-step-form">
        <h1 class="text-center">勁爆投稿系統(Strength Burst Publish System, SBPS) Version 2.0</h1>
        <div class="multi-form p-3 mx-3">
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
                                Step 4 - 選擇其他樣式
                            </div>
                            <div class="content">
                                <!-- wrap inputs into div to enable :focus-within css selector on container -->
                                <div class="inputGroup">
                                    <label for="email">Your email</label>
                                    <input @keyup="onKeyupListener($event)" autocomplete="off" type="email" name="email" id="email" />
                                </div>
                                <div class="inputGroup">
                                    <label for="password">Set password</label>
                                    <input @keyup="onKeyupListener($event)" autocomplete="off" type="password" name="password" id="password" />
                                </div>
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
                                <span>5</span>
                                <span class="checkmark"></span>
                            </span>
                            <span class="line"></span>
                        </div>
                        <div ref="stepBody" class="col2 stepBody">
                            <div class="stepTitle">
                                Step 5 - 同意版規
                            </div>
                            <div class="content">
                                <!-- wrap inputs into div to enable :focus-within css selector on container -->
                                <div class="inputGroup">
                                    <label for="email">Your email</label>
                                    <input @keyup="onKeyupListener($event)" autocomplete="off" type="email" name="email" id="email" />
                                </div>
                                <div class="inputGroup">
                                    <label for="password">Set password</label>
                                    <input @keyup="onKeyupListener($event)" autocomplete="off" type="password" name="password" id="password" />
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
                                <span>6</span>
                                <span class="checkmark"></span>
                            </span>
                            <span class="line"></span>
                        </div>
                        <div ref="stepBody" class="col2 stepBody">
                            <div class="stepTitle">
                                Step 6 - 最後確認
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

            // 否則啟用下一步按鈕
            nextButton.disabled = false;
        },
        onClickListener(e) {
                    // 如果單擊不在按鈕上，則返回
        if (!e.target.closest("button")) return;

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
            console.log(contentHeight);
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
