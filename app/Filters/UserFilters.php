<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class UserFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $query)
    {
        return $this->filter($query);
    }

    protected function filter(Builder $query)
    {
        // earch
        if ($search = $this->request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by created_at
        if ($this->request->filled(['from', 'to'])) {
            $query->whereBetween('created_at', [
                $this->request->input('from'),
                $this->request->input('to')
            ]);
        }

        // Sorting
        $sortField = $this->request->input('sort_by', 'created_at');
        $sortDir = $this->request->input('sort_dir', 'desc');

        if (in_array($sortField, ['name', 'email', 'created_at']) && in_array($sortDir, ['asc', 'desc'])) {
            $query->orderBy($sortField, $sortDir);
        }

        return $query;
    }
}
