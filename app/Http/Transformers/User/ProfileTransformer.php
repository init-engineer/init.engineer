<?php

namespace App\Http\Transformers\User;

use App\Models\Auth\User;
use League\Fractal\TransformerAbstract;

/**
 * Class ProfileTransformer.
 */
class ProfileTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'         => $user->id,
            'uuid'       => $user->uuid,
            'full_name'  => $user->full_name,
            'last_name'  => $user->last_name,
            'first_name' => $user->first_name,
            'email'      => $user->email,
            'avatar'     => $user->getPicture(),
            'active'     => $user->active,
            'confirmed'  => $user->confirmed,
            'timezone'   => $user->timezone,
        ];
    }
}
