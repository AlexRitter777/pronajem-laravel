<?php

namespace App\Actions\Base;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

abstract class LightListUserOwnedModelAction
{

    use FindUserOwnedModel;

    protected abstract function model(): string;

    public function execute(User $user) : Collection
    {

        $modelClass = $this->model();

        $query = $this->findOwnedModelQuery($modelClass, $user);

        return $query->get()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);

    }



}
