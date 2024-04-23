<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LinkRedirectController extends Controller
{
    public function index(Link $link, Request $request): RedirectResponse
    {
        return redirect($link->link);
    }
}
