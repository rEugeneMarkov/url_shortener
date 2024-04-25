<?php

namespace App\Services\TransitionsService;

use App\Services\TransitionsService\Actions\CreateTransitionAction;

class TransitionsService
{
    public function createTransition(): CreateTransitionAction
    {
        return app()->make(CreateTransitionAction::class);
    }
}
