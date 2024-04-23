<?php

namespace App\Http\Controllers;

use App\Actions\Link\StoreLinkAction;
use App\Http\Requests\Links\StoreRequest;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    public function __construct(private StoreLinkAction $storeLinkAction)
    {
    }

    public function index()
    {
        return inertia('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
