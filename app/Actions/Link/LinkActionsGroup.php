<?php

namespace App\Actions\Link;

use App\Models\Link;

class LinkActionsGroup
{
    public function __construct(
        public StoreLinkAction $storeLinkAction,
        public UpdateLinkAction $updateLinkAction,
        public IndexLinkAction $indexLinkAction,
    ) {
    }

    public function index(array $data)
    {
        return $this->indexLinkAction->run($data);
    }
    public function store(array $data): Link
    {
        return $this->storeLinkAction->run($data);
    }

    public function update(Link $link, array $data): bool
    {
        return $this->updateLinkAction->run($link, $data);
    }
}
