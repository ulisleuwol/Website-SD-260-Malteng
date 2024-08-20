<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    /**
     * Apply date filter to a query based on the filter type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function applyDateFilter(Builder $query, $filter)
    {
        $now = Carbon::now();

        switch ($filter) {
            case 'today':
                $query->whereDate('created_at', $now->toDateString());
                break;
            case 'this_month':
                $query->whereYear('created_at', $now->year)
                    ->whereMonth('created_at', $now->month);
                break;
            case 'this_year':
                $query->whereYear('created_at', $now->year);
                break;
            default:
                // No additional conditions needed
                break;
        }

        return $query;
    }
}
