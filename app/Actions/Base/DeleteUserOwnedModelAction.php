<?php

namespace App\Actions\Base;

use App\Models\User;

abstract class DeleteUserOwnedModelAction
{

    use FindUserOwnedModel;

    abstract protected function model() : string;


    public function execute(string|int $id, User $user)
    {
        $modelClass = $this->model();
        $record = $this->findUserOwnedModel($modelClass, $id, $user);

        return $record->delete();
    }


}
