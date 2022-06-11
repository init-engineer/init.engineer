<p align="center"><a href="https://init.engineer" target="_blank"><img src="https://raw.githubusercontent.com/init-engineer/init.engineer/master/public/img/frontend/background/cute-banner.jpg" style="border-radius: 4px;"></a></p>
<p align="center">
<a href="https://github.com/init-engineer/init.engineer/actions"><img src="https://img.shields.io/github/checks-status/init-engineer/init.engineer/master?style=for-the-badge" alt="Check Status" /></a>
<a href="https://github.com/init-engineer/init.engineer/blob/master/LICENSE"><img src="https://img.shields.io/github/license/init-engineer/init.engineer?style=for-the-badge" alt="License" /></a>
<a href="https://discord.gg/tPhnrs2"><img src="https://img.shields.io/discord/508513350964084736?color=5865F2&label=DISCORD&style=for-the-badge" alt="Discord" /></a>
</p>

## 關於[純靠北工程師](https://init.engineer)開源專案
這是一份純靠北工程師的開源專案，基本上我們的官方網站的應用服務就是直接由本專案所構建出來的，也是專門為純靠北工程師量身打造的專案，這個專案開源的意義在於我自己忙不過來，有時候系統運作與想像中的不符，如果大家能幫忙除錯、修正那就好了，於是就開源出來了。

## 常見問題
### Q: 我可以把這份專案下載下來，建立一個「靠北XX」網站嗎？
如同上面所說的，這份專案是為了[純靠北工程師](https://init.engineer)而量身打造的開源專案，因此不建議使用本專案來建立一個網頁應用服務，我們反而是推薦另一套由我們所建立的開源專案叫做「[哈啦狐 Forumfox](https://github.com/forumfox/forumfox)」，這將會是面向大眾、更適合作為投稿管理、提供匿名投稿的網頁應用系統。

### Q: 任務排程我該怎麼讓它依照優先順序來跑？
我們構思已久，將 `onQueue` 等級切分為「`highest`、`high`、`medium`、`low`、`lowest`」五個等級劃分，然後下 `worker` 的時候記得在最後補上 `default` 啊！不然沒有放 `onQuene` 的任務它是不會做事的，指令範例：`php artisan queue:work --queue=highest,high,medium,low,lowest,default`
| 等級    | 名稱 | 使用範圍           |
|---------|------|--------------------|
| highest | 最高 | 文章發表至社群平台 |
| high    | 高   | (暫無)             |
| medium  | 標準 | 社群文章更新留言   |
| low     | 低   | (暫無)             |
| lowest  | 次低 | 抓取社群平台留言   |
