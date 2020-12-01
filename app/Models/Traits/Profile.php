<?php

namespace App\Models\Traits;

/**
 * Trait Profile.
 */
trait Profile
{
    /**
     * @return mixed|string
     * @throws \Creativeorange\Gravatar\Exceptions\InvalidEmailException
     */
    public function getProfile()
    {
        return array(
            'username' => $this->model->name,
            'avatar' => $this->model->getAvatar(),
            'email' => $this->model->email,
        );
    }

    /**
     * @return mixed
     */
    public function getProfileHtml()
    {
        $profile = $this->getProfile();

        return '
            <div style="height: 72px; width: 220px; position: inherit;">
                <a href="' . route('admin.auth.user.show', $this->model) . '" style="text-decoration: none;">
                    <img src="' . $profile['avatar'] .'" style="width: 48px; border-radius: 50%; margin: 12px; float: left;" />
                    <p style="padding: 12px 0px 0px 0px; margin: 0px;">
                        <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">' . $profile['username'] . '</strong>
                    </p>
                    <p style="padding: 0px 12px 0px 0px;">
                        <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">' . $profile['email'] .'</span>
                    </p>
                </a>
            </div>';
    }
}
