<?php

namespace App\Services\Socials\Cards;

use App\Services\BaseService;
use Vinkla\Facebook\Facades\Facebook;

/**
 * Class FacebookService.
 */
class FacebookService extends BaseService
{
    /**
     * @var Facebook
     */
    protected $facebook;

    /**
     * FacebookService constructor.
     *
     * @param string $connection
     */
    public function __construct(string $connection)
    {
        $this->facebook = Facebook::connection($connection);
    }

    public function create()
    {
        $facebook = Facebook::connection('secondary');
        $facebook->post(
            sprintf(
                '/%s/photos',
                config('facebook.connections.secondary.user_id')
            ),
            array(
                'message' => '測試發文',
                'source' => Facebook::fileToUpload('https://kaobei.engineer/img/frontend/default/FIpfZnQw.png'),
            ),
        );
    }
}
