<?php

namespace App\Services\Socials\Images;

use Illuminate\Support\Str;
use App\Services\BaseService;

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
     * ImagesService constructor.
     */
    function __construct()
    {
        // Code ...
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
        $avatarPath = isset($data['avatarPath'])? $data['avatarPath'] : 'public/cards/custom';
        $avatarName = isset($data['avatarName'])? $data['avatarName'] : Str::random(128);
        $avatarType = isset($data['avatarType'])? $data['avatarType'] : $avatar->getClientOriginalExtension();

        $storagePath = $avatar->storeAs(
            $avatarPath,
            sprintf('%s.%s', $avatarName, $avatarType)
        );

        return array(
            'avatar' => array(
                'image' => $storagePath,
                'path' => $avatarPath,
                'name' => $avatarName,
                'type' => $avatarType,
            ),
        );
    }

    /**
     * 使用者透過平台的圖片產生器。
     *
     * @param array $data
     * @return array
     */
    public function buildImage(array $data)
    {
        $content = $this->contentSplit($data['content']);
        $this->canvasTextCenter = ((count($content) * 80) < 600)? true : false;
        $this->canvasHeight = $this->canvasTextCenter? 720 : (72 + 72 + ((count($content) * 80)));

        switch($data['themeStyle'])
        {
            /** Windows 最棒的畫面 */
            case '32d2a897602ef652ed8e15d66128aa74':
                $this->canvasHeight += 360;
                break;
        }
        // dd($data['themeStyle']);

        $this->createCanvas();
        $this->drawingTheme($data['themeStyle']);
        $this->drawingFont($data['fontStyle']);
        $this->drawingLogo($data['themeStyle']);
        $this->drawingUrl($data['themeStyle']);

        if ($data['isManagerLine'])
        {
            $this->drawingManagerLine();
        }

        /**
         * 依序渲染文字。
         */
        foreach ($content as $key => $value)
        {
            $xPoint = 36;
            $yPoint = $this->canvasTextCenter? 24 + ($this->canvasTextCenter)? 440 + ((($key - 1) * 80) - (count($content) * 40)) : (($key + 1) * 80) : 72 + ($key * 80);

            switch($data['themeStyle'])
            {
                /** Windows 最棒的畫面 */
                case '32d2a897602ef652ed8e15d66128aa74':
                    $yPoint += 240;
                    break;
            }

            imageTTFtext($this->canvas, $this->canvasFontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $value);
        }

        /**
         * 執行輸出圖片的一個動作。
         */
        ob_start();
        $avatarPath  = isset($data['avatarPath'])? $data['avatarPath'] : 'app/public/cards/images/';
        $avatarName  = isset($data['avatarName'])? $data['avatarName'] : Str::random(128);
        $avatarType  = isset($data['avatarType'])? $data['avatarType'] : 'jpeg';
        $storagePath = storage_path(sprintf('%s%s.%s', $avatarPath, $avatarName, $avatarType));

        switch ($avatarType)
        {
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

        return array(
            'avatar' => array(
                'image' => $imageOutput,
                'path' => $avatarPath,
                'name' => $avatarName,
                'type' => $avatarType,
            ),
        );
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
        switch($theme)
        {
            case '32d2a897602ef652ed8e15d66128aa74':
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 160, $this->canvasTextColor, $this->canvasFont, '若要深入了解，您稍候可以線上搜尋此:');
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 120, $this->canvasTextColor, $this->canvasFont, '純靠北工程師 0xKAOBEI_ENGINEER');
                imageTTFtext($this->canvas, 26, $this->canvasAngle, 228, $this->canvasHeight - 40,  $this->canvasTextColor, $this->canvasFont, '請訪問 https://kaobei.engineer');
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
        switch($theme)
        {
            case '32d2a897602ef652ed8e15d66128aa74':
                imageTTFtext($this->canvas, 160, $this->canvasAngle, 48, 192, $this->canvasTextColor, $this->canvasFont, ':(');
                break;

            default:
                $fontSize   = 24;
                $fontWidth  = imageFontWidth($fontSize) * strlen(sprintf('發文傳送門 %s', env('APP_URL')));
                $fontHeight = imageFontHeight($fontSize);
                $xPoint     = $fontSize;
                $yPoint     = $this->canvasHeight - $fontHeight - $fontSize;
                $content    = mb_convert_encoding(sprintf('發文傳送門 %s', env('APP_URL')), 'UTF-8', 'auto');
                imageTTFtext($this->canvas, $fontSize, $this->canvasAngle, $xPoint, $yPoint, $this->canvasTextColor, $this->canvasFont, $content);
                break;
        }

        return $this->canvas;
    }

    /**
     * 賦予圖片樣式。
     *
     * @param string $theme
     * @return bool
     */
    private function drawingTheme($theme)
    {
        switch ($theme)
        {
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

            /** 預設: 黑底綠字 */
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
        switch ($font)
        {
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
        switch($theme)
        {
            /** 恭迎慈孤觀音 渡世靈顯四方 */
            case '05217b7d4741e38096a54eff4226c217':
                $overlayImage = imageCreateFromPng(asset('img/frontend/cards/devotion-bg.png'));
                imageCopy($this->canvas, $overlayImage, 360, 64, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
                break;

            /** Windows 最棒的畫面 */
            case '32d2a897602ef652ed8e15d66128aa74':
                $overlayImage = imageCreateFromPng(asset('img/frontend/cards/qrcode.png'));
                imageCopy($this->canvas, $overlayImage, 24, imageSY($this->canvas) - 204, 0, 0, imageSX($overlayImage), imageSY($overlayImage));
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
        for ($i = 12; $i < 18; $i++)
        {
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
        $responseList = array();
        foreach ($contentList as $contentKey => $contentValue)
        {
            $contentStrlen = strlen($contentValue);
            if ($contentStrlen <= 42)
            {
                array_push($responseList, $contentValue);
            }
            else
            {
                $contentWidth = 0;
                $charString   = '';
                $contentValueList = preg_split('/(?<!^)(?!$)/u', $contentValue);
                foreach ($contentValueList as $charKey => $charValue)
                {
                    $charStrlen    = strlen($charValue);
                    $contentWidth += ($charStrlen == 3) ? 1 : 0.5;
                    $charString   .= $charValue;
                    if (array_key_exists($charKey + 1, $contentValueList))
                    {
                        $nextCharStrlen = strlen($contentValueList[$charKey + 1]);
                        $nextCharWidth  = ($nextCharStrlen == 3) ? 1 : 0.5;

                        if (($contentWidth + $nextCharWidth) >= 14)
                        {
                            array_push($responseList, $charString);
                            $contentWidth = 0;
                            $charString   = '';
                        }
                    }
                }

                if ($charString != '')
                {
                    array_push($responseList, $charString);
                }
            }
        }

        return $responseList;
    }
}
