<?php

namespace App\Actions\Property;


use App\Models\Property;
use App\Models\User;

class GetPropertyAction
{
    public function execute(string $Id, User $user)
    {
        return Property::where('id', $Id)
            ->where('user_id', $user->id)
            ->firstOrFail();
    }
}
