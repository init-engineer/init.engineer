<?php

namespace App\Services\Socials\Images;

use App\Models\Social\Ads;
use Illuminate\Support\Str;
use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Repositories\Frontend\Social\AdsRepository;

/**
 * Class ImagesService.
 */
class ImagesService extends BaseService implements ImagesContract
{
    /**
     * 圖片物件。
     *
     * @var resource
     */
    protected $canvas;

    /**
     * 圖片寬度設定，預設為 960x720。
     *
     * @var int
     */
    protected $canvasWidth = 960;

    /**
     * 圖片高度設定，預設為 960x720。
     *
     * @var int
     */
    protected $canvasHeight = 720;

    /**
     * 圖片文字是否水平置中對齊。
     *
     * @var boolean
     */
    protected $canvasTextCenter = true;

    /**
     * 圖片文字顏色。
     *
     * @var int
     */
    protected $canvasTextColor;

    /**
     * 圖片背景顏色。
     *
     * @var int
     */
    protected $canvasBackgroundColor;

    /**
     * 圖片文字字型。
     *
     * @var
     */
    protected $canvasFont;

    /**
     * 圖片文字字型大小。
     *
     * @var int
     */
    protected $canvasFontSize = 48;

    /**
     * 文字的角度，預設就是沒角度。
     *
     * @var int
     */
    protected $canvasAngle = 0;

    /**
     * @var AdsRepository
     */
    protected $adsRepository;

    /**
     * ImagesService constructor.
     *
     * @param AdsRepository $adsRepository
     */
    function __construct(AdsRepository $adsRepository)
    {
        $this->adsRepository = $adsRepository;
    }

    /**
     * 使用者直接上傳圖片。
     *
     * @param array $data
     * @param file $image
     * @return array
     */
    public function uploadImage(array $data, $avatar)
    {
        $avatarPath = isset($data['avatarPath']) ? $data['avatarPath'] : 'cards/custom';
        $avatarName = isset($data['avatarName']) ? $data['avatarName'] : Str::random(128);
        $avatarType = isset($data['avatarType']) ? $data['avatarType'] : $avatar->getClientOriginalExtension();

        $storagePath = $avatar->storeAs(
            sprintf('public/%s', $avatarPath),
            sprintf('%s.%s', $avatarName, $avatarType)
        );

        return [
            'avatar' => [
                'image' => $storagePath,
                'path' => sprintf('public/%s', $avatarPath),
                'name' => $avatarName,
                'type' => $avatarType,
            ],
        ];
    }

