<?php

namespace App\Domains\Social\Services\Image;

use App\Domains\Social\Models\Ads;
use App\Domains\Social\Services\AdsService;
use Illuminate\Support\Str;

/**
 * Class ImagesGenerator.
 *
 * @extends ImagesContract
 */
class ImagesGenerator extends ImagesContract
{
    /**
     * ImagesGenerator constructor.
     *
     * @param AdsService $adsService
     */
    public function __construct(AdsService $adsService)
    {
        /**
         * 先建立一個空白畫布
         */
        $this->canvasView = imageCreateTrueColor(
            $this->canvasViewWidth,
            $this->canvasViewHeight
        );

        $this->adsService = $adsService;
    }

    /**
     * 設定文字內容
     *
     * @param string $content
     *
     * @return ImagesGenerator
     */
    public function content(string $content): ImagesGenerator
    {
        $this->content = $content;

        return $this;
    }

    /**
     * 設定主題
     *
     * @param string $theme
     *
     * @return ImagesGenerator
     */
    public function theme(string $theme): ImagesGenerator
    {
        /**
         * 先設定主題
         */
        $this->theme = $theme;

        /**
         * 根據主題賦予文字顏色、背景顏色
         */
        switch ($this->theme) {
            /** 黑底綠字 */
            case 'black-green':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 0, 255, 59);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 0, 0, 0);
                break;

