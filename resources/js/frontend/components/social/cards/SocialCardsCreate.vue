<template>
    <div>
        <marquee-text class="mb-3">
            <h1 class="text-white">發源自臉書──全台最大工程師廢文社群 (´◓Д◔`) 我看你是不夠敏捷ㄛ？</h1>
        </marquee-text>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-label">canvas.frontend.cards.edit</label>
                    <textarea v-model="canvas.content" @keyup="onContentKeyup($event)" class="form-control cards-editor" placeholder="跟大家分享你的靠北事吧。" rows="7" minlength="6" maxlength="1024" required=""></textarea>
                    <p class="text-danger text-right"><strong>【注意事項】字數有限制，字不能太少，也不能太多字。</strong></p>
                </div><!--form-group-->
            </div><!--col-->

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-label">canvas.frontend.cards.preview</label>
                    <canvas ref="canvasView" class="rounded mx-auto d-block w-100" width="960" height="720">
                        <!-- 倘若使用者的瀏覽器並不支援 canvas，將會顯示該段內容。 -->
                        您的瀏覽器必須支援 HTML5 標籤語法，才能使用圖片(即時)預覽功能。
                    </canvas>
                </div>
            </div>
        </div><!--row-->

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="col-label">label.frontend.cards.theme-selector</label>
                    <select v-model="theme.selector" @change="onThemeChange($event)" class="form-control form-control-lg" :class="theme.options.find(option => option.value === theme.selector).class">
                        <option v-for="option in theme.options" :key="option.value" :class="option.class" :value="option.value">
                            {{ option.text }}
                        </option>
                    </select>
                </div><!--input-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="col-label">label.frontend.cards.font-selector</label>
                    <select v-model="font.selector" @change="onFontChange($event)" class="form-control form-control-lg btn-dark text-white">
                        <option v-for="option in font.options" :key="option.value" :value="option.value">
                            {{ option.text }}
                        </option>
                    </select>
                </div><!--input-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <!-- <img src="/img/frontend/og/QbQaeAxOUcQJfHPhKlLBUQGGHFoyQLj0u2k4eI8ykndZGQhfTomEUwkPzWbcTzLx.png" class="img-fluid" style="max-hei" alt="可以直接上傳梗圖"> -->
                    <label class="col-label">label.frontend.cards.avatar-input</label>
                    <picture-input ref="avatarInput"
                        class="bg-black text-white"
                        width='1920'
                        height='360'
                        :crop="false"
                        margin='12'
                        accept='image/jpeg,image/png,image/gif'
                        buttonClass='h3 btn btn-block btn-dos btn-lg'
                        size='2'
                        :customStrings="{
                            drag: '點我可以直接上傳圖片ㄛ🐱',
                            change: '換別張圖好惹',
                        }">
                    </picture-input>
                </div><!--input-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <div class="form-group clearfix ">
                    <label class="col-label">button.frontend.cards.send</label>
                    <button class="h3 btn btn-block btn-dos btn-lg" type="submit">發表文章</button>
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--container-->
</template>

<script>
    import MarqueeText from 'vue-marquee-text-component';
    import PictureInput from 'vue-picture-input';
    import FontFaceObserver from 'fontfaceobserver';

    export default {
        components: {
            MarqueeText,
            PictureInput,
        },
        data() {
            return {
                canvas: {
                    view: null,
                    ctx: null,
                    default_width: 960,
                    default_height: 720,
                    width: 960,
                    height: 720,
                    is_center: true,
                    content: '',
                    color: '#00FF3B',
                    background_color: '#000000',
                    font: 'Auraka',
                },
                avatar: null,
                theme: {
                    selector: '2e6046c7387d8fbe9acd700394a3add3',
                    options: [
                        { text: '黑底綠字', class: 'bg-dark text-success', value: '2e6046c7387d8fbe9acd700394a3add3', color: { background: '#000000', text: '#00FF3B', } },
                        { text: '黑底黃字', class: 'bg-dark text-warning', value: 'be551aa525b9d13790278b008a9ec7bf', color: { background: '#000000', text: '#EBD443', } },
                        { text: '黑底白字', class: 'bg-dark text-white', value: '8a755c0bd32e29f813c1aa4267357d5a', color: { background: '#000000', text: '#F8F9FA', } },
                        { text: '黑底紅字', class: 'bg-dark text-danger', value: '507d8c23bdcc98850c7be1c1286d5dcf', color: { background: '#000000', text: '#DC3545', } },
                        { text: '甜甜香草巧克力熊貓', class: 'bg-pink text-white', value: '7d37ef838c73b3397403eec4bf4f3839', color: { background: '#E83E8C', text: '#F8F9FA', } },
                        { text: '藍白屏', class: 'bg-primary text-white', value: '4834578267bcb800feb2762d2a3ccff2', color: { background: '#007BFF', text: '#F8F9FA', } },
                        { text: 'PostgreSQL', class: 'bg-light text-primary', value: 'dc7b1c2c41639e5cf10f725d60ad8c64', color: { background: '#F8F9FA', text: '#007BFF', } },
                        { text: 'Laravel', class: 'bg-laravel text-white', value: 'a5c95b86291ea299fcbe64458ed12702', color: { background: '#F4645F', text: '#F8F9FA', } },
                        { text: '軟體綠', class: 'bg-softgreen text-dark', value: '731019ad725385614d65fbcc5fb1758e', color: { background: '#39C5BB', text: '#000000', } },
                        { text: '皮卡丘', class: 'bg-switch color-pikachu', value: '9CE44F88A25272B6D9CBB430EBBCFCF1', color: { background: '#2F3437', text: '#FFD547', } },
                        { text: '伊布', class: 'bg-switch color-eevee', value: '640ED62B7D35C1765A05EB8724535A53', color: { background: '#2F3437', text: '#E7AF56', } },
                        { text: '反向 皮卡丘', class: 'bg-pikachu color-switch', value: '9A2E33D968A1AF98B09E26AC63CB6DCB', color: { background: '#FFD547', text: '#2F3437', } },
                        { text: '反向 伊布', class: 'bg-eevee color-switch', value: '98C614FBC16CCF5D5740BD4D4E00757C', color: { background: '#E7AF56', text: '#2F3437', } },
                        { text: '新年限定主題', class: 'bg-ch-new-year-2019-red color-ch-new-year-2019-yellow', value: '2be6c9a365a26a12876145e9229639b1', color: { background: '#A61723', text: '#D8B06A', } },
                        { text: '反向 新年限定主題', class: 'bg-ch-new-year-2019-yellow color-ch-new-year-2019-red', value: 'b9b8ae80a601616cb9af07aaabe532f4', color: { background: '#D8B06A', text: '#A61723', } },
                        { text: '恭迎慈孤觀音 渡世靈顯四方', class: 'bg-devotion text-dark', value: '05217b7d4741e38096a54eff4226c217', color: { background: '#F11541', text: '#000000', } },
                        { text: 'Windows 最棒的畫面', class: 'bg-windows-10-error text-white', value: '32d2a897602ef652ed8e15d66128aa74', color: { background: '#007BD0', text: '#F8F9FA', } },
                        // { text: '支離滅裂な思考・発言', class: 'bg-windows-10-error text-white', value: '05326525f82b9a036e1bcb53a392ff7c', color: { background: '#F8F9FA', text: '#F8F9FA', } },
                    ],
                },
                font: {
                    selector: 'ea98dde8987df3cd8aef75479019b688',
                    options: [
                        { text: 'AURAKA 點陣宋字型', font:'Auraka', value: 'ea98dde8987df3cd8aef75479019b688', },
                        { text: '國喬點陣字型', font:'KC24M', value: '813ca6cbbd95d7e08fa2af59bc12072d', },
                        { text: 'ZPIX 點陣字型', font:'Zfull', value: '1b23b3cd9223930ac694b7f29f38ff21', },
                        { text: '張海山銳諧體', font:'Harmonic', value: '68068fcf50e7cae709cb8ed0b7b9b0f3', },
                        { text: '蒙納繁圓點陣', font:'MBitmapRoundHK', value: 'f762e3a99692b40e5929ab3668606a4a', },
                        { text: '微軟正黑體', font:'Microsoft JhengHei', value: '13f5333afe00f8c7e8da7e0b13ec2c94', },
                        { text: '新細明體', font:'Mingliu', value: 'c0b5dd764ede0ca105be22cf13ebadff', },
                        { text: '標楷體', font:'Kaiu', value: '21881fc6a87aca0dd1afc685cb6ee891', },
                    ],
                },
            }
        },
        mounted() {
            this.drawingAll();
        },
        methods: {
            onContentKeyup(event) {
                this.canvas.content = event.target.value;
                this.drawingAll();
            },
            onThemeChange(event) {
                const theme = this.theme.options.find(option => option.value === this.theme.selector);
                this.canvas.color = theme.color.text;
                this.canvas.background_color = theme.color.background;

                this.drawingAll();
            },
            onFontChange(event) {
                const font = this.font.options.find(option => option.value === this.font.selector);
                this.canvas.font = font.font;

                const ffo = new FontFaceObserver(font.font);
                ffo.load().then(function () {
                    console.log('Font is available.');
                }, function () {
                    Swal.fire({
                        title: '字體需要一點時間載入，載入完成後將會自動替換字體。',
                        width: 600,
                        padding: '3em',
                        backdrop: `
                            rgba(0, 0, 0, 0.4)
                            url('/img/frontend/gif/nyan-cat.gif')
                            center left
                            no-repeat
                        `
                    });
                });

                this.drawingAll();
            },
            drawingAll() {
                this.resetCanvasView();

                this.settingCanvasViewSize();
                this.drawingBackground();
                this.drawingBackgroundImage();
                this.drawingLogo();
                this.drawingUrl();
                this.drawingContent();
            },
            resetCanvasView() {
                this.canvas.view = this.$refs.canvasView;
                this.canvas.ctx = this.canvas.view.getContext('2d');
            },
            settingCanvasViewSize() {
                let lineCount         = this.contentSplit().length;
                let canvasView_center = ((lineCount * 80) < 600)? true : false;
                let canvasView_height = (canvasView_center)? this.canvas.default_height : (72 + 72 + ((lineCount * 80)));
                let canvasView_width  = this.canvas.default_width;
                switch(this.theme.selector) {
                    case '32d2a897602ef652ed8e15d66128aa74':
                        canvasView_height += 360;
                        break;

                    case '05326525f82b9a036e1bcb53a392ff7c':
                        canvasView_height += 580;
                        canvasView_width  += 349;
                        break;
                }

                this.canvas.is_center   = canvasView_center;
                this.canvas.view.width  = canvasView_width;
                this.canvas.view.height = canvasView_height;
                this.canvas.width       = canvasView_width;
                this.canvas.height      = canvasView_height;
            },
            drawingBackground() {
                this.canvas.ctx.fillStyle = this.canvas.background_color;
                this.canvas.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
            },
            drawingBackgroundImage() {
                let img = new Image();
                switch(this.theme.selector) {
                    case '05217b7d4741e38096a54eff4226c217':
                        img.src = '/img/frontend/cards/devotion-bg.png';
                        this.canvas.ctx.drawImage(img, 360, 64);
                        console.log(img);
                        return;

                    case '32d2a897602ef652ed8e15d66128aa74':
                        img.src = '/img/frontend/cards/qrcode.png';
                        this.canvas.ctx.drawImage(img, 24, this.canvas.height - 204);
                        return;

                    case '05326525f82b9a036e1bcb53a392ff7c':
                        img.src = '/img/frontend/cards/fragmented_background.png';
                        this.canvas.ctx.drawImage(img, 0, this.canvas.height - 560);
                        img.src = '/img/frontend/cards/fragmented_people.png';
                        this.canvas.ctx.drawImage(img, 36, this.canvas.height - 542);

                        this.canvas.ctx.lineJoin = 'round';
                        this.canvas.ctx.lineWidth = 8;
                        this.canvas.ctx.strokeRect(353, 40, this.canvas.width - 381, this.canvas.height - 282);

                        img.src = '/img/frontend/cards/fragmented_background_top_left.png';
                        this.canvas.ctx.drawImage(img, 349, 36);
                        img.src = '/img/frontend/cards/fragmented_background_top_right.png';
                        this.canvas.ctx.drawImage(img, this.canvas.width - 72, 36);
                        return;
                }
            },
            drawingLogo() {
                switch(this.theme.selector) {
                    case '32d2a897602ef652ed8e15d66128aa74':
                        this.canvas.ctx.font = '36px ' + this.canvas.font;
                        this.canvas.ctx.fillStyle = this.canvas.color;
                        this.canvas.ctx.fillText('若要深入了解，您稍候可以線上搜尋此:', 228, this.canvas.height - 160);
                        this.canvas.ctx.fillText('純靠北工程師 0xKAOBEI_ENGINEER', 228, this.canvas.height - 120);
                        this.canvas.ctx.fillText('請訪問 https://kaobei.engineer', 228, this.canvas.height - 40);
                        return;

                    case '05326525f82b9a036e1bcb53a392ff7c':
                        this.canvas.ctx.font = '72px ' + this.canvas.font;
                        this.canvas.ctx.fillStyle = this.canvas.color;
                        this.canvas.ctx.fillText('支離滅裂な', 360, this.canvas.height - 160);
                        this.canvas.ctx.fillText('思考・発言', 360, this.canvas.height - 80);
                        this.canvas.ctx.font = '36px ' + this.canvas.font;
                        this.canvas.ctx.fillStyle = this.canvas.color;
                        this.canvas.ctx.fillText('純靠北工程師', this.canvas.width - 232, this.canvas.height - 24);
                        return;

                    default:
                        this.canvas.ctx.font = '36px ' + this.canvas.font;
                        this.canvas.ctx.fillStyle = this.canvas.color;
                        this.canvas.ctx.fillText('純靠北工程師', this.canvas.width - 232, this.canvas.height - 24);
                        return;
                }
            },
            drawingUrl() {
                switch(this.theme.selector) {
                    case '32d2a897602ef652ed8e15d66128aa74':
                        this.canvas.ctx.font = '192px ' + this.canvas.font;
                        this.canvas.ctx.fillStyle = this.canvas.color;
                        this.canvas.ctx.fillText(':(', 48, 192);
                        return;

                    default:
                        this.canvas.ctx.font = '36px ' + this.canvas.font;
                        this.canvas.ctx.fillStyle = this.canvas.color;
                        this.canvas.ctx.fillText('發文傳送門 https://kaobei.engineer', 16, this.canvas.height - 24);
                        return;
                }
            },
            drawingContent() {
                let contentList = this.contentSplit();
                contentList.forEach(function(content_value, content_key) {
                    let x_point = 36;
                    let y_point = 0;
                    if (this.canvas.is_center) {
                        y_point = 24 + (this.canvas.is_center)? 440 + (((content_key - 1) * 80) - (contentList.length * 40)): ((content_key + 1) * 80);
                    } else {
                        y_point = 96 + (content_key * 80);
                    }

                    switch(this.theme.selector) {
                        case '32d2a897602ef652ed8e15d66128aa74':
                            y_point += 240;
                            break;
                    }

                    this.canvas.ctx.font = '63px ' + this.canvas.font;
                    this.canvas.ctx.fillStyle = this.canvas.color;
                    this.canvas.ctx.fillText(content_value, x_point, y_point);
                }.bind(this));
            },
            contentSplit() {
                let content = this.canvas.content;
                let response_list = [];
                let content_list = content.split(/\r\n|\r|\n/);
                content_list.forEach(function (content_value) {
                    let content_strlen = encodeURIComponent(content_value).replace(/%[A-F\d]{2}/g, 'U').length;
                    if (content_strlen <= 42) {
                        response_list.push(content_value);
                    } else {
                        let content_width = 0;
                        let char_string   = '';
                        let _content_value_list = content_value.split('');
                        _content_value_list.forEach(function (char_value, char_key) {
                            let char_strlen = encodeURIComponent(char_value).replace(/%[A-F\d]{2}/g, 'U').length;
                            content_width += (char_strlen == 3)? 1 : 0.5 ;

                            char_string += char_value;
                            if ((char_key + 1) in _content_value_list) {
                                let _next_char_strlen = encodeURIComponent(_content_value_list[char_key + 1]).replace(/%[A-F\d]{2}/g, 'U').length;
                                let _next_char_width = (_next_char_strlen == 3)? 1 : 0.5 ;

                                if ((content_width + _next_char_width) >= 14) {
                                    response_list.push(char_string);
                                    content_width = 0;
                                    char_string   = '';
                                }
                            }
                        });

                        if (char_string != '') {
                            response_list.push(char_string);
                        }
                    }
                });

                return response_list;
            },
        },
    }
</script>
