<?php

namespace App\Actions\Base;

use App\Models\User;

abstract class UpdateUserOwnedModelAction
{
    use FindUserOwnedModel;

    abstract protected function model(): string;
    abstract protected function toArray(object $data): array;

    public function execute(object $data, string|int $id, User $user)
    {
        $modelClass = $this->model();

        $record = $this->findUserOwnedModel($modelClass, $id, $user);

        $record->update($this->toArray($data));

        return $record;

    }

}
