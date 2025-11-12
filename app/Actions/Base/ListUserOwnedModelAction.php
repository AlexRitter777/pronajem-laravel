<?php

namespace App\Actions\Base;

use App\Models\User;
use App\Services\Search\DatabaseSearchContract;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class ListUserOwnedModelAction
{
    use FindUserOwnedModel;

    public function __construct(private DatabaseSearchContract $search) {}

    protected abstract function model() : string;

    protected function searchColumns(): array
    {
        return [];
    }

    protected function perPage(): int
    {
        return 10;
    }

    protected function withRelations() : array
    {
        return [];
    }


    public function execute(User $user, array $filters = []) : LengthAwarePaginator
    {
        $modelClass = $this->model();
        $perPage = $filters['per_page'] ?? $this->perPage();

        $query = $this->findOwnedModelQuery($modelClass, $user);

        $searchColumns = $this->searchColumns();

        if(!empty($filters['search']) && !empty($searchColumns)) {
            $this->search->search($query, $searchColumns, $filters['search']);
        }

        if(!empty($filters['sort'])) {
            $query->orderBy($filters['sort'],$filters['order'] ?? 'desc');
        }else{
            $query->latest();
        }


        return $query->with($this->withRelations())->paginate($perPage);


    }


}
