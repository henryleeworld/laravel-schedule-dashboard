# Laravel 11 任務排程儀表板

引入 studio 的 laravel-totem 套件來擴增儀表板管理任務排程，根據個人的喜好安排 Laravel 指令列指令，可以快速啟用/關閉任務排程，而無需再次返回代碼。

## 使用方式
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產生 Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 執行 __Artisan__ 指令的 __migrate__ 來執行所有未完成的遷移。
```sh
$ php artisan migrate
```
- 啟動排程器，僅需要在伺服器上增加一條 Cron 項目即可。
```sh
* * * * * cd /{專案路徑} && php artisan schedule:run >> /dev/null 2>&1
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 你可以經由 `/totem` 來進行瀏覽任務排程儀表板。

----

## 畫面截圖
![](https://i.imgur.com/8bkT9Gm.png)
> 預設情況下，任務排程儀表板只能在本地環境中使用
