<p align="center">
	<a href="https://kaobei.engineer"><img src="https://i.imgur.com/iuP8yS0.png" alt="INIT.ENGINEER" width="300"></a>
</p>
<h3 align="center">喜歡純靠北工程師？我們也是。</h3>
<p align="center">這是一份純靠北工程師的專案，請好好愛護它，謝謝。</p>
<p align="center">
    <a href="https://www.facebook.com/init.kobeengineer" title="facebook init"><img src="https://img.shields.io/badge/facebook-@init.kobeengineer-3b5998.svg" alt="facebook init" /></a>
    <a href="https://www.facebook.com/kaobei.engineer" title="facebook testing"><img src="https://img.shields.io/badge/facebook-@kaobei.engineer-3b5998.svg" alt="facebook testing" /></a>
    <a href="https://twitter.com/kaobei_engineer" title="twitter"><img src="https://img.shields.io/badge/twitter-@kaobei_engineer-55acee.svg" alt="twitter" /></a>
    <a href="https://www.plurk.com/kaobei_engineer" title="plurk"><img src="https://img.shields.io/badge/plurk-@kaobei_engineer-ff574d.svg" alt="plurk" /></a>
</p>

---

![預覽圖](https://i.imgur.com/H1cy0Ei.png)

---
## 簡介

哈囉大家好，我是誰並不重要，重要的是你知道純靠北工程師 `v3.0` 計畫嗎？不知道沒關係，因為那本來就是只有我跟我自己討論出來的東西，不過現在我想把喜悅分享給大家。

[GitHub - Kantai235/init.engineer: 這是一份純靠北工程師的專案，請好好愛護它，謝謝。](https://github.com/Kantai235/init.engineer)

這是一項純靠北工程師 `v3.0` 的專案，原本計畫寫完再開源出來，但還沒寫完就在那邊公開了，有夠自肥自大的。

身為閱讀者的你，也是可以一起享受這份喜悅這份快樂的，你只要依照 `README.md` 的[安裝](https://github.com/Kantai235/init.engineer#安裝)步驟，基本上應該可以把這網站架起來，如果沒意外的話啦，然後看看首頁乾乾過癮。

或者是你也可以參與這項專案，來教我寫程式，我不會寫程式，嗚嗚嗚。

另外你可能會覺得這專案怎麼那麼空？就跟 ... 不比喻了，等等被出征，這我就要來說說 `軟體版本號` 這種東西了。

> **軟體版本編號訂定**是指為 [軟體](https://zh.wikipedia.org/wiki/%E8%BB%9F%E4%BB%B6) 設定 [版本](https://zh.wikipedia.org/wiki/%E7%89%88%E6%9C%AC) 號碼的方式。通常，版本號碼會以數字訂定，但亦有不同的方式。

對我來說，我的版號是 `第幾次砍掉重寫.第幾次大改版.第幾次小改版` 這樣編的，舉例來說這次 `v3.0` 意味著這次是第 3 次砍掉重寫，什麼？你說這跟你的認知不同？沒關係，你現在懂了，You 們都懂就 You 不懂。

---
## 安裝

1. 您需要先設定 `env` 設定檔，基本上你在整個專案找不到 `.env` 這個檔案，你只會看到 `.env.example` 這個檔案，沒錯，看到 `.example` 就知道這檔案是個範例，你可以複製一個改名為 `.env` 即可，然後開始要修改裡面的參數，哪些必填哪些選填，範例檔案內會有詳細解釋。

2. 您可能需要安裝 `composer` 才能啟用整個網站。
    ```sh
    composer install
    ```

3. 您可能需要安裝 `npm` 才能啟用前端的東西。
    ```sh
    npm install
    ```

4. 你需要產生 `Laravel` 在加密時會需要使用到的密鑰，這點在 `.env.example` 當中有提到。
    ```sh
    php artisan key:generate
    ```

5. 因為會需要使用到資料庫，所以你就去裝一裝你順眼的資料庫，然後去 `env` 設定一下參數吧，如果還沒設定的記得去設定，然後再做資料庫遷移。
    ```sh
    php artisan migrate --seed
    ```

6. 最後你需要把 `storage` 與 `public` 製作個連結，這樣部分檔案才能正常讀取，例如使用者的大頭貼。
    ```
    php artisan storage:link
    ```

7. 好了，你可以使用你熟悉的伺服器軟體，例如說 `Apache`，但不要使用 `Apache`，不然你會在 `SITCON` 被嗆爆，建議使用 `php artisan serve`，或者使用 `nginx` 也可以，就可以正常打開網站了。
    ```text
    管理員預設帳號: admin@admin.com
    管理員預設密碼: secret
    ```

8. 如果這樣子你還是架設不起來，那你可以參考其他篇教學文章。
    - [Laravel Boilerplate | Quick Start](http://laravel-boilerplate.com/6.0/start.html)
    - [如何建置這個平臺？ · Kantai235/kaobei.opendata Wiki · GitHub](https://github.com/Kantai235/kaobei.opendata/wiki/%E5%A6%82%E4%BD%95%E5%BB%BA%E7%BD%AE%E9%80%99%E5%80%8B%E5%B9%B3%E8%87%BA%EF%BC%9F)

---
## 總結

Have fun :)
