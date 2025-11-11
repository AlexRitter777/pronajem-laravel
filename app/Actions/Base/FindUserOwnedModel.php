<?php

namespace App\Actions\Base;

use App\Models\User;

trait FindUserOwnedModel
{

    protected function findOwnedModelQuery(string $modelClass, User $user)
    {
        return $modelClass::query()->where('user_id', $user->id);
    }

    protected function findUserOwnedModel(string $modelClass, string|int $id, User $user)
    {
        return $this->findOwnedModelQuery($modelClass, $user)
            ->where('id', $id)
            ->firstOrFail();
    }

}
