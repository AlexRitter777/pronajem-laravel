<?php

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Builder;

class LikeDatabaseSearch implements DatabaseSearchContract
{

    public function search(Builder $query, array $columns, string $term): Builder
    {
        $term = addcslashes(mb_strtolower($term), '%_');

        return $query
            ->where(function (Builder $query) use ($columns, $term) {
                foreach ($columns as $column) {
                    $query->orWhereRaw('LOWER(' . $column . ') LIKE ?',  ["%{$term}%"]);
                }
            });
    }
}
