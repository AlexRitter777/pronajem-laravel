<?php

namespace App\Actions\Base;

use App\Models\User;

trait FindUserOwnedModel
{

    protected function findUserOwnedModel(string $modelClass, string|int $id, User $user)
    {
        return $modelClass::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();
    }

}
