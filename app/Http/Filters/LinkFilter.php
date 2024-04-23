<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class LinkFilter extends AbstractFilter
{
    public const SEARCH = 'search';
    public const SORT_BY = 'sort_by';

    protected function getCallbacks(): array
    {
        return [
            self::SEARCH => [$this, 'search'],
            self::SORT_BY => [$this, 'sortBy'],
        ];
    }

    public function search(Builder $builder, string $value): void
    {
        $builder->where('title', 'like', "%{$value}%")
            ->orWhere('link', 'like', "%{$value}%");
    }

    public function sortBy(Builder $builder, string $value): void
    {
        $data = explode(':', $value);
        $builder->orderBy($data[0], $data[1]);
    }

    public function getSortByOptions(): array
    {
        return [
            'created_at:asc' => 'Created (A-Z)',
            'created_at:desc' => 'Created (Z-A)',
            'title:asc' => 'Title (A-Z)',
            'title:desc' => 'Title (Z-A)',
        ];
    }

    public function getPerPageOptions(): array
    {
        return [
            5 => '5 per page',
            10 => '10 per page',
            25 => '25 per page',
            50 => '50 per page',
            100 => '100 per page',
        ];
    }
}
