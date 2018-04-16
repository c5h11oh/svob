Svenska Ordbok
軟體介紹與目的：基於Bradversy's PHP MVC框架(1)程式，建立一個可紀錄學習過得瑞典語單字，變成一個單字本。目前功能僅規劃至能搜尋、新增、編輯、刪除、顯示單字和意思，未來計畫要有標籤（tag），能依據標籤顯示相關的單字清單，並且套用CSS、Bootstrap進行前端網頁設計。
環境：Apache+PHP+MySQL
初始設定：
    修改/public/.htaccess第4行，RewriteBase <網域後的根目錄路徑>/public
    修改/app/config/config.php
        DB_HOST: SQL資料庫主機位址（預設為localhost）
        DB_USER: SQL資料庫帳號
        DB_PASS: SQL資料庫密碼
        DB_NAME: SQL資料庫資料表（預設為sv）
        URLROOT: 包含網域的根目錄路徑
框架說明：
    無論輸入什麼網址，都會導向/public/index.php
        呼叫/app/bootstrap.php
            載入/app/config/config.php設定
            載入/app/helpers/* 小工具
            載入/app/libraries/* Library檔案（Controller, Core, Database）
    建立Core物件（Instantiate）
        解析網址，得到需要的controller（預設為pages）、函式function（預設為index）和parameters（可選，預設為空）
        建立controller物件，呼叫function(parameters)
            執行controller的建構（construct）函式
            執行controller的被呼叫函式
                呼叫model存取資料庫
                呼叫view
                    view頁面顯示

(1)Bradversy's PHP MVC框架：由Udemy課程（https://www.udemy.com/object-oriented-php-mvc/）自學製作的PHP MVC框架（https://cloud.chwen.im/index.php/s/otsmuWX2nBz5zzd）