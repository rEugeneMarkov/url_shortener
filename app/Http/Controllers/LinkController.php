<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use App\Actions\Link\LinkActionsGroup;
use App\Http\Requests\Links\IndexRequest;
use App\Http\Requests\Links\StoreRequest;
use App\Http\Requests\Links\UpdateRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class LinkController extends Controller
{
    /** @var User $authUser */
    private Authenticatable $authUser;

    public function __construct(
        private LinkActionsGroup $actions
    ) {
        $this->authUser = auth()->user();
    }
    public function index(IndexRequest $request): Response
    {
        $data = $this->actions->index($request->validated());

        return inertia('Links/Index', $data);
    }

    public function create(): Response
    {
        if ($this->authUser->cannot('create', Link::class)) {
            abort(403);
        }
        return inertia('Links/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->actions->store($request->validated());

        return to_route('links.index');
    }

    public function show(Link $link): Response
    {
        if ($this->authUser->cannot('view', $link)) {
            abort(403);
        }
        return inertia('Links/Show', compact('link'));
    }

    public function update(UpdateRequest $request, Link $link): RedirectResponse
    {
        $this->actions->update($link, $request->validated());

        return to_route('links.index');
    }

    public function destroy(Link $link): RedirectResponse
    {
        if ($this->authUser->cannot('delete', $link)) {
            abort(403);
        }
        $link->delete();
        return to_route('links.index');
    }
}