    /**
     * 使用者透過平台的圖片產生器。
     *
     * @param array $data
     * @param Cards $cards
     *
     * @return array
     */
    public function buildImage(array $data, Cards $cards = null)
    {
        $content = $this->contentSplit($data['content']);
        $this->canvasTextCenter = ((count($content) * 80) < 600) ? true : false;
        $this->canvasHeight = $this->canvasTextCenter ? 720 : (72 + 72 + ((count($content) * 80)));

        switch ($data['themeStyle']) {
                /** Windows 最棒的畫面 */
            case '32d2a897602ef652ed8e15d66128aa74':
                $this->canvasHeight += 360;
                break;

                /** Windows 最棒的畫面 測試人員組件 */
            case 'tumx453xqZLjf5kaFFBzNj4gqVXKWqXz':
                $this->canvasHeight += 360;
                break;

                /** 支離滅裂な思考・発言 */
            case '05326525f82b9a036e1bcb53a392ff7c':
                $this->canvasHeight += 140;
                $this->canvasWidth += 349;
                break;

                /** 不獸控制な思考・発言 */
            case 'W6FTE8fL66w2u5Xo5s3OxdqmAMpzptvK':
                $this->canvasHeight += 140;
                $this->canvasWidth += 349;
                break;
        }

        /**
         * Feature
         */
        if (isset($data['isFeatureToBeCoutinued']) && $data['isFeatureToBeCoutinued']) $this->canvasHeight += 160;

        $this->createCanvas();
        $this->drawingTheme($data['themeStyle']);
        $this->drawingFont($data['fontStyle']);
        $this->drawingLogo($data['themeStyle']);
        $this->drawingUrl($data['themeStyle']);
        $this->drawingFeature($data);

        if (isset($data['isManagerLine']) && $data['isManagerLine']) {
            $this->drawingManagerLine();
        }

        /**
         * 依序渲染文字。
         */
        foreach ($content as $key => $value) {
            /**
             * 計算錨點(x, y)
             */
            $xPoint = 36;
            $yPoint = $this->canvasTextCenter ? 24 + ($this->canvasTextCenter) ? 440 + ((($key - 1) * 80) - (count($content) * 40)) : (($key + 1) * 80) : 72 + ($key * 80);

            switch ($data['themeStyle']) {
                    /** Windows 最棒的畫面 */
                case '32d2a897602ef652ed8e15d66128aa74':
                    $yPoint += 240;
                    break;

                    /** Windows 最棒的畫面 測試人員組件 */
                case 'tumx453xqZLjf5kaFFBzNj4gqVXKWqXz':
                    $yPoint += 240;
                    break;

                    /** 支離滅裂な思考・発言 */
                case '05326525f82b9a036e1bcb53a392ff7c':
                    $xPoint += 349;
                    $yPoint += 24;
                    break;

                    /** 支離滅裂な思考・発言 */
                case 'W6FTE8fL66w2u5Xo5s3OxdqmAMpzptvK':
                    $xPoint += 349;
                    $yPoint += 24;
                    break;
            }

            imageTTFtext($this->canvas, $this->canvasFontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $value);
        }

        /**
         * 渲染廣告。
         */
        if (isset($cards)) {
            /**
             * 隨機抽選廣告。
             */
            if ($ads = $this->adsRepository->findRandom($cards)) {
                /**
                 * 如果廣告類別是需要添增文字的話。
                 */
                if ($ads->type === Ads::TYPE_ALL ||
                    $ads->type === Ads::TYPE_CONTENT) {
                    $content = $cards->content;
                    $content = $content . "\n\r------------\n\r【廣告內容】\n\r" . $ads->content . "\n\r------------\n\r";
                    $cards->content = $content;
                    $cards->save();
                }

                /**
                 * 如果廣告類別是需要渲染圖片的話。
                 */
                if ($ads->type === Ads::TYPE_ALL ||
                    $ads->type === Ads::TYPE_BANNER) {
                    if ($ads->isRender()) {
                        $adsImage = imageCreateFromPng($this->getImageUrl($ads->ads_path));
                        $adsCanvas = imageCreateTrueColor(imageSX($adsImage), imageSY($adsImage));
                        imageCopy($adsCanvas, $adsImage, 0, 0, 0, 0, imageSX($adsImage), imageSY($adsImage));

                        $backgroundRGB = $this->getColorInfo($this->canvasBackgroundColor);
                        $backgroundRGB = array(255 - $backgroundRGB['red'], 255 - $backgroundRGB['green'], 255 - $backgroundRGB['blue']);

                        $textRGB = $this->getColorInfo($this->canvasTextColor);
                        $textRGB = array($textRGB['red'], $textRGB['green'], $textRGB['blue']);

                        /**
                         * 如果背景顏色是黑色
                         */
                        if ($backgroundRGB[0] == 255 && $backgroundRGB[1] == 255 && $backgroundRGB[2] == 255) {
                            if ($textRGB[0] == 248 && $textRGB[1] == 249 && $textRGB[2] == 250) {
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
                            if ($textRGB[0] == 248 && $textRGB[1] == 249 && $textRGB[2] == 250) {
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

                        $adsSY = imageSY($adsCanvas);
                        $canvasSY = imageSY($this->canvas);
                        $newCanvasSY = $adsSY + $canvasSY;

                        $newCanvas = imageCreateTrueColor(imageSX($this->canvas), $newCanvasSY);
                        imageCopy($newCanvas, $this->canvas, 0, 0, 0, 0, imageSX($this->canvas), imageSY($this->canvas));
                        imageCopy($newCanvas, $adsCanvas, 0, $canvasSY, 0, 0, imageSX($adsCanvas), imageSY($adsCanvas));
                        $this->canvas = $newCanvas;
                    } else {
                        /**
                         * 建立透明圖層背景
                         */
                        $adsImage = imageCreateFromPng($this->getImageUrl($ads->ads_path));
                        $adsCanvas = imageCreateTrueColor(imageSX($adsImage), imageSY($adsImage));
                        $transColour = imageColorAllocateAlpha($adsCanvas, 0, 0, 0, 127);
                        imageFill($adsCanvas, 0, 0, $transColour);
                        imageCopy($adsCanvas, $adsImage, 0, 0, 0, 0, imageSX($adsImage), imageSY($adsImage));

                        /**
                         * 計算 Y 軸
                         */
                        $adsSY = imageSY($adsCanvas);
                        $canvasSY = imageSY($this->canvas);
                        $newCanvasSY = $adsSY + $canvasSY;

                        /**
                         * 建立新的圖層並覆蓋
                         */
                        $newCanvas = imageCreateTrueColor(imageSX($this->canvas), $newCanvasSY);
                        imageFill($newCanvas, 0, 0, $this->canvasBackgroundColor);
                        imageCopy($newCanvas, $this->canvas, 0, 0, 0, 0, imageSX($this->canvas), imageSY($this->canvas));
                        imageCopy($newCanvas, $adsCanvas, 0, $canvasSY, 0, 0, imageSX($adsCanvas), imageSY($adsCanvas));
                        $this->canvas = $newCanvas;
                    }
                }
            }
        }

        /**
         * 執行輸出圖片的一個動作。
         */
        ob_start();
        $avatarPath  = isset($data['avatarPath']) ? $data['avatarPath'] : 'cards/images';
        $avatarName  = isset($data['avatarName']) ? $data['avatarName'] : Str::random(128);
        $avatarType  = isset($data['avatarType']) ? $data['avatarType'] : 'jpeg';
        $storagePath = storage_path(sprintf('app/public/%s/%s.%s', $avatarPath, $avatarName, $avatarType));

        switch ($avatarType) {
            case 'gif':
                imageGIF($this->canvas, $storagePath);
                break;

            case 'png':
                imagePNG($this->canvas, $storagePath);
                break;

            case 'jpeg':
                imageJPEG($this->canvas, $storagePath);
                break;

            default:
                imageJPEG($this->canvas, $storagePath);
                break;
        }

        $imageOutput = base64_encode(ob_get_clean());
        imagedestroy($this->canvas);

        return [
            'avatar' => [
                'image' => $imageOutput,
                'path' => sprintf('public/%s', $avatarPath),
                'name' => $avatarName,
                'type' => $avatarType,
            ],
        ];
    }

    /**
     * 建立畫布。
     *
     * @return resource
     */
    private function createCanvas()
    {
        $this->canvas = imageCreateTrueColor(
            $this->canvasWidth,
            $this->canvasHeight
        );
    }

    /**
     * 畫上應用程式名稱。
     *
     * @param string $theme
     * @return resource
     */
    private function drawingLogo($theme)
    {
        switch ($theme) {
                /** Windows 最棒的畫面 */
            case '32d2a897602ef652ed8e15d66128aa74':
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 160, $this->canvasTextColor, $this->canvasFont, '若要深入了解，您稍候可以線上搜尋此:');
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 120, $this->canvasTextColor, $this->canvasFont, sprintf('%s 0xINIT_ENGINEER', app_name()));
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 40,  $this->canvasTextColor, $this->canvasFont, sprintf('請訪問 %s', app_url()));
                break;

                /** Windows 最棒的畫面 測試人員組件 */
            case 'tumx453xqZLjf5kaFFBzNj4gqVXKWqXz':
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 160, $this->canvasTextColor, $this->canvasFont, '若要深入了解，您稍候可以線上搜尋此:');
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 120, $this->canvasTextColor, $this->canvasFont, sprintf('%s 0xINIT_ENGINEER', app_name()));
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 40,  $this->canvasTextColor, $this->canvasFont, sprintf('請訪問 %s', app_url()));
                break;

            case '05326525f82b9a036e1bcb53a392ff7c':
                $fontSize   = 24;
                $fontWidth  = imageFontWidth($fontSize) * strlen(app_name());
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $this->canvasWidth - ($fontWidth * 1.2) - $fontSize;
                $yPoint     = $this->canvasHeight - $fontHeight - $fontSize;
                $content    = mb_convert_encoding(app_name(), 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);

                $fontSize   = 48;
                $fontWidth  = imageFontWidth($fontSize) * strlen('支離滅裂な');
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = 360;
                $yPoint     = $this->canvasHeight - 160;
                $content    = mb_convert_encoding('支離滅裂な', 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);

                $fontSize   = 48;
                $fontWidth  = imageFontWidth($fontSize) * strlen('思考・発言');
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = 360;
                $yPoint     = $this->canvasHeight - 80;
                $content    = mb_convert_encoding('思考・発言', 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);
                break;

            case 'W6FTE8fL66w2u5Xo5s3OxdqmAMpzptvK':
                $fontSize   = 24;
                $fontWidth  = imageFontWidth($fontSize) * strlen(app_name());
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $this->canvasWidth - ($fontWidth * 1.2) - $fontSize;
                $yPoint     = $this->canvasHeight - $fontHeight - $fontSize;
                $content    = mb_convert_encoding(app_name(), 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);

                $fontSize   = 48;
                $fontWidth  = imageFontWidth($fontSize) * strlen('不獸控制な');
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = 360;
                $yPoint     = $this->canvasHeight - 160;
                $content    = mb_convert_encoding('不獸控制な', 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);

                $fontSize   = 48;
                $fontWidth  = imageFontWidth($fontSize) * strlen('思考・発言');
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = 360;
                $yPoint     = $this->canvasHeight - 80;
                $content    = mb_convert_encoding('思考・発言', 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);
                break;

            default:
                $fontSize   = 24;
                $fontWidth  = imageFontWidth($fontSize) * strlen(app_name());
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $this->canvasWidth - ($fontWidth * 1.2) - $fontSize;
                $yPoint     = $this->canvasHeight - $fontHeight - $fontSize;
                $content    = mb_convert_encoding(app_name(), 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);
                break;
        }

        return $this->canvas;
    }

    /**
     * 畫上發表文章傳送門。
     *
     * @param string $theme
     * @return resource
     */
    private function drawingUrl($theme)
    {
        switch ($theme) {
                /** Windows 最棒的畫面 */
            case '32d2a897602ef652ed8e15d66128aa74':
                imageTTFtext($this->canvas, 160, $this->canvasAngle, 48, 192, $this->canvasTextColor, $this->canvasFont, ':(');
                break;

                /** Windows 最棒的畫面 測試人員組件 */
            case 'tumx453xqZLjf5kaFFBzNj4gqVXKWqXz':
                imageTTFtext($this->canvas, 160, $this->canvasAngle, 48, 192, $this->canvasTextColor, $this->canvasFont, ':(');
                break;

            default:
                $fontSize   = 24;
                $fontWidth  = imageFontWidth($fontSize) * strlen(sprintf('發文傳送門 %s', app_url()));
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $fontSize;
                $yPoint     = $this->canvasHeight - $fontHeight - $fontSize;
                $content    = mb_convert_encoding(sprintf('發文傳送門 %s', app_url()), 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);
                break;
        }

        return $this->canvas;
    }

    /**
     * 繪製特殊樣式
     *
     * @param array $data
     * @return resource
     */
    private function drawingFeature($data)
    {
        if (isset($data['isFeatureToBeCoutinued']) && $data['isFeatureToBeCoutinued']) {
            $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/to_be_continued.png'));
            imageCopy($this->canvas, $overlayImage, 24, $this->canvasHeight - 240, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
        };
    }

    /**
     * 賦予圖片樣式。
     *
     * @param string $theme
     * @return bool
     */
    private function drawingTheme($theme)
    {
        switch ($theme) {
                /** 黑底綠字 */
            case '2e6046c7387d8fbe9acd700394a3add3':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 0, 255, 59);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 0, 0, 0);
                break;

                /** 黑底黃字 */
            case 'be551aa525b9d13790278b008a9ec7bf':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 235, 212, 67);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 0, 0, 0);
                break;

                /** 黑底白字 */
            case '8a755c0bd32e29f813c1aa4267357d5a':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 248, 249, 250);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 0, 0, 0);
                break;

                /** 黑底紅字 */
            case '507d8c23bdcc98850c7be1c1286d5dcf':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 220, 53, 69);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 0, 0, 0);
                break;

                /** 甜甜香草巧克力熊貓 */
            case '7d37ef838c73b3397403eec4bf4f3839':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 248, 249, 250);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 232, 62, 140);
                break;

                /** 藍白屏 */
            case '4834578267bcb800feb2762d2a3ccff2':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 248, 249, 250);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 0, 123, 255);
                break;

                /** PostgreSQL */
            case 'dc7b1c2c41639e5cf10f725d60ad8c64':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 0, 123, 255);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 248, 249, 250);
                break;

                /** Laravel */
            case 'a5c95b86291ea299fcbe64458ed12702':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 248, 249, 250);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 244, 100, 95);
                break;

                /** 軟體綠 */
            case '731019ad725385614d65fbcc5fb1758e':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 52, 58, 64);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 57, 197, 187);
                break;

                /** 皮卡丘 */
            case '9CE44F88A25272B6D9CBB430EBBCFCF1':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 255, 213, 71);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 47, 52, 55);
                break;

                /** 伊布 */
            case '640ED62B7D35C1765A05EB8724535A53':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 231, 175, 86);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 47, 52, 55);
                break;

                /** 反向 皮卡丘 */
            case '9A2E33D968A1AF98B09E26AC63CB6DCB':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 47, 52, 55);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 255, 213, 71);
                break;

                /** 反向 伊布 */
            case '98C614FBC16CCF5D5740BD4D4E00757C':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 47, 52, 55);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 231, 175, 86);
                break;

                /** 新年限定主題 */
            case '2be6c9a365a26a12876145e9229639b1':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 216, 176, 106);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 166, 23, 35);
                break;

                /** 反向 新年限定主題 */
            case 'b9b8ae80a601616cb9af07aaabe532f4':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 166, 23, 35);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 216, 176, 106);
                break;

                /** 恭迎慈孤觀音 渡世靈顯四方 */
            case '05217b7d4741e38096a54eff4226c217':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 0, 0, 0);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 241, 21, 65);
                $this->drawingBackgroundImage('05217b7d4741e38096a54eff4226c217');
                break;

                /** Windows 最棒的畫面 */
            case '32d2a897602ef652ed8e15d66128aa74':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 248, 249, 250);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 0, 123, 208);
                $this->drawingBackgroundImage('32d2a897602ef652ed8e15d66128aa74');
                break;

                /** Windows 最棒的畫面 測試人員組件 */
            case 'tumx453xqZLjf5kaFFBzNj4gqVXKWqXz':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 248, 249, 250);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 16, 124, 16);
                $this->drawingBackgroundImage('tumx453xqZLjf5kaFFBzNj4gqVXKWqXz');
                break;

                /** 粉紅色 */
            case 'j874kwoxi2nh64yt67wtphy9m5dmea4q':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 255, 83, 118);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 248, 192, 200);
                break;

                /** 支離滅裂な思考・発言 */
            case '05326525f82b9a036e1bcb53a392ff7c':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 0, 0, 0);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 248, 249, 250);
                $this->drawingBackgroundImage('05326525f82b9a036e1bcb53a392ff7c');
                break;

                /** 不獸控制な思考・発言 */
            case 'W6FTE8fL66w2u5Xo5s3OxdqmAMpzptvK':
                $this->canvasTextColor = imageColorAllocate($this->canvas, 0, 0, 0);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 248, 249, 250);
                $this->drawingBackgroundImage('W6FTE8fL66w2u5Xo5s3OxdqmAMpzptvK');
                break;

                /** 預設 黑底綠字 */
            default:
                $this->canvasTextColor = imageColorAllocate($this->canvas, 0, 255, 59);
                $this->canvasBackgroundColor = imageColorAllocate($this->canvas, 0, 0, 0);
                break;
        }

        /**
         * 將圖片上背景顏色。
         */
        return imageFill($this->canvas, 0, 0, $this->canvasBackgroundColor);
    }

    /**
     * 繪製圖片的字型字體。
     *
     * @param string $font
     * @return void
     */
    private function drawingFont($font)
    {
        switch ($font) {
                /** 蒙納繁圓點陣 */
            case 'f762e3a99692b40e5929ab3668606a4a':
                $this->canvasFont = public_path('fonts/MBitmapRoundHK-Light.otf');
                break;

                /** ZPIX 點陣字型 */
            case '1b23b3cd9223930ac694b7f29f38ff21':
                $this->canvasFont = public_path('fonts/Zfull-GB.ttf');
                break;

                /** AURAKA 點陣宋字型 */
            case 'ea98dde8987df3cd8aef75479019b688':
                $this->canvasFont = public_path('fonts/Auraka.ttf');
                break;

                /** 新細明體 */
            case 'c0b5dd764ede0ca105be22cf13ebadff':
                $this->canvasFont = public_path('fonts/mingliu.ttc');
                break;

                /** 張海山銳諧體 */
            case '68068fcf50e7cae709cb8ed0b7b9b0f3':
                $this->canvasFont = public_path('fonts/ZHS-Harmonic.ttf');
                break;

                /** 標楷體 */
            case '21881fc6a87aca0dd1afc685cb6ee891':
                $this->canvasFont = public_path('fonts/kaiu.ttf');
                break;

                /** 國喬點陣字型 */
            case '813ca6cbbd95d7e08fa2af59bc12072d':
                $this->canvasFont = public_path('fonts/kc24m.ttf');
                break;

                /** 微軟正黑體 */
            case '13f5333afe00f8c7e8da7e0b13ec2c94':
                $this->canvasFont = public_path('fonts/microsoft_jheng_hei.ttf');
                break;

                /** 極粗明朝體 */
            case 'ozke4ri3gkpy7e9c312u5l0w5vr9jdqq':
                $this->canvasFont = public_path('fonts/FOT-MatissePro-EB.otf');
                break;

                /** 台北黑體 */
            case 'yc45sgsfbss490dqgs2g23a7z24slhoj':
                $this->canvasFont = public_path('fonts/TaipeiSansTCBeta-Bold.ttf');
                break;

                /** RocknRoll One-Regular */
            case '7yQkdi3Q0lIt0GTZ3GToByiQoQuUGT2c':
                $this->canvasFont = public_path('fonts/RocknRollOne-Regular.ttf');
                break;

                /** DotGothic16-Regular */
            case 'bxwe3vU47DyWTEM17sLNQTCHOBbB13xh':
                $this->canvasFont = public_path('fonts/DotGothic16-Regular.ttf');
                break;

                /** Rampart One-Regular */
            case 'DVAgml6ZFScVZ05aZQmo1bzSZDGtfDZV':
                $this->canvasFont = public_path('fonts/RampartOne-Regular.ttf');
                break;

                /** Reggae One-Regular */
            case 'hfPg6Tb250eMRlEnew2PHEdqzfCK2bbu':
                $this->canvasFont = public_path('fonts/ReggaeOne-Regular.ttf');
                break;

                /** Stick-Regular */
            case 'Fwc7qnSDTtQ5gAwDOHJXU251ZovUEEtN':
                $this->canvasFont = public_path('fonts/Stick-Regular.ttf');
                break;

                /** Klee One Regular */
            case '2EEqzp9EHqHTu1jKGhOZ3lspfsbvwOar':
                $this->canvasFont = public_path('fonts/KleeOne-Regular.ttf');
                break;

                /** Klee One SemiBold */
            case 'wWyUkCWL5HW8nhw9wwawx0WbVAyxZjEN':
                $this->canvasFont = public_path('fonts/KleeOne-SemiBold.ttf');
                break;

                /** Train One-Regular */
            case 'LrDE83PVGCbTlMTShdkpEdna5FrXy1P0':
                $this->canvasFont = public_path('fonts/TrainOne-Regular.ttf');
                break;

                /** 預設: AURAKA 點陣宋字型 */
            default:
                $this->canvasFont = public_path('fonts/Auraka.ttf');
                break;
        }
    }

    /**
     * 繪製圖片的背景圖案。
     *
     * @param string $theme
     * @return void
     */
    private function drawingBackgroundImage($theme)
    {
        switch ($theme) {
                /** 恭迎慈孤觀音 渡世靈顯四方 */
            case '05217b7d4741e38096a54eff4226c217':
                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/devotion-bg.png'));
                imageCopy($this->canvas, $overlayImage, 360, 64, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                break;

                /** Windows 最棒的畫面 */
            case '32d2a897602ef652ed8e15d66128aa74':
                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/qrcode.png'));
                imageCopy($this->canvas, $overlayImage, 24, imageSY($this->canvas) - 204, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                break;

                /** Windows 最棒的畫面 測試人員組件 */
            case 'tumx453xqZLjf5kaFFBzNj4gqVXKWqXz':
                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/qrcode.png'));
                imageCopy($this->canvas, $overlayImage, 24, imageSY($this->canvas) - 204, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                break;

                /** 支離滅裂な思考・発言 */
            case '05326525f82b9a036e1bcb53a392ff7c':
                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/fragmented_background.png'));
                imageCopy($this->canvas, $overlayImage, 0, imageSY($this->canvas) - 560, 0, 0, imageSX($overlayImage), imageSY($overlayImage));

                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/fragmented_people.png'));
                imageCopy($this->canvas, $overlayImage, 36, imageSY($this->canvas) - 542, 0, 0, imageSX($overlayImage), imageSY($overlayImage));

                $square_width = $this->canvasWidth - 375;
                $square_height = $this->canvasHeight - 250;
                $newimg = imageCreateTrueColor($square_width, $square_height);
                $border = imageColorAllocate($newimg, 0, 0, 0);
                $fill = imageColorAllocate($newimg, 255, 255, 255);
                imageFilledRectAngle($newimg, 0, 0, $square_width, $square_height, $fill);
                imageSetThickness($newimg, 6);
                imageRectAngle($newimg, 6, 6, $square_width - 6, $square_height - 6, $border);

                $top = (72 - $this->canvasHeight * 0.05 > 0) ? 72 - $this->canvasHeight * 0.05 : 20;
                imageCopy($this->canvas, $newimg, 350, $top, 0, 0, $square_width, $square_height);

                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/fragmented_background_arrow.png'));
                imageCopy($this->canvas, $overlayImage, 315, imageSY($this->canvas) - 372, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                break;

                /** 不獸控制な思考・発言 */
            case 'W6FTE8fL66w2u5Xo5s3OxdqmAMpzptvK':
                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/fragmented_background.png'));
                imageCopy($this->canvas, $overlayImage, 0, imageSY($this->canvas) - 560, 0, 0, imageSX($overlayImage), imageSY($overlayImage));

                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/fragmented_wolf.png'));
                imageCopy($this->canvas, $overlayImage, 12, imageSY($this->canvas) - 482, 0, 0, imageSX($overlayImage), imageSY($overlayImage));

                $square_width = $this->canvasWidth - 375;
                $square_height = $this->canvasHeight - 250;
                $newimg = imageCreateTrueColor($square_width, $square_height);
                $border = imageColorAllocate($newimg, 0, 0, 0);
                $fill = imageColorAllocate($newimg, 255, 255, 255);
                imageFilledRectAngle($newimg, 0, 0, $square_width, $square_height, $fill);
                imageSetThickness($newimg, 6);
                imageRectAngle($newimg, 6, 6, $square_width - 6, $square_height - 6, $border);

                $top = (72 - $this->canvasHeight * 0.05 > 0) ? 72 - $this->canvasHeight * 0.05 : 20;
                imageCopy($this->canvas, $newimg, 350, $top, 0, 0, $square_width, $square_height);

                $overlayImage = imageCreateFromPng($this->getImageUrl('img/frontend/cards/fragmented_background_arrow.png'));
                imageCopy($this->canvas, $overlayImage, 315, imageSY($this->canvas) - 372, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                break;

            default:
                break;
        }
    }

    /**
     * 繪製管理員框線。
     *
     * @return void
     */
    private function drawingManagerLine()
    {
        for ($i = 12; $i < 18; $i++) {
            imageRectAngle($this->canvas, $i, $i, $this->canvasWidth - $i, $this->canvasHeight - $i, $this->canvasTextColor);
        }
    }

    /**
     * 字串自動換行。
     *
     * @param string $content
     * @return array
     */
    private function contentSplit($content)
    {
        $contentList  = preg_split("/\\r\\n|\\r|\\n/", $content);
        $responseList = [];
        foreach ($contentList as $contentKey => $contentValue) {
            $contentStrlen = strlen($contentValue);
            if ($contentStrlen <= 42) {
                array_push($responseList, $contentValue);
            } else {
                $contentWidth = 0;
                $charString   = '';
                $contentValueList = preg_split('/(?<!^)(?!$)/u', $contentValue);
                foreach ($contentValueList as $charKey => $charValue) {
                    $charStrlen    = strlen($charValue);
                    $contentWidth += ($charStrlen == 3) ? 1 : 0.5;
                    $charString   .= $charValue;
                    if (array_key_exists($charKey + 1, $contentValueList)) {
                        $nextCharStrlen = strlen($contentValueList[$charKey + 1]);
                        $nextCharWidth  = ($nextCharStrlen == 3) ? 1 : 0.5;

                        if (($contentWidth + $nextCharWidth) >= 14) {
                            array_push($responseList, $charString);
                            $contentWidth = 0;
                            $charString   = '';
                        }
                    }
                }

                if ($charString != '') {
                    array_push($responseList, $charString);
                }
            }
        }

        return $responseList;
    }

    /**
     * 取得顏色資訊。
     */
    private function getColorInfo($color)
    {
        $canvas = imageCreateTrueColor(1, 1);
        $rgb = imageColorSforIndex($canvas, $color);

        return $rgb;
    }

    /**
     * 取得圖片網址的方式。
     */
    private function getImageUrl(string $url)
    {
        // return 'https://init.engineer/' . $url;
        return asset($url);
    }
}
