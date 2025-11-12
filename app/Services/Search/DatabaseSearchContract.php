<?php

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Builder;

interface DatabaseSearchContract
{
    public function search(Builder $query, array $columns, string $term): Builder;

}
