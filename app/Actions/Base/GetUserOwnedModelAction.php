<?php

namespace App\Actions\Base;

use App\Models\User;

abstract class GetUserOwnedModelAction
{
    use FindUserOwnedModel;
    abstract protected function model() : string;

    protected function withRelations() : array
    {
        return [];
    }

    public function execute(string|int $id, User $user) {

        $modelClass = $this->model();

        return $this->findOwnedModelQuery($modelClass, $user)
            ->with($this->withRelations())
            ->where('id', $id)
            ->firstOrFail();

    }

}