            /** 黑底黃字 */
            case 'black-yellow':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 235, 212, 67);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 0, 0, 0);
                break;

            /** 黑底白字 */
            case 'black-white':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 0, 0, 0);
                break;

            /** 黑底紅字 */
            case 'black-red':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 220, 53, 69);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 0, 0, 0);
                break;

            /** 甜甜香草巧克力熊貓 */
            case 'sweet-panda':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 232, 62, 140);
                break;

            /** 藍白屏 */
            case 'blue-white':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 0, 123, 255);
                break;

            /** PostgreSQL */
            case 'white-blue':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 0, 123, 255);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                break;

            /** Laravel */
            case 'laravel':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 244, 100, 95);
                break;

            /** 軟體綠 */
            case 'soft-green':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 52, 58, 64);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 57, 197, 187);
                break;

            /** 皮卡丘 */
            case 'grey-pikachu':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 255, 213, 71);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 47, 52, 55);
                break;

            /** 伊布 */
            case 'grey-eevee':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 231, 175, 86);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 47, 52, 55);
                break;

            /** 反向 皮卡丘 */
            case 'pikachu-grey':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 47, 52, 55);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 255, 213, 71);
                break;

            /** 反向 伊布 */
            case 'eevee-grey':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 47, 52, 55);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 231, 175, 86);
                break;

            /** 新年限定主題 */
            case 'chinese-new-year':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 216, 176, 106);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 166, 23, 35);
                break;

            /** 反向 新年限定主題 */
            case 'reverse-chinese-new-year':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 166, 23, 35);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 216, 176, 106);
                break;

            /** 恭迎慈孤觀音 渡世靈顯四方 */
            case 'devotion':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 0, 0, 0);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 241, 21, 65);
                break;

            /** Windows 最棒的畫面 */
            case 'windows-10-error':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 0, 123, 208);
                break;

            /** Windows 最棒的畫面 測試人員組件 */
            case 'windows-10-error-testing':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 16, 124, 16);
                break;

            /** 粉紅色 */
            case 'pink':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 255, 83, 118);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 248, 192, 200);
                break;

            /** 支離滅裂な思考・発言 */
            case 'broken-think':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 0, 0, 0);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                break;

            /** 不獣控制な思考・発言 */
            case 'furry-broken-think':
                $this->themeTextColor = imageColorAllocate($this->canvasView, 0, 0, 0);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 248, 249, 250);
                break;

            /** 預設 黑底綠字 */
            default:
                $this->themeTextColor = imageColorAllocate($this->canvasView, 0, 255, 59);
                $this->themeBackgroundColor = imageColorAllocate($this->canvasView, 0, 0, 0);
                break;
        }

        return $this;
    }

    /**
     * 設定字型
     *
     * @param string $font
     *
     * @return ImagesGenerator
     */
    public function font(string $font): ImagesGenerator
    {
        /**
         * 先設定字型
         */
        $this->font = $font;

        /**
         * 根據字型載入指定的字型檔
         */
        switch ($this->font) {
            /** AURAKA 點陣宋字型 */
            case 'auraka':
                $this->fontPath = public_path('fonts/Auraka.ttf');
                break;

            /** 國喬點陣字型 */
            case 'kc24m':
                $this->fontPath = public_path('fonts/kc24m.ttf');
                break;

            /** 微軟正黑體 */
            case 'microsoft-jheng-hei':
                $this->fontPath = public_path('fonts/microsoft_jheng_hei.ttf');
                break;

            /** 新細明體 */
            case 'mingliu':
                $this->fontPath = public_path('fonts/PMingLiU-02.ttf');
                break;

            /** 標楷體 */
            case 'kaiu':
                $this->fontPath = public_path('fonts/kaiu.ttf');
                break;

            /** 極粗明朝體 */
            case 'fot-matissepro-eb':
                $this->fontPath = public_path('fonts/FOT-MatissePro-EB.otf');
                break;

            /** 台北黑體 */
            case 'taipei-sans-tc-beta-bold':
                $this->fontPath = public_path('fonts/TaipeiSansTCBeta-Bold.ttf');
                break;

            /** 俐方體 11 號 */
            case 'cubic-11':
                $this->fontPath = public_path('fonts/Cubic_11_1.010_R.ttf');
                break;

            /** 粉圓體 */
            case 'huninn':
                $this->fontPath = public_path('fonts/jf-openhuninn-1.1.ttf');
                break;

            /** 未來熒黑 */
            case 'glow-sans':
                $this->fontPath = public_path('fonts/GlowSansTC-Normal-Medium.ttf');
                break;

            /** 預設: AURAKA 點陣宋字型 */
            default:
                $this->fontPath = public_path('fonts/Auraka.ttf');
                break;
        }

        return $this;
    }

    /**
     * 建立圖片並回傳結果
     *
     * @return array
     */
    public function build(): array
    {
        /**
         * 判斷最重要的內容、主題、字型是否已經賦予
         */
        if (
            !isset($this->content) ||
            !isset($this->theme) ||
            !isset($this->font)
        ) {
            return [
                'result' => false,
            ];
        }

        /**
         * 隨機抽選廣告
         */
        $this->ads = $this->adsService->random();

        /**
         * 繪製畫布內容
         */
        $this->settingCanvasViewSize();
        $this->drawingTheme();
        $this->drawingThemeImages();
        $this->drawingLogo();
        $this->drawingUrl();
        $this->drawingContent();

        /**
         * 如果有抽選到廣告，最後再繪製廣告
         */
        if ($this->ads['result']) {
            $this->drawingAds();
        }

        /**
         * 執行輸出圖片的一個動作。
         */
        ob_start();
        $picturePath  = isset($data['picturePath']) ? $data['picturePath'] : 'cards/images';
        $pictureName  = isset($data['pictureName']) ? $data['pictureName'] : Str::random(128);
        $pictureType  = isset($data['pictureType']) ? $data['pictureType'] : 'jpeg';
        $storagePath = storage_path(sprintf('app/public/%s/%s.%s', $picturePath, $pictureName, $pictureType));
        switch ($pictureType) {
            /**
             * 輸出成 GIF 檔案
             */
            case 'gif':
                imageGIF($this->canvasView, $storagePath);
                break;

            /**
             * 輸出成 PNG 檔案
             */
            case 'png':
                imagePNG($this->canvasView, $storagePath);
                break;

            /**
             * 輸出成 JPEG 檔案
             */
            case 'jpeg':
                imageJPEG($this->canvasView, $storagePath);
                break;

            /**
             * 預設輸出成 JPEG 檔案
             */
            default:
                imageJPEG($this->canvasView, $storagePath);
                break;
        }
        $imageOutput = base64_encode(ob_get_clean());
        imagedestroy($this->canvasView);

        /**
         * 整理結果資訊
         */
        return [
            'result' => true,
            'picture' => "storage/cards/images/$pictureName.jpeg",
            'ads' => $this->ads,
        ];
    }

    /**
     * 設定畫布的寬度(width)、高度(height)
     *
     * @return void
     */
    private function settingCanvasViewSize(): void
    {
        /**
         * 判斷文章是否垂直置中，假設每行佔 ${default.line.height} 的高度，文章內容小於 600px 則會垂直置中對齊
         * 計算出 Canvas 的寬度(width)、高度(height)
         * 如果文章沒有很長，那就給予預設高度 ${default.canvas.height}
         * 如果文章過長，就根據其他元件的高度 + (每行 * ${default.line.height})
         */
        $content = $this->contentSplit($this->content);
        $this->canvasCenter = ((count($content) * 80) < 600) ? true : false;
        $this->canvasViewHeight = $this->canvasCenter ? 720 : (72 + 72 + ((count($content) * 80)));

        /**
         * 如果是選擇特殊樣式，會有其它裝飾元素，必須再額外給予更多的寬度(width)、高度(height)
         */
        switch ($this->theme) {
                // 主題: Windows 10 錯誤畫面
            case 'windows-10-error':
                $this->canvasViewHeight += 360;
                break;
                // 主題: Windows 10 測試人員計畫 錯誤畫面
            case 'windows-10-error-testing':
                $this->canvasViewHeight += 360;
                break;
                // 主題: 支離滅裂な思考・発言
            case 'broken-think':
                $this->canvasViewHeight += 140;
                $this->canvasViewWidth += 349;
                break;
                // 主題: 不獣控制な思考・発言
            case 'furry-broken-think':
                $this->canvasViewHeight += 140;
                $this->canvasViewWidth += 349;
                break;
        }

        /**
         * 如果有抽中廣告，那需要幫畫布增加高度來放置廣告
         */
        if ($this->ads['result']) {
            $this->canvasViewHeight += 240;
        }

        /**
         * 建立畫布
         */
        $this->canvasView = imageCreateTrueColor(
            $this->canvasViewWidth,
            $this->canvasViewHeight
        );
    }

    /**
     * 根據主題(theme)繪製背景顏色、文字顏色
     *
     * @return bool
     */
    private function drawingTheme(): bool
    {
        /**
         * 將畫布繪製背景顏色
         */
        return imageFill($this->canvasView, 0, 0, $this->themeBackgroundColor);
    }

    /**
     * 根據主題(theme)繪製主題所使用到的貼圖
     *
     * @return void
     */
    private function drawingThemeImages(): void
    {
        switch ($this->theme) {
            /** 主題: 慈孤觀音 */
            case 'devotion':
                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/devotion-bg.png'));
                imageCopy($this->canvasView, $overlayImage, 360, 64, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                return;

            /** 主題: Windows 10 錯誤畫面 */
            case 'windows-10-error':
                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/qrcode.png'));
                $yPoint = ($this->ads['result'] === false) ? imageSY($this->canvasView) - 204 : imageSY($this->canvasView) - 444;
                imageCopy($this->canvasView, $overlayImage, 24, $yPoint, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                return;

            /** 主題: Windows 10 測試人員計畫 錯誤畫面 */
            case 'windows-10-error-testing':
                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/qrcode.png'));
                $yPoint = ($this->ads['result'] === false) ? imageSY($this->canvasView) - 204 : imageSY($this->canvasView) - 444;
                imageCopy($this->canvasView, $overlayImage, 24, $yPoint, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                return;

            /** 主題: 支離滅裂な思考・発言 */
            case 'broken-think':
                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/fragmented_background.png'));
                $yPoint = ($this->ads['result'] === false) ? imageSY($this->canvasView) - 560 : imageSY($this->canvasView) - 800;
                imageCopy($this->canvasView, $overlayImage, 0, $yPoint, 0, 0, imageSX($overlayImage), imageSY($overlayImage));

                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/fragmented_people.png'));
                $yPoint = ($this->ads['result'] === false) ? imageSY($this->canvasView) - 542 : imageSY($this->canvasView) - 782;
                imageCopy($this->canvasView, $overlayImage, 36, $yPoint, 0, 0, imageSX($overlayImage), imageSY($overlayImage));

                $square_width = $this->canvasViewWidth - 375;
                $square_height = $this->canvasViewHeight - 250;
                $square_height = ($this->ads['result'] === false) ? $square_height : $square_height - 240;
                $newimg = imageCreateTrueColor($square_width, $square_height);
                $border = imageColorAllocate($newimg, 0, 0, 0);
                $fill = imageColorAllocate($newimg, 255, 255, 255);
                imageFilledRectAngle($newimg, 0, 0, $square_width, $square_height, $fill);
                imageSetThickness($newimg, 6);
                imageRectAngle($newimg, 6, 6, $square_width - 6, $square_height - 6, $border);

                $top = (72 - $this->canvasViewHeight * 0.05 > 0) ? 72 - $this->canvasViewHeight * 0.05 : 20;
                imageCopy($this->canvasView, $newimg, 350, $top, 0, 0, $square_width, $square_height);

                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/fragmented_background_arrow.png'));
                $yPoint = ($this->ads['result'] === false) ? imageSY($this->canvasView) - 372 : imageSY($this->canvasView) - 612;
                imageCopy($this->canvasView, $overlayImage, 315, $yPoint, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                return;

            /** 主題: 不獣控制な思考・発言 */
            case 'furry-broken-think':
                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/fragmented_background.png'));
                $yPoint = ($this->ads['result'] === false) ? imageSY($this->canvasView) - 560 : imageSY($this->canvasView) - 800;
                imageCopy($this->canvasView, $overlayImage, 0, $yPoint, 0, 0, imageSX($overlayImage), imageSY($overlayImage));

                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/fragmented_wolf.png'));
                $yPoint = ($this->ads['result'] === false) ? imageSY($this->canvasView) - 502 : imageSY($this->canvasView) - 742;
                imageCopy($this->canvasView, $overlayImage, 12, $yPoint, 0, 0, imageSX($overlayImage), imageSY($overlayImage));

                $square_width = $this->canvasViewWidth - 375;
                $square_height = $this->canvasViewHeight - 250;
                $square_height = ($this->ads['result'] === false) ? $square_height : $square_height - 240;
                $newimg = imageCreateTrueColor($square_width, $square_height);
                $border = imageColorAllocate($newimg, 0, 0, 0);
                $fill = imageColorAllocate($newimg, 255, 255, 255);
                imageFilledRectAngle($newimg, 0, 0, $square_width, $square_height, $fill);
                imageSetThickness($newimg, 6);
                imageRectAngle($newimg, 6, 6, $square_width - 6, $square_height - 6, $border);

                $top = (72 - $this->canvasViewHeight * 0.05 > 0) ? 72 - $this->canvasViewHeight * 0.05 : 20;
                imageCopy($this->canvasView, $newimg, 350, $top, 0, 0, $square_width, $square_height);

                $overlayImage = imageCreateFromPng(public_path('img/frontend/cards/fragmented_background_arrow.png'));
                $yPoint = ($this->ads['result'] === false) ? imageSY($this->canvasView) - 372 : imageSY($this->canvasView) - 612;
                imageCopy($this->canvasView, $overlayImage, 315, $yPoint, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                return;
        }
    }

    /**
     * 繪製應用程式名稱
     *
     * @return void
     */
    private function drawingLogo(): void
    {
        switch ($this->theme) {
            /** 主題: Windows 10 錯誤畫面 */
            case 'windows-10-error':
                imageTTFtext($this->canvasView, 26, $this->canvasAngle, 228, ($this->ads['result']) ? $this->canvasViewHeight - 400 : $this->canvasViewHeight - 160, $this->themeTextColor, $this->fontPath, '若要深入了解，您稍候可以線上搜尋此:');
                imageTTFtext($this->canvasView, 26, $this->canvasAngle, 228, ($this->ads['result']) ? $this->canvasViewHeight - 360 : $this->canvasViewHeight - 120, $this->themeTextColor, $this->fontPath, sprintf('%s 0xINIT_ENGINEER', appName()));
                imageTTFtext($this->canvasView, 26, $this->canvasAngle, 228, ($this->ads['result']) ? $this->canvasViewHeight - 280 : $this->canvasViewHeight -  40, $this->themeTextColor, $this->fontPath, sprintf('請訪問 %s', appUrl()));
                return;

            /** 主題: Windows 10 測試人員計畫 錯誤畫面 */
            case 'windows-10-error-testing':
                imageTTFtext($this->canvasView, 26, $this->canvasAngle, 228, ($this->ads['result']) ? $this->canvasViewHeight - 400 : $this->canvasViewHeight - 160, $this->themeTextColor, $this->fontPath, '若要深入了解，您稍候可以線上搜尋此:');
                imageTTFtext($this->canvasView, 26, $this->canvasAngle, 228, ($this->ads['result']) ? $this->canvasViewHeight - 360 : $this->canvasViewHeight - 120, $this->themeTextColor, $this->fontPath, sprintf('%s 0xINIT_ENGINEER', appName()));
                imageTTFtext($this->canvasView, 26, $this->canvasAngle, 228, ($this->ads['result']) ? $this->canvasViewHeight - 280 : $this->canvasViewHeight -  40, $this->themeTextColor, $this->fontPath, sprintf('請訪問 %s', appUrl()));
                return;

            /** 主題: 支離滅裂な思考・発言 */
            case 'broken-think':
                $fontSize   = $this->fontSize / 2;
                $fontWidth  = imageFontWidth($fontSize) * strlen(appName());
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $this->canvasViewWidth - ($fontWidth * 1.2) - $fontSize;
                $yPoint     = $this->canvasViewHeight - $fontHeight - $fontSize;
                $yPoint     = ($this->ads['result']) ? $yPoint - 240 : $yPoint;
                $content    = mb_convert_encoding(appName(), 'UTF-8', 'auto');
                imageTTFtext($this->canvasView, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $content);

                $fontSize   = $this->fontSize;
                $fontWidth  = imageFontWidth($fontSize) * strlen('支離滅裂な');
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = 360;
                $yPoint     = $this->canvasViewHeight - 160;
                $yPoint     = ($this->ads['result']) ? $yPoint - 240 : $yPoint;
                $content    = mb_convert_encoding('支離滅裂な', 'UTF-8', 'auto');
                imageTTFtext($this->canvasView, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $content);

                $fontSize   = $this->fontSize;
                $fontWidth  = imageFontWidth($fontSize) * strlen('思考・発言');
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = 360;
                $yPoint     = $this->canvasViewHeight - 80;
                $yPoint     = ($this->ads['result']) ? $yPoint - 240 : $yPoint;
                $content    = mb_convert_encoding('思考・発言', 'UTF-8', 'auto');
                imageTTFtext($this->canvasView, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $content);
                return;

            /** 主題: 不獣控制な思考・発言 */
            case 'furry-broken-think':
                $fontSize   = $this->fontSize / 2;
                $fontWidth  = imageFontWidth($fontSize) * strlen(appName());
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $this->canvasViewWidth - ($fontWidth * 1.2) - $fontSize;
                $yPoint     = $this->canvasViewHeight - $fontHeight - $fontSize;
                $yPoint     = ($this->ads['result']) ? $yPoint - 240 : $yPoint;
                $content    = mb_convert_encoding(appName(), 'UTF-8', 'auto');
                imageTTFtext($this->canvasView, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $content);

                $fontSize   = $this->fontSize;
                $fontWidth  = imageFontWidth($fontSize) * strlen('不獣控制な');
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = 360;
                $yPoint     = $this->canvasViewHeight - 160;
                $yPoint     = ($this->ads['result']) ? $yPoint - 240 : $yPoint;
                $content    = mb_convert_encoding('不獣控制な', 'UTF-8', 'auto');
                imageTTFtext($this->canvasView, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $content);

                $fontSize   = $this->fontSize;
                $fontWidth  = imageFontWidth($fontSize) * strlen('思考・発言');
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = 360;
                $yPoint     = $this->canvasViewHeight - 80;
                $yPoint     = ($this->ads['result']) ? $yPoint - 240 : $yPoint;
                $content    = mb_convert_encoding('思考・発言', 'UTF-8', 'auto');
                imageTTFtext($this->canvasView, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $content);
                return;

            /** 預設在右下角貼上應用程式名稱 */
            default:
                $fontSize   = $this->fontSize / 2;
                $fontWidth  = imageFontWidth($fontSize) * strlen(appName());
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $this->canvasViewWidth - ($fontWidth * 1.2) - $fontSize;
                $yPoint     = $this->canvasViewHeight - $fontHeight - $fontSize;
                $yPoint     = ($this->ads['result']) ? $yPoint - 240 : $yPoint;
                $content    = mb_convert_encoding(appName(), 'UTF-8', 'auto');
                imageTTFtext($this->canvasView, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $content);
                return;
        }
    }

    /**
     * 繪製發表文章傳送門。
     *
     * @return void
     */
    private function drawingUrl(): void
    {
        switch ($this->theme) {
            /** 主題: Windows 10 錯誤畫面 */
            case 'windows-10-error':
                imageTTFtext($this->canvasView, 160, $this->canvasAngle, 48, 192, $this->themeTextColor, $this->fontPath, ':(');
                return;

            /** 主題: Windows 10 測試人員計畫 錯誤畫面 */
            case 'windows-10-error-testing':
                imageTTFtext($this->canvasView, 160, $this->canvasAngle, 48, 192, $this->themeTextColor, $this->fontPath, ':(');
                return;

            /** 預設在左下角貼上發文傳送門 */
            default:
                $fontSize   = $this->fontSize / 2;
                $fontWidth  = imageFontWidth($fontSize) * strlen(sprintf('發文傳送門 %s', appUrl()));
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $fontSize;
                $yPoint     = $this->canvasViewHeight - $fontHeight - $fontSize;
                $yPoint     = ($this->ads['result']) ? $yPoint - 240 : $yPoint;
                $content    = mb_convert_encoding(sprintf('發文傳送門 %s', appUrl()), 'UTF-8', 'auto');
                imageTTFtext($this->canvasView, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $content);
                return;
        }
    }

    /**
     * 繪製文章內容
     *
     * @return void
     */
    private function drawingContent(): void
    {
        /**
         * 取得分割後的文章內容
         */
        $content = $this->contentSplit($this->content);

        /**
         * 依序渲染文字。
         */
        foreach ($content as $key => $value) {
            /**
             * 計算錨點(x, y)
             */
            $xPoint = 36;
            if ($this->canvasCenter) {
                $yPoint = 24 + 440 + ((($key - 1) * 80) - (count($content) * 40));
            } else {
                $yPoint = 72 + ($key * 80);
            }

            /**
             * 特殊主題的錨點(x, y)需要移動
             */
            switch ($this->theme) {
                /** 主題: Windows 10 錯誤畫面 */
                case 'windows-10-error':
                    $yPoint += 240;
                    break;

                /** 主題: Windows 10 測試人員計畫 錯誤畫面 */
                case 'windows-10-error-testing':
                    $yPoint += 240;
                    break;

                /** 主題: 支離滅裂な思考・発言 */
                case 'broken-think':
                    $xPoint += 349;
                    $yPoint += 24;
                    break;

                /** 主題: 不獣控制な思考・発言 */
                case 'furry-broken-think':
                    $xPoint += 349;
                    $yPoint += 24;
                    break;
            }

            /**
             * 繪製當前迴圈所需要印製的文字內容
             */
            imageTTFtext($this->canvasView, $this->fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->themeTextColor, $this->fontPath, $value);
        }
    }

    /**
     * 繪製廣告內容
     *
     * @return void
     */
    private function drawingAds(): void
    {
        /**
         * 如果廣告類別是需要渲染圖片的話
         */
        if (
            $this->ads['data']['type'] === Ads::TYPE_ALL ||
            $this->ads['data']['type'] === Ads::TYPE_BANNER
        ) {
            /**
             * 建立透明圖層背景
             */
            $adsImage = imageCreateFromPng(public_path($this->ads['data']['picture']['local']));
            $adsCanvas = imageCreateTrueColor(imageSX($adsImage), imageSY($adsImage));
            $transColour = imageColorAllocateAlpha($adsCanvas, 0, 0, 0, 127);
            imageFill($adsCanvas, 0, 0, $transColour);
            imageCopy($adsCanvas, $adsImage, 0, 0, 0, 0, imageSX($adsImage), imageSY($adsImage));

            /**
             * 渲染黑白廣告。
             */
            if ($this->ads['data']['render']) {
                /**
                 * 取得背景 RGB Hex 資訊。
                 */
                $backgroundRGB = $this->getColorInfo($this->themeBackgroundColor);
                $backgroundRGB = [
                    255 - $backgroundRGB['red'],
                    255 - $backgroundRGB['green'],
                    255 - $backgroundRGB['blue'],
                ];

                /**
                 * 取得文字 RGB Hex 資訊。
                 */
                $textRGB = $this->getColorInfo($this->themeTextColor);
                $textRGB = [
                    $textRGB['red'],
                    $textRGB['green'],
                    $textRGB['blue'],
                ];

                /**
                 * 如果背景顏色是黑色
                 */
                if (
                    $backgroundRGB[0] == 255 &&
                    $backgroundRGB[1] == 255 &&
                    $backgroundRGB[2] == 255
                ) {
                    if (
                        $textRGB[0] == 248 &&
                        $textRGB[1] == 249 &&
                        $textRGB[2] == 250
                    ) {
                        /**
                         * 如果背景顏色是黑色
                         * 且字體顏色是白色，那就甚麼事情都不做
                         */
                    } else {
                        /**
                         * 如果背景顏色是黑色
                         * 但文字並不是白色，那就只渲染文字顏色就好
                         */
                        imageFilter($adsCanvas, IMG_FILTER_NEGATE);
                        imageFilter($adsCanvas, IMG_FILTER_COLORIZE, 255 - $textRGB[0], 255 - $textRGB[1], 255 - $textRGB[2]);
                        imageFilter($adsCanvas, IMG_FILTER_NEGATE);
                    }
                } else {
                    if (
                        $textRGB[0] == 248 &&
                        $textRGB[1] == 249 &&
                        $textRGB[2] == 250
                    ) {
                        /**
                         * 如果背景顏色不是黑色
                         * 但文字顏色是白色，那麼只要渲染背景顏色就好
                         */
                        imageFilter($adsCanvas, IMG_FILTER_COLORIZE, 255 - $backgroundRGB[0], 255 - $backgroundRGB[1], 255 - $backgroundRGB[2]);
                    } else {
                        /**
                         * 如果背景顏色不是黑色
                         * 且文字顏色也不是白色，那麼背景跟文字都需要被上色
                         */
                        imageFilter($adsCanvas, IMG_FILTER_NEGATE);
                        imageFilter($adsCanvas, IMG_FILTER_COLORIZE, $textRGB[0], $textRGB[1], $textRGB[2]);
                        imageFilter($adsCanvas, IMG_FILTER_NEGATE);
                        imageFilter($adsCanvas, IMG_FILTER_COLORIZE, $backgroundRGB[0], $backgroundRGB[1], $backgroundRGB[2]);
                        imageFilter($adsCanvas, IMG_FILTER_NEGATE);
                    }
                }
            }

            /**
             * 建立新的圖層並覆蓋
             */
            $newCanvas = imageCreateTrueColor(imageSX($this->canvasView), imageSY($this->canvasView));
            imageFill($newCanvas, 0, 0, $this->themeBackgroundColor);
            imageCopy($newCanvas, $this->canvasView, 0, 0, 0, 0, imageSX($this->canvasView), imageSY($this->canvasView));
            imageCopy($newCanvas, $adsCanvas, 0, imageSY($this->canvasView) - 240, 0, 0, imageSX($adsCanvas), imageSY($adsCanvas));
            $this->canvasView = $newCanvas;
        }

        return;
    }

    /**
     * 字串切割，並且以陣列(array[string])的方式回傳
     *
     * @param string $content
     *
     * @return array
     */
    private function contentSplit($content): array
    {
        /**
         * 先準備一個用來儲存結果的字串陣列
         */
        $responseList = [];
        /**
         * 將文字內容以換行符號來分割成字串陣列，並且迴圈執行每行內容
         */
        $contentList  = preg_split("/\\r\\n|\\r|\\n/", $content);
        foreach ($contentList as $contentKey => $contentValue) {
            /**
             * 計算當前文字內容長度
             */
            $contentStrlen = strlen($contentValue);
            if ($contentStrlen <= 42) {
                /**
                 * 如果內容長度小於或等於 42，直接將本行新增到結果陣列
                 */
                array_push($responseList, $contentValue);
            } else {
                /**
                 * 如果內容長度大於 42，因為內容太長，需要分割換行
                 *
                 * $conntentWidth => 長度計數器
                 * $charStrring => 字串暫存
                 * $contentValueList => 內容分割成陣列
                 */
                $contentWidth = 0;
                $charString   = '';
                $contentValueList = preg_split('/(?<!^)(?!$)/u', $contentValue);
                /**
                 * 將內容陣列以迴圈的方式來逐一執行
                 */
                foreach ($contentValueList as $charKey => $charValue) {
                    /**
                     * 判斷當前字元的長度
                     */
                    $charStrlen    = strlen($charValue);
                    /**
                     * 字元長度 3 位元，那麼紀錄長度為 1，否則為 0.5
                     * 字元儲存到字串暫存當中
                     */
                    $contentWidth += ($charStrlen == 3) ? 1 : 0.5;
                    $charString   .= $charValue;
                    /**
                     * 判斷是否還有下一個字元
                     */
                    if (array_key_exists($charKey + 1, $contentValueList)) {
                        /**
                         * 字元長度 3 位元，那麼紀錄長度為 1，否則為 0.5
                         */
                        $nextCharStrlen = strlen($contentValueList[$charKey + 1]);
                        $nextCharWidth  = ($nextCharStrlen == 3) ? 1 : 0.5;
                        /**
                         * 如當前長度再加上下一個字元的長度，長度大於字元最大限度
                         */
                        if (($contentWidth + $nextCharWidth) >= 14) {
                            /**
                             * 將當前的字串暫存做一個斷點，儲存到結果字串陣列
                             * 並且清空字串暫存、歸零長度計數器
                             */
                            array_push($responseList, $charString);
                            $contentWidth = 0;
                            $charString   = '';
                        }
                    }
                }

                /**
                 * 如果剩下的內容不是空的，那麼就把剩下的內容儲存到結果字串陣列
                 */
                if ($charString != '') {
                    array_push($responseList, $charString);
                }
            }
        }

        /**
         * 字串分割完畢，將結果字串陣列回傳
         */
        return $responseList;
    }

    /**
     * 取得顏色資訊
     *
     * @param int $color
     *
     * @return array|false
     */
    private function getColorInfo($color)
    {
        $canvas = imageCreateTrueColor(1, 1);
        $rgb = imageColorSforIndex($canvas, $color);

        return $rgb;
    }
}
