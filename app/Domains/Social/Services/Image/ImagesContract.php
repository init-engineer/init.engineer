<?php

namespace App\Domains\Social\Services\Image;

use GdImage;

/**
 * Interface ImagesContract.
 */
abstract class ImagesContract
{
    /**
     * 文字內容
     *
     * @var string
     */
    protected $content;

    /**
     * 主題
     *
     * @var string
     */
    protected $theme;

    /**
     * 圖片文字顏色。
     *
     * @var int
     */
    protected $themeTextColor;

    /**
     * 圖片背景顏色。
     *
     * @var int
     */
    protected $themeBackgroundColor;

    /**
     * 字型
     *
     * @var string
     */
    protected $font;

    /**
     * 字型檔位址
     *
     * @var string
     */
    protected $fontPath;

    /**
     * 字型大小
     *
     * @var int
     */
    protected $fontSize = 48;

    /**
     * 畫布物件
     *
     * @var GdImage
     */
    protected $canvasView;

    /**
     * 畫布寬度
     *
     * @var int
     */
    protected $canvasViewWidth = 960;

    /**
     * 畫布高度
     *
     * @var int
     */
    protected $canvasViewHeight = 720;

    /**
     * 文字角度
     *
     * @var int
     */
    protected $canvasAngle = 0;

    /**
     * 文字高度
     *
     * @var int
     */
    protected $lineHeight = 80;

    /**
     * 內容垂直置中
     *
     * @var boolean
     */
    protected $canvasCenter = false;

    /**
     * 廣告資訊
     *
     * @var array
     */
    protected $ads;

    /**
     * 畫布預設寬度
     *
     * @var int
     */
    protected $defaultCanvasWidth = 960;

    /**
     * 畫布預設高度
     *
     * @var int
     */
    protected $defaultCanvasHeight = 720;

    /**
     * 文字預設角度
     *
     * @var int
     */
    protected $defaultCanvasAngle = 0;

    /**
     * 文字預設高度
     *
     * @var int
     */
    protected $defaultLineHeight = 80;

    /**
     * 預設字型大小
     *
     * @var int
     */
    protected $defaultFontSize = 48;

    /**
     * @var AdsService
     */
    protected $adsService;
}
