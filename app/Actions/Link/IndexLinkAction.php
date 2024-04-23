<?php

namespace App\Actions\Link;

use App\Models\Link;
use App\Http\Filters\LinkFilter;

class IndexLinkAction
{
    private const PER_PAGE = 5;
    private const ON_EACH_SIDE = 1;

    public function run(array $data): array
    {
        $filters = array_filter($data);

        $perPage = $filters['per_page'] ?? self::PER_PAGE;

        if (empty($filters)) {
            $filters = [
                'sort_by' => 'created_at:desc',
                'per_page' => $perPage,
            ];
        }

        $filter = app()->make(LinkFilter::class, ['queryParams' => $filters]);

        $links = Link::query()
            ->where('user_id', auth()->id())
            ->filter($filter)
            ->paginate($perPage)
            ->withQueryString()
            ->onEachSide(self::ON_EACH_SIDE);

        return [
            'links' => $links,
            'filters' => $filters,
            'sortValues' => $filter->getSortByOptions(),
            'perPageValues' => $filter->getPerPageOptions(),
        ];
    }
}
