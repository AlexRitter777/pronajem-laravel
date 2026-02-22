<?php

namespace App\Actions\Base;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

abstract class LightListUserOwnedModelAction
{

    use FindUserOwnedModel;

    protected abstract function model(): string;

    protected function withRelations() : array
    {
        return [];
    }

    public function execute(User $user) : Collection
    {

        $modelClass = $this->model();

        $query = $this->findOwnedModelQuery($modelClass, $user);

        return $query->with($this->withRelations())->get()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);

    }



}
