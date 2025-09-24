/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');
require('../plugins');

import Vue from 'vue';
import 'livewire-vue';

window.Vue = Vue;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

/**
 * Typed.js at:
 * https://github.com/mattboldt/typed.js/
 */
import Typed from 'typed.js';
window.Typed = Typed;

new Typed('#typed', {
    /**
     * @property {array} strings strings to be typed
     * @property {string} stringsElement ID of element containing string children
     */
    strings: [
        'init-engineer-cli create post "光復香港，時代革命"',
        'init-engineer-cli create post "習近平小熊維尼"',
    ],
    stringsElement: null,

    /**
     * @property {number} typeSpeed type speed in milliseconds
     */
    typeSpeed: 60,

    /**
     * @property {number} backSpeed backspacing speed in milliseconds
     */
    backSpeed: 40,

    /**
     * @property {boolean} smartBackspace only backspace what doesn't match the previous string
     */
    smartBackspace: true,

    /**
     * @property {boolean} loop loop strings
     * @property {number} loopCount amount of loops
     */
    loop: true,
    loopCount: Infinity,
});

/**
 * 全域版權宣告函數
 * 可在任何地方呼叫 showCopyrightModal()
 */
window.showCopyrightModal = function() {
    Swal.fire({
        title: "純靠北工程師 版權宣告",
        icon: "info",
        html: `
<div class="container text-left p-0">
    <p><strong>最後更新日期：2025年9月25日</strong></p>
    <hr>
    <p><strong>【重要條款更新通知】</strong></p>
    <p><strong>本次宣告更新包含溯及既往條款。自
            2025年10月1日起，所有內容將適用最新的「專屬授權」條款。針對在此之前發布的內容，原投稿人若不同意新條款，可「隨時」聯繫本網站管理員申請下架。詳情請見第六條。</strong></p>
    <hr>
    <p>歡迎使用純靠北工程師（以下簡稱「本網站」）。提交任何內容至本網站前，請詳細閱讀本版權宣告。一旦提交，即代表您已同意並接受所有條款。</p>
    <h4><strong>第一條：網站程式碼與設計</strong></h4>
    <p>本網站之軟體、原始程式碼、網站架構與網頁設計，係依據 <a href="https://github.com/init-engineer/init.engineer/blob/main/LICENSE">MIT
            License</a>開源授權。此授權範圍<strong>不包含</strong>本網站之商標（如「純靠北工程師」名稱與標誌），亦<strong>不包含</strong>任何使用者投稿內容。</p>
    <h4><strong>第二條：使用者投稿內容之專屬授權</strong></h4>
    <ol>
        <li><strong>著作權歸屬</strong>：您所投稿原創內容之著作權，仍歸屬於您本人。</li>
        <li><strong>專屬授權（Exclusive License）</strong>：您一旦投稿，即同意授予本網站一份<strong>「專屬、無償、永久、不可撤銷且可轉授權」</strong>的權利。此授權包含：
            <ul>
                <li><strong>獨家權利</strong>：僅有本網站能在全球範圍內，公開使用、散布、展示您的投稿內容。</li>
                <li><strong>您的義務</strong>：作為專屬授權的對價，您不得再將「同一份」投稿內容，發布於任何其他公開平台，包含但不限於您的個人社群媒體或部落格。</li>
                <li><strong>永久性</strong>：此授權為永久有效，無法撤銷。</li>
                <li><strong>無償性</strong>：本網站使用您的內容不支付任何費用。</li>
                <li><strong>可轉授權</strong>：本網站可將上述權利轉授權予第三方。</li>
            </ul>
        </li>
        <li><strong>內容保證</strong>：您保證投稿內容為原創，且未侵害任何第三方權利。若引發法律糾紛，將由您個人承擔全部責任。</li>
    </ol>
    <h4><strong>第三條：內容使用與分享</strong></h4>
    <ol>
        <li><strong>允許的分享</strong>：內容可透過本網站的「分享」功能或頁面網址進行分享。所有分享皆須清楚標示來源為「純靠北工程師」。</li>
        <li><strong>禁止的行為</strong>：除前項允許的分享方式外，嚴格禁止任何人（包含原投稿人）以複製、截圖、下載等方式，重製或轉載本網站的任何內容。</li>
    </ol>
    <h4><strong>第四條：本網站之權利與責任</strong></h4>
    <ol>
        <li><strong>侵權維護</strong>：基於此專屬授權，當第三方盜用或抄襲投稿內容時，本網站有權以自身名義採取警告、訴訟等法律行動。</li>
        <li><strong>免責聲明</strong>：本網站為匿名平台，無法審核內容之真實性與合法性。所有內容僅代表投稿人立場，與本網站無關。</li>
        <li><strong>侵權通知</strong>：若您認為網站上有內容侵害您的著作權，請與我們聯繫，我們將依法處理。</li>
    </ol>
    <h4><strong>第五條：法律責任與條款修改</strong></h4>
    <p>任何違反本宣告之行為，均屬侵權或違約，本網站將保留法律追訴權，並要求賠償所有損失（含律師費與訴訟費用）。本網站有權隨時修改本宣告，修改後將直接公布於網站，不另行通知。建議您定期查看最新條款。</p>
    <h4><strong>第六條：條款溯及既往與權利區分</strong></h4>
    <ol>
        <li><strong>效力溯及</strong>：本版權宣告（特別是第二條之專屬授權），將溯及既往適用於所有曾發布於本網站的內容。</li>
        <li><strong>新舊文章之權利區分</strong>：
            <ul>
                <li><strong>關於 2025年10月1日
                        前發布之內容</strong>：若您是此日期前發布內容的原投稿人且不同意本宣告之專屬授權條款，您<strong>隨時</strong>有權聯繫本網站管理員，在提供適當證明後申請下架您的投稿。在您申請下架前，該內容將依本宣告條款進行管理。
                </li>
                <li><strong>關於 2025年10月1日 (含當日) 起發布之內容</strong>：所有在此日期後送出的投稿，一經發布即代表投稿人已閱讀、理解並同意本宣告的所有條款，此專屬授權為永久且不可撤銷。
                </li>
            </ul>
        </li>
    </ol>
</div>`,
        focusConfirm: false,
        width: '800px',
        customClass: {
            popup: 'copyright-modal'
        }
    });
};
