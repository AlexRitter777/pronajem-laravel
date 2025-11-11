<?php

namespace App\Actions\Base;


use App\Models\User;

abstract class StoreUserOwnedModelAction
{
    abstract protected function model(): string;
    abstract protected function toArray(object $data): array;

    public function execute(object $data, User $user)
    {
        $modelClass = $this->model();

        return $modelClass::create([
            ...$this->toArray($data),
            'user_id' => $user->id,
        ]);
    }

}
