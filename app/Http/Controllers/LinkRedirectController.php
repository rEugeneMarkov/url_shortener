<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Jobs\CreateTransition;
use Illuminate\Http\RedirectResponse;

class LinkRedirectController extends Controller
{
    public function index(Link $link, Request $request): RedirectResponse
    {
        $userAgent = $request->header('User-Agent');
        $ipAddress = $request->ip();

        CreateTransition::dispatch($link, compact('userAgent', 'ipAddress'))->onQueue('transitions');

        return redirect($link->link);
    }
}
